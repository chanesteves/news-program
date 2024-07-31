<?php

use PHPUnit\Framework\TestCase;
use App\Utils\NewsManager;
use App\Repositories\DB;
use App\Classes\News;

class NewsManagerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testListNews()
    {
        $dbMock = Mockery::mock(DB::class);
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
