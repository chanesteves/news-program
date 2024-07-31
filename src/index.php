<?php

require_once __DIR__ . '/bootstrap.php';

use App\Controllers\NewsController;
use App\Repositories\DB;
use App\Utils\NewsManager;
use App\Utils\CommentManager;

/**
 * Entry point of the application.
 */
try {
	$db = DB::getInstance();

	$newsManager = NewsManager::getInstance($db);
    $commentManager = CommentManager::getInstance($db);

    $newsController = new NewsController($newsManager, $commentManager);
    $newsController->displayNews();
} catch (\Exception $e) {
	$message = 'Error occurred: ' . $e->getMessage();
    error_log($message);
    echo $message;
}
