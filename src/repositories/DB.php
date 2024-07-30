<?php

namespace App\Repositories;

/**
 * Configuration class for database connection.
 */
class DBConfig
{
    const DSN = 'mysql:dbname=phptest;host=127.0.0.1';
    const USER = 'root';
    const PASSWORD = '';
}

class DB
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var DB|null
     */
    private static $instance = null;

    /**
     * DB constructor.
     * 
     * @throws \Exception
     */
    private function __construct()
    {
        try {
            $this->pdo = new \PDO(DBConfig::DSN, DBConfig::USER, DBConfig::PASSWORD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception('Database connection error: ' . $e->getMessage());
        }
    }

    /**
     * Get the instance of the DB class.
     * 
     * @return DB
     */
    public static function getInstance(): DB
    {
        if (null === self::$instance) {
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
            throw new \Exception("Database query error: " . $e->getMessage());
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
            throw new \Exception("Database execution error: " . $e->getMessage());
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
