<?php

namespace App\Factories;

use App\Classes\Comment;

class CommentFactory
{
    public static function create(array $data)
    {
        return (new Comment())
            ->setId($data['id'])
            ->setBody($data['body'])
            ->setCreatedAt($data['created_at'])
            ->setNewsId($data['news_id']);
    }
}
