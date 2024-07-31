<?php

namespace App\Repositories;

use App\Database\MySQLConnection;

class CommentRepository
{
    /**
     * @var MySQLConnection
     */
    private $db;

    /**
     * CommentRepository constructor.
     * 
     * @param MySQLConnection $db
     */
    public function __construct(MySQLConnection $db)
    {
        $this->db = $db;
    }

    /**
     * Find all comments.
     * 
     * @return array
     */
    public function findAll(): array
    {
        return $this->db->select("SELECT * FROM `comment`");
    }

    /**
     * Find comments by news ID.
     * 
     * @param int $newsId
     * @return array
     */
    public function findByNewsId(int $newsId): array
    {
        return $this->db->select("SELECT * FROM `comment` WHERE `news_id` = :news_id", [':news_id' => $newsId]);
    }

    /**
     * Save a new comment.
     * 
     * @param string $body
     * @param int $newsId
     * @return string
     */
    public function save(string $body, int $newsId): string
    {
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :createdAt, :newsId)";
        $params = [
            'body' => $body,
            'createdAt' => date('Y-m-d'),
            'newsId' => $newsId
        ];
        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    /**
     * Delete a comment by ID.
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `comment` WHERE `id` = :id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }
}
