<?php

namespace App\Factory;

use App\Model\Comment;

class CommentFactory
{
    /**
     * Create a new Comment instance from the provided data array.
     * 
     * @param array $data
     * @return Comment
     */
    public static function create(array $data): Comment
    {
        return (new Comment())
            ->setId($data['id'])
            ->setBody($data['body'])
            ->setCreatedAt(new \DateTime($data['created_at']))
            ->setNewsId($data['news_id']);
    }
}
