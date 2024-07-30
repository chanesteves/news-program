<?php

require_once __DIR__ . '/bootstrap.php';

use App\Controllers\NewsController;

/**
 * Entry point of the application.
 */
try {
    $newsController = new NewsController();
    $newsController->displayNews();
} catch (\Exception $e) {
	$message = 'Error occurred: ' . $e->getMessage();
    error_log($message);
    echo $message;
}
