<?php
require_once dirname(__DIR__) . '/Config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
$dotenv->load();

use Core\Db;

class Migration
{
    const SCRIPTS_DIR = __DIR__ . '/scripts/';
    const MIGRATIONS_TABLE = '0_migrations';

    public function __construct()
    {
        try {
            Db::connect()->beginTransaction();
            // check migration table & create
            $this->checkMigrationsTable();
            // run all migrations
            $this->runAllMigrations();
            Db::connect()->commit();
        } catch (PDOException $exception) {
            Db::connect()->rollBack();
            d($exception->getMessage(), $exception->getTrace());
        }
    }

    protected function runAllMigrations()
    {
        d('--- Fetching migrations...');
        $migrations = scandir(self::SCRIPTS_DIR);
        $migrations = array_values(array_diff($migrations, ['.', '..', self::MIGRATIONS_TABLE . '.sql']));

        foreach($migrations as $migration) {
            $table = $this->getTableName($migration);

            if (!$this->checkIfMigrationWasRun($migration)) {
                d("- Run [{$table}] ...");
                $script = file_get_contents(self::SCRIPTS_DIR . $migration);
                $query = Db::connect()->prepare($script);

                if ($query->execute()) {
                    $this->insertIntoMigrations($migration);
                    d("- [{$table}] done!");
                }
            }
        }
        d('--- Fetching migrations - done!');
    }


    protected function insertIntoMigrations(string $fileName)
    {
        $query = Db::connect()->prepare("INSERT INTO migrations (name) VALUES (:name)");
        $query->bindParam('name', $fileName);
        $query->execute();
    }

    protected function checkMigrationsTable()
    {
        $table = $this->getTableName(self::MIGRATIONS_TABLE);
        $query = Db::connect()->prepare("SHOW TABLES LIKE '$table'");
        $query->execute();

        if (!$query->fetch()) {
            $this->createMigrationsTable();
        }
    }

    protected function createMigrationsTable()
    {
        d('--- Prepare migration table query');
        $script = file_get_contents(self::SCRIPTS_DIR . self::MIGRATIONS_TABLE . '.sql');
        $query = Db::connect()->prepare($script);

        $text = match($query->execute()) {
            true => '- Migrations table was created!',
            false => '- Failed!'
        };

        d($text);
        d('--- Finished migration table query');
    }

    protected function getTableName(string $fileName): string
    {
        return preg_replace('/[\d_+]/i', '', $fileName);
    }

    protected function checkIfMigrationWasRun(string $migration): bool
    {
        $query = Db::connect()->prepare("SELECT * FROM migrations WHERE name=:name");
        $query->bindParam('name', $migration);
        $query->execute();

        return (bool) $query->fetch();
    }

} new Migration();
