<?php

namespace App\Utils;

use App\Repositories\DB;

abstract class AbstractManager
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * Get the instance of the derived manager class.
     * 
     * @param DB $db
     * @return static
     */
    public static function getInstance(DB $db)
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class($db);
        }
        return self::$instances[$class];
    }
}
