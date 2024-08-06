<?php

use App\Model\News;
use App\Database\MySQLConnection;
use App\Util\NewsManager;
use PHPUnit\Framework\TestCase;
use Mockery;

/**
 * Class NewsManagerTest
 *
 * Unit tests for the NewsManager class.
 */
class NewsManagerTest extends TestCase
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
     * Test the listNews method of the NewsManager class.
     *
     * @return void
     */
    public function testListNews(): void
    {
        $dbMock = Mockery::mock(MySQLConnection::class);
        $dbMock->shouldReceive('select')
               ->with('SELECT * FROM `news`')
               ->andReturn([
                   ['id' => 1, 'title' => 'News 1', 'body' => 'Body 1', 'created_at' => '2023-07-01'],
                   ['id' => 2, 'title' => 'News 2', 'body' => 'Body 2', 'created_at' => '2023-07-02'],
               ]);

        $newsManager = NewsManager::getInstance($dbMock);

        $newsList = $newsManager->listNews();
        $this->assertCount(2, $newsList);
        $this->assertInstanceOf(News::class, $newsList[0]);
        $this->assertEquals('News 1', $newsList[0]->getTitle());
    }
}
