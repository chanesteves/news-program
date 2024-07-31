<?php

namespace App\Utils;

use App\Database\MySQLConnection;
use App\Factories\CommentFactory;
use App\Repositories\CommentRepository;
use App\Classes\Comment;

class CommentManager extends AbstractManager
{
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * CommentManager constructor.
     * 
     * @param MySQLConnection $db
     */
    protected function __construct(MySQLConnection $db)
    {
        $this->commentRepository = new CommentRepository($db);
    }

    /**
     * List comments for a specific news item.
     * 
     * @param int $newsId
     * @return Comment[]
     */
    public function listCommentsForNews(int $newsId): array
    {
        $rows = $this->commentRepository->findByNewsId($newsId);
        $comments = [];
        foreach ($rows as $row) {
            $comments[] = CommentFactory::create($row);
        }

        return $comments;
    }

    /**
     * Add a comment for a specific news item.
     * 
     * @param string $body
     * @param int $newsId
     * @return string
     */
    public function addCommentForNews(string $body, int $newsId): string
    {
        return $this->commentRepository->save($body, $newsId);
    }

    /**
     * Delete a comment by ID.
     * 
     * @param int $id
     * @return bool
     */
    public function deleteComment(int $id): bool
    {
        return $this->commentRepository->delete($id);
    }
}
