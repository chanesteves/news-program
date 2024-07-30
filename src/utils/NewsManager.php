<?php

namespace App\Utils;

use App\Classes\News;
use App\Repositories\DB;
use App\Repositories\NewsRepository;

class NewsManager extends AbstractManager
{
	private $newsRepository;
	private $commentManager;

	protected function __construct()
    {
        $this->newsRepository = new NewsRepository(DB::getInstance());
        $this->commentManager = CommentManager::getInstance();
    }
	
    public function listItems()
    {
        $rows = $this->newsRepository->getAllNews();
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
        return $this->newsRepository->addNews($title, $body);
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

        return $this->newsRepository->deleteNews($id);
    }
}
