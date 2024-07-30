<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Set custom error log file
ini_set('error_log', __DIR__ . '/../logs/' . date('Y-m-d') . '.log');

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
try {
    $dotenv->load();
} catch (Exception $e) {
    $message = 'Could not load .env file: ' . $e->getMessage();
    error_log($message);
    die($message);
}