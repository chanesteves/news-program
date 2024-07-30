<?php

namespace App\Repositories;

class DBConfig {
    const DSN = 'mysql:dbname=phptest;host=127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
}

class DB
{
	private $pdo;
	private static $instance = null;

	private function __construct()
	{
		$this->pdo = new \PDO(DBConfig::DSN, DBConfig::USER, DBConfig::PASSWORD);
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public static function getInstance()
	{
		if (null === self::$instance) {
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	public function select($sql, $params = [])
	{
		$sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll();
	}

	public function exec($sql, $params = [])
	{
		$sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        return $sth->rowCount();
	}

	public function lastInsertId()
	{
		return $this->pdo->lastInsertId();
	}
}