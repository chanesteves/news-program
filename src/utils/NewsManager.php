<?php

namespace App\Utils;

use App\Factories\NewsFactory;
use App\Repositories\NewsRepository;
use App\Repositories\DB;
use App\Classes\News;
use App\Classes\Comment;

class NewsManager extends AbstractManager
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    /**
     * @var CommentManager
     */
    private $commentManager;

    /**
     * NewsManager constructor.
     * 
     * @param DB $db
     */
    protected function __construct(DB $db)
    {
        $this->newsRepository = new NewsRepository($db);
        $this->commentManager = CommentManager::getInstance($db);
    }

    /**
     * List all news items.
     * 
     * @return News[]
     */
    public function listNews(): array
    {
        $rows = $this->newsRepository->findAll();
        $news = [];
        foreach ($rows as $row) {
            $news[] = NewsFactory::create($row);
        }

        return $news;
    }

    /**
     * Add a news item.
     * 
     * @param string $title
     * @param string $body
     * @return string
     */
    public function addNews(string $title, string $body): string
    {
        return $this->newsRepository->save($title, $body);
    }

    /**
     * Delete a news item by ID and its related comments.
     * 
     * @param int $id
     * @return bool
     */
    public function deleteNews(int $id): bool
    {
        $comments = $this->commentManager->listCommentsForNews($id);
        foreach ($comments as $comment) {
            $this->commentManager->deleteComment($comment->getId());
        }

        return $this->newsRepository->delete($id);
    }
}
