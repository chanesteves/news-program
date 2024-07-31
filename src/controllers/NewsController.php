<?php

namespace App\Controllers;

use App\Repositories\DB;
use App\Utils\NewsManager;
use App\Utils\CommentManager;
use App\Classes\News;
use App\Classes\Comment;

class NewsController
{
    /**
     * @var NewsManager
     */
    private $newsManager;

    /**
     * @var CommentManager
     */
    private $commentManager;

    /**
     * NewsController constructor.
     */
    public function __construct(NewsManager $newsManager, CommentManager $commentManager)
    {
        $this->newsManager = $newsManager;
        $this->commentManager = $commentManager;
    }

    /**
     * Display all news and their comments.
     * 
     * @return void
     */
    public function displayNews(): void
    {
        /** @var News $news */
        foreach ($this->newsManager->listNews() as $news) {
            echo("############ NEWS " . $news->getTitle() . " ############\n");
            echo($news->getBody() . "\n");
            /** @var Comment $comment */
            foreach ($this->commentManager->listCommentsForNews($news->getId()) as $comment) {
                echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
            }
        }
    }
}
