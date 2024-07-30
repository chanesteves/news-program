<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\NewsController;

$newsController = new NewsController();
$newsController->displayNews();