<?php

namespace App\Repositories;

class NewsRepository 
{
    /**
     * @var DB
     */
    private $db;

    /**
     * NewsRepository constructor.
     * 
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * Find all news.
     * 
     * @return array
     */
    public function findAll(): array
    {
        return $this->db->select("SELECT * FROM `news`");
    }

    /**
     * Save a new news item.
     * 
     * @param string $title
     * @param string $body
     * @return string
     */
    public function save(string $title, string $body): string
    {
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(:title, :body, :createdAt)";
        $params = [
            'title' => $title,
            'body' => $body,
            'createdAt' => date('Y-m-d')
        ];
        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    /**
     * Delete a news item by ID.
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `news` WHERE `id` = :id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }
}
