<?php

namespace App\Database;

class MySQLConnection
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var MySQLConnection|null
     */
    private static $instance = null;

    /**
     * MySQLConnection constructor.
     * 
     * @throws \Exception
     */
    public function __construct(\PDO $pdo = null)
    {
        if ($pdo) {
            $this->pdo = $pdo;
        } else {
            try {
                $this->pdo = new \PDO(MySQLConfig::$dsn, MySQLConfig::$user, MySQLConfig::$password);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                $message = 'Database connection error: ' . $e->getMessage();
                error_log($message);
                throw new \Exception($message);
            }
		}
    }

    /**
     * Get the instance of the MySQLConnection class.
     * 
     * @return MySQLConnection
     */
    public static function getInstance(): MySQLConnection
    {
        if (null === self::$instance) {
            MySQLConfig::init(); // Initialize the MySQLConfig
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Execute a select query.
     * 
     * @param string $sql
     * @param array $params
     * @return array
     * @throws \Exception
     */
    public function select(string $sql, array $params = []): array
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params);

            return $sth->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $message = 'Database query error: ' . $e->getMessage();
            error_log($message);
            throw new \Exception($message);
        }
    }

    /**
     * Execute an SQL statement.
     * 
     * @param string $sql
     * @param array $params
     * @return int
     * @throws \Exception
     */
    public function exec(string $sql, array $params = []): int
    {
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params);

            return $sth->rowCount();
        } catch (\PDOException $e) {
			$message = 'Database execution error: ' . $e->getMessage();
    		error_log($message);
            throw new \Exception($message);
        }
    }

    /**
     * Get the ID of the last inserted row.
     * 
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
