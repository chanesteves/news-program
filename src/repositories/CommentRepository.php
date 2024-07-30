<?php

namespace App\Repositories;

class CommentRepository {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function findAll()
    {
        return $this->db->select("SELECT * FROM `comment`");
    }

    public function findByNewsId($newsId)
    {
        return $this->db->select("SELECT * FROM `comment` WHERE `news_id` = :news_id", [':news_id' => $newsId]);
    }

    public function save($body, $newsId) {
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :createdAt, :newsId)";
        $params = [
            'body' => $body,
            'createdAt' => date('Y-m-d'),
            'newsId' => $newsId
        ];
        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $sql = "DELETE FROM `comment` WHERE `id` = :id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }
}
