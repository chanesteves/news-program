<?php

namespace App\Util;

use App\Database\MySQLConnection;

abstract class AbstractManager
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * Get the instance of the derived manager class.
     *
     * @param MySQLConnection $db
     * @return static
     */
    public static function getInstance(MySQLConnection $db)
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class($db);
        }
        return self::$instances[$class];
    }
}
