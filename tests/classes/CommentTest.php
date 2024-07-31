<?php

use PHPUnit\Framework\TestCase;
use App\Classes\Comment;

class CommentTest extends TestCase
{
    public function testSetAndGetId()
    {
        $comment = new Comment();
        $comment->setId(1);
        $this->assertEquals(1, $comment->getId());
    }

    public function testSetAndGetBody()
    {
        $comment = new Comment();
        $comment->setBody('This is a test comment.');
        $this->assertEquals('This is a test comment.', $comment->getBody());
    }

    public function testSetAndGetCreatedAt()
    {
        $comment = new Comment();
        $createdAt = new \DateTime();
        $comment->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $comment->getCreatedAt());
    }

    public function testSetAndGetNewsId()
    {
        $comment = new Comment();
        $comment->setNewsId(1);
        $this->assertEquals(1, $comment->getNewsId());
    }
}