<?php

use App\Model\Comment;
use App\Database\MySQLConnection;
use App\Util\CommentManager;
use PHPUnit\Framework\TestCase;
use Mockery;

/**
 * Class CommentManagerTest
 *
 * Unit tests for the CommentManager class.
 */
class CommentManagerTest extends TestCase
{
    /**
     * Clean up Mockery after each test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Test the listCommentsForNews method of the CommentManager class.
     *
     * @return void
     */
    public function testListCommentsForNews(): void
    {
        $dbMock = Mockery::mock(MySQLConnection::class);
        $dbMock->shouldReceive('select')
               ->with('SELECT * FROM `comment` WHERE `news_id` = :news_id', [':news_id' => 1])
               ->andReturn([
                   ['id' => 1, 'body' => 'Comment 1', 'created_at' => '2023-07-01', 'news_id' => 1],
                   ['id' => 2, 'body' => 'Comment 2', 'created_at' => '2023-07-02', 'news_id' => 1],
               ]);

        $commentManager = CommentManager::getInstance($dbMock);

        $comments = $commentManager->listCommentsForNews(1);
        $this->assertCount(2, $comments);
        $this->assertInstanceOf(Comment::class, $comments[0]);
        $this->assertEquals('Comment 1', $comments[0]->getBody());
    }
}
