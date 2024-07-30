<?php

namespace App\Repositories;

class CommentRepository {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function getComments($newsId) {
        $sql = "SELECT * FROM `comment`";
        if ($newsId) {
            $sql .= " WHERE `news_id` = " . (int)$newsId;
        }

        return $this->db->select($sql);
    }

    public function addComment($body, $newsId) {
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :createdAt, :newsId)";
        $params = [
            'body' => $body,
            'createdAt' => date('Y-m-d'),
            'newsId' => $newsId
        ];
        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    public function deleteComment($id) {
        $sql = "DELETE FROM `comment` WHERE `id` = :id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }
}
