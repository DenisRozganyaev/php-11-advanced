<?php

namespace Core\Traits;

use Core\Db;
use PDO;

trait Queryable
{
    static protected string|null $tableName = "";
    static protected string $query = "";

    protected array $commands = [];

    // Car::select(['id', 'model'...])
    public static function select(array $columns = ['*']): static
    {
        static::resetQuery();
        static::$query = "SELECT " . implode(', ', $columns) . " FROM " . static::$tableName . " ";

        $obj = new static();
        $obj->commands[] = 'select';

        return $obj;
    }

    // INSERT INTO table () VALUES ()
    public static function create(array $data): int
    {
        $params = static::prepareQueryParams($data);

        $query = "INSERT INTO " . static::$tableName . " ({$params['keys']}) VALUES ({$params['placeholders']})";
        $query = Db::connect()->prepare($query);

        $query->execute($data);

        return (int) Db::connect()->lastInsertId();
    }

    public static function all(): array
    {
        static::resetQuery();
        static::$query = "SELECT * FROM " . static::$tableName;
        $obj = new static();
        $obj->commands[] = 'all';

        return $obj->get();
    }

    protected static function prepareQueryParams(array $fields): array
    {
        $keys = array_keys($fields);
        $placeholders = preg_filter('/^/', ':', $keys);

        return [
            'keys' => implode(', ', $keys),
            'placeholders' => implode(', ', $placeholders)
        ];
    }

    public static function findBy(string $column, $value)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE {$column}=:{$column}";

        $query = Db::connect()->prepare($query);
        $query->bindParam($column, $value);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    public static function find(int $id)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE id=:id";

        $query = Db::connect()->prepare($query);
        $query->bindParam('id', $id);
        $query->execute();

        return $query->fetchObject(static::class);
    }

    protected static function resetQuery()
    {
        static::$query = "";
    }

    public function get()
    {
        return Db::connect()->query(static::$query)->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function where(string $column, string $operator, $value): static
    {
        if (!$this->can(['select'])) {
            throw new \Exception('[select] command should be called before [where]');
        }

        static::$query .= "WHERE {$column} {$operator} {$value}";

        $obj = new static();
        $obj->commands[] = 'where';

        return $obj;
    }

    public function update(array $data)
    {
        $query = "UPDATE " . static::$tableName . " SET " . $this->prepareUpdateParams(array_keys($data)) . " WHERE id=:id";
        $query = Db::connect()->prepare($query);
        $data['id'] = $this->id; // $park->id

        return $query->execute($data);
    }

    public function destroy(): bool
    {
        $query = "DELETE FROM " . static::$tableName . " WHERE id=:id";
        $query = Db::connect()->prepare($query);
        $query->bindParam('id', $this->id);

        return $query->execute();
    }

    protected function prepareUpdateParams(array $keys): string
    {
        $string = "";
        $lastKey = array_key_last($keys);

        foreach ($keys as $index => $key) {
            $string .= "{$key}=:{$key}" . ($lastKey !== $index ? ', ' : '');
        }

        return $string;
    }

    protected function can(array $allowedMethods)
    {
        foreach ($allowedMethods as $method) {
            if (in_array($method, $this->commands)) {
                return true;
            }
        }
        return false;
    }
}
