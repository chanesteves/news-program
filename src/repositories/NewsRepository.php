<?php

namespace App\Repositories;

class NewsRepository {
    private $db;

    public function __construct(DB $db) {
        $this->db = $db;
    }

    public function findAll() {
        return $this->db->select("SELECT * FROM `news`");
    }

    public function save($title, $body) {
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(:title, :body, :createdAt)";
        $params = [
            'title' => $title,
            'body' => $body,
            'createdAt' => date('Y-m-d')
        ];
        $this->db->exec($sql, $params);
        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $sql = "DELETE FROM `news` WHERE `id` = :id";
        $params = ['id' => $id];
        return $this->db->exec($sql, $params);
    }
}
