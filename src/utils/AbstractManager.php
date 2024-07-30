<?php

namespace App\Utils;

abstract class AbstractManager
{
    protected static $instances = [];

    public static function getInstance()
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class();
        }
        return self::$instances[$class];
    }

    abstract public function listItems();
}
