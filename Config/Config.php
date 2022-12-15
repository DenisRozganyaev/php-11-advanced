<?php
namespace Config;

class Config
{
    protected array $configs = [];
    protected static Config|null $instance = null;

    public static function get(string $name): string|null
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance->getParam($name);
    }

    public function getParam(string $name): string|null
    {
        $keys = explode('.', $name);
        return $this->findParamByKeys($keys, $this->getConfigs());
    }

    protected function getConfigs(): array
    {
        $configs = [];

        if (empty($this->configs)) {
            $configs = include BASE_DIR . '/Config/configs.php';
        }

        return $configs;
    }

    protected function findParamByKeys(array $keys = [], array $configs = [])
    {
        $value = null;

        if (empty($keys)) {
            return $value;
        }

        $search = array_shift($keys);

        if (array_key_exists($search, $configs)) {
            $value = is_array($configs[$search]) ? $this->findParamByKeys($keys, $configs[$search]) : $configs[$search];
        }

        return $value;
    }

}