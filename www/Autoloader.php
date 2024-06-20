<?php
final class Autoloader
{
    private static $instance;

    private function __construct()
    {
        // Прячем конструктор
        spl_autoload_register(function ($class) {
            include __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
        });
    }

    public static function getInstance(): Autoloader
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
        // Отключаем клонирование
    }

    public function __wakeup()
    {
        // Отключаем десериализацию
    }
}