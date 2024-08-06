<?php

use PHPUnit\Framework\TestCase;
use App\Model\News;

/**
 * Class NewsTest
 *
 * Unit tests for the News class.
 */
class NewsTest extends TestCase
{
    /**
     * Test the setId and getId methods of the News class.
     *
     * @return void
     */
    public function testSetAndGetId(): void
    {
        $news = new News();
        $news->setId(1);
        $this->assertEquals(1, $news->getId());
    }

    /**
     * Test the setTitle and getTitle methods of the News class.
     *
     * @return void
     */
    public function testSetAndGetTitle(): void
    {
        $news = new News();
        $news->setTitle('Test Title');
        $this->assertEquals('Test Title', $news->getTitle());
    }

    /**
     * Test the setBody and getBody methods of the News class.
     *
     * @return void
     */
    public function testSetAndGetBody(): void
    {
        $news = new News();
        $news->setBody('This is a test body.');
        $this->assertEquals('This is a test body.', $news->getBody());
    }

    /**
     * Test the setCreatedAt and getCreatedAt methods of the News class.
     *
     * @return void
     */
    public function testSetAndGetCreatedAt(): void
    {
        $news = new News();
        $createdAt = new \DateTime();
        $news->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $news->getCreatedAt());
    }
}
