<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Controllers\NewsController;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

/**
 * Entry point of the application.
 */
try {
    $newsController = new NewsController();
    $newsController->displayNews();
} catch (\Exception $e) {
    echo "Error occurred: " . $e->getMessage();
}
