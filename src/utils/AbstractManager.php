<?php

namespace App\Utils;

abstract class AbstractManager
{
    protected static $instances = [];
    protected $db;

    protected function __construct()
    {
        $this->db = DB::getInstance();
    }

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
