<?php

namespace App\Repositories;

/**
 * Configuration class for database connection.
 */
class DBConfig
{
    /**
     * @var string
     */
    public static $dsn;

    /**
     * @var string
     */
    public static $user;

    /**
     * @var string
     */
    public static $password;

    /**
     * Initialize database configuration from environment variables.
     */
    public static function init()
    {
        self::$dsn = 'mysql:dbname=' . $_ENV['DB_NAME'] . ';host=' . $_ENV['DB_HOST'];
        self::$user = $_ENV['DB_USER'];
        self::$password = $_ENV['DB_PASS'];
    }
}