<?php
namespace PavelPlot\App;
/**
 * Синглтон с настройками
 */
class Config
{
    private static Config $instance;
    private array $configData;

    protected function __construct() {}
    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }

    /**
     * Метод, используемый для получения экземпляра Одиночки.
     */
    public static function getInstance()
    {
        $subclass = static::class;
        if (!isset(self::$instance)) {
            $config = new static();
            $config->configData = include 'config.php';
            self::$instance = $config;
        }
        return self::$instance;
    }

    /**
     *
     * Вспомогательный метод для получения конкретных настроек по имени
     * @param string $name
     *
     * @return array|string|null
     * @throws \Exception
     */
    public static function get(string $name): array|string|null
    {
        $config = self::getInstance();
        if (isset($config->configData[$name])) {
            return $config->configData[$name];
        }

        throw new \Exception("Wrong config parameter");
    }
}