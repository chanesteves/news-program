<?php

namespace App\Factory;

use App\Model\News;

class NewsFactory
{
    /**
     * Create a new News instance from the provided data array.
     *
     * @param array $data
     * @return News
     */
    public static function create(array $data): News
    {
        return (new News())
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setBody($data['body'])
            ->setCreatedAt(new \DateTime($data['created_at']));
    }
}
