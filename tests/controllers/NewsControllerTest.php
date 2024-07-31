<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\NewsController;
use App\Utils\NewsManager;
use App\Utils\CommentManager;
use App\Classes\News;
use App\Classes\Comment;

class NewsControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testDisplayNews()
    {
        // Mock NewsManager
        $newsManagerMock = Mockery::mock(NewsManager::class);
        $news1 = (new News())->setId(1)->setTitle('News 1')->setBody('Body 1')->setCreatedAt(new \DateTime());
        $news2 = (new News())->setId(2)->setTitle('News 2')->setBody('Body 2')->setCreatedAt(new \DateTime());
        $newsManagerMock->shouldReceive('listNews')->andReturn([$news1, $news2]);

        // Mock CommentManager
        $commentManagerMock = Mockery::mock(CommentManager::class);
        $comment1 = (new Comment())->setId(1)->setBody('Comment 1')->setCreatedAt(new \DateTime())->setNewsId(1);
        $comment2 = (new Comment())->setId(2)->setBody('Comment 2')->setCreatedAt(new \DateTime())->setNewsId(1);
        $commentManagerMock->shouldReceive('listCommentsForNews')->with(1)->andReturn([$comment1, $comment2]);
        $commentManagerMock->shouldReceive('listCommentsForNews')->with(2)->andReturn([]);

        // Create the controller with mocked dependencies
        $controller = new NewsController($newsManagerMock, $commentManagerMock);

        // Capture the output
        ob_start();
        $controller->displayNews();
        $output = ob_get_clean();

        // Assert the output
        $this->assertStringContainsString('############ NEWS News 1 ############', $output);
        $this->assertStringContainsString('Body 1', $output);
        $this->assertStringContainsString('Comment 1', $output);
        $this->assertStringContainsString('Comment 2', $output);
        $this->assertStringContainsString('############ NEWS News 2 ############', $output);
        $this->assertStringContainsString('Body 2', $output);
    }
}
