<?php

namespace App\Utils;

use App\Factories\CommentFactory;
use App\Repositories\CommentRepository;
use App\Repositories\DB;

class CommentManager extends AbstractManager
{
	private $commentRepository;

	protected function __construct(DB $db) {
        $this->commentRepository = new CommentRepository($db);
    }

    public function listComments($newsId)
    {
        $rows = $this->commentRepository->findByNewsId($newsId);
        $comments = [];
        foreach ($rows as $row) {
            $comments[] = CommentFactory::create($row);
        }

        return $comments;
    }

    public function addCommentForNews($body, $newsId)
    {
        return $this->commentRepository->save($body, $newsId);
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->delete($id);
    }
}
