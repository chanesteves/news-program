<?php

use PHPUnit\Framework\TestCase;
use App\Classes\Comment;

/**
 * Class CommentTest
 *
 * Unit tests for the Comment class.
 */
class CommentTest extends TestCase
{
    /**
     * Test the setId and getId methods of the Comment class.
     *
     * @return void
     */
    public function testSetAndGetId(): void
    {
        $comment = new Comment();
        $comment->setId(1);
        $this->assertEquals(1, $comment->getId());
    }

    /**
     * Test the setBody and getBody methods of the Comment class.
     *
     * @return void
     */
    public function testSetAndGetBody(): void
    {
        $comment = new Comment();
        $comment->setBody('This is a test comment.');
        $this->assertEquals('This is a test comment.', $comment->getBody());
    }

    /**
     * Test the setCreatedAt and getCreatedAt methods of the Comment class.
     *
     * @return void
     */
    public function testSetAndGetCreatedAt(): void
    {
        $comment = new Comment();
        $createdAt = new \DateTime();
        $comment->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $comment->getCreatedAt());
    }

    /**
     * Test the setNewsId and getNewsId methods of the Comment class.
     *
     * @return void
     */
    public function testSetAndGetNewsId(): void
    {
        $comment = new Comment();
        $comment->setNewsId(1);
        $this->assertEquals(1, $comment->getNewsId());
    }
}
