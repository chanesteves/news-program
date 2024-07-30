<?php

namespace App\Utils;

use App\Factories\NewsFactory;
use App\Repositories\NewsRepository;
use App\Repositories\DB;

class NewsManager extends AbstractManager
{
	private $newsRepository;
	private $commentManager;

	protected function __construct(DB $db)
    {
        $this->newsRepository = new NewsRepository($db);
        $this->commentManager = CommentManager::getInstance($db);
    }
	
    public function listNews()
    {
        $rows = $this->newsRepository->getAllNews();
        $news = [];
        foreach ($rows as $row) {
            $news[] = NewsFactory::create($row);
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
