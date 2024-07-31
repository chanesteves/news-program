<?php

use PHPUnit\Framework\TestCase;
use App\Classes\News;

class NewsTest extends TestCase
{
    public function testSetAndGetId()
    {
        $news = new News();
        $news->setId(1);
        $this->assertEquals(1, $news->getId());
    }

    public function testSetAndGetTitle()
    {
        $news = new News();
        $news->setTitle('Test Title');
        $this->assertEquals('Test Title', $news->getTitle());
    }

    public function testSetAndGetBody()
    {
        $news = new News();
        $news->setBody('This is a test body.');
        $this->assertEquals('This is a test body.', $news->getBody());
    }

    public function testSetAndGetCreatedAt()
    {
        $news = new News();
        $createdAt = new \DateTime();
        $news->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $news->getCreatedAt());
    }
}
