<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Utils\NewsManager;
use App\Utils\CommentManager;

foreach (NewsManager::getInstance()->listItems() as $news) {
	echo("############ NEWS " . $news->getTitle() . " ############\n");
	echo($news->getBody() . "\n");
	foreach (CommentManager::getInstance()->listItems() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}