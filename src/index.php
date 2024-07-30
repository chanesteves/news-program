<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\NewsController;

/**
 * Entry point of the application.
 */
try {
    $newsController = new NewsController();
    $newsController->displayNews();
} catch (\Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
