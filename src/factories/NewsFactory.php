<?php

namespace App\Factories;

use App\Classes\News;

class NewsFactory
{
    public static function create(array $data)
    {
        return (new News())
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setBody($data['body'])
            ->setCreatedAt($data['created_at']);
    }
}
