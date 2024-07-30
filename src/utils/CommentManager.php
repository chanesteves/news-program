<?php

namespace App\Utils;

use App\Classes\Comment;
use App\Repositories\DB;
use App\Repositories\CommentRepository;

class CommentManager extends AbstractManager
{
	private $commentRepository;

	protected function __construct(DB $db) {
        $this->commentRepository = new CommentRepository($db);
    }

    public function listComments($newsId)
    {
        $rows = $this->commentRepository->getComments($newsId);
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
        return $this->commentRepository->addComment($body, $newsId);
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->deleteComment($id);
    }
}
