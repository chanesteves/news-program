<?php

namespace App\Utils;

use App\Classes\News;

class NewsManager extends AbstractManager
{
	private $commentManager;

	protected function __construct()
    {
        parent::__construct();
        $this->commentManager = CommentManager::getInstance();
    }
	
    public function listItems()
    {
        $rows = $this->db->select('SELECT * FROM `news`');
        $news = [];
        foreach ($rows as $row) {
            $news[] = (new News())
                ->setId($row['id'])
                ->setTitle($row['title'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at']);
        }
        return $news;
    }

    public function addNews($title, $body)
    {
        $sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(?, ?, ?)";
        $this->db->exec($sql, [$title, $body, date('Y-m-d')]);
        return $this->db->lastInsertId();
    }

    public function deleteNews($id)
    {
        $comments = $this->commentManager->listItems();
        $idsToDelete = [];

        foreach ($comments as $comment) {
            if ($comment->getNewsId() == $id) {
                $idsToDelete[] = $comment->getId();
            }
        }

        foreach ($idsToDelete as $commentId) {
            $this->commentManager->deleteComment($commentId);
        }

        $sql = "DELETE FROM `news` WHERE `id` = ?";
        return $this->db->exec($sql, [$id]);
    }
}
