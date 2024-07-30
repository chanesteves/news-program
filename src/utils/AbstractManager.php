<?php

namespace App\Utils;

use App\Repositories\DB;

abstract class AbstractManager
{
    protected static $instances = [];

    public static function getInstance(DB $db)
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class($db);
        }
        return self::$instances[$class];
    }
}
