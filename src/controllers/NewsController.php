<?php

namespace App\Controllers;

use App\Repositories\DB;
use App\Utils\NewsManager;
use App\Utils\CommentManager;

class NewsController
{
    private $newsManager;
    private $commentManager;

    public function __construct()
    {
        $db = DB::getInstance();
        $this->newsManager = NewsManager::getInstance($db);
        $this->commentManager = CommentManager::getInstance($db);
    }

    public function displayNews()
    {
        foreach ($this->newsManager->listNews() as $news) {
            echo("############ NEWS " . $news->getTitle() . " ############\n");
            echo($news->getBody() . "\n");
            foreach ($this->commentManager->listComments($news->getId()) as $comment) {
                echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
            }
        }
    }
}