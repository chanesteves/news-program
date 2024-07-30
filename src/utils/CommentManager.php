<?php

namespace App\Utils;

use App\Classes\Comment;

class CommentManager extends AbstractManager
{
    public function listItems()
    {
        $rows = $this->db->select('SELECT * FROM `comment`');
        $comments = [];
        foreach ($rows as $row) {
            $comments[] = (new Comment())
                ->setId($row['id'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at'])
                ->setNewsId($row['news_id']);
        }
        return $comments;
    }

    public function addCommentForNews($body, $newsId)
    {
        $sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(?, ?, ?)";
        $this->db->exec($sql, [$body, date('Y-m-d'), $newsId]);
        return $this->db->lastInsertId();
    }

    public function deleteComment($id)
    {
        $sql = "DELETE FROM `comment` WHERE `id` = ?";
        return $this->db->exec($sql, [$id]);
    }
}
