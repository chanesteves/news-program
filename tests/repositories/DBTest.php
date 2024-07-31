<?php

namespace Tests\Unit\Repositories;

use PHPUnit\Framework\TestCase;
use App\Repositories\DB;
use App\Repositories\DBConfig;
use Mockery;

class DBTest extends TestCase
{
    protected $pdoMock;
    protected $db;

    protected function setUp(): void
    {
        // Set environment variables for testing
        $_ENV['DB_NAME'] = 'test_db';
        $_ENV['DB_HOST'] = 'localhost';
        $_ENV['DB_USER'] = 'root';
        $_ENV['DB_PASS'] = '';

        // Initialize the DBConfig
        DBConfig::init();

        // Mock the PDO instance
        $this->pdoMock = Mockery::mock('PDO');
        $this->db = new DB($this->pdoMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    public function testSelect()
    {
        $statementMock = Mockery::mock('PDOStatement');
        $statementMock->shouldReceive('execute')->once()->with([':param' => 'value'])->andReturn(true);
        $statementMock->shouldReceive('fetchAll')->once()->andReturn([['id' => 1, 'name' => 'Test']]);

        $this->pdoMock->shouldReceive('prepare')->once()->with('SELECT * FROM test WHERE param = :param')->andReturn($statementMock);

        $result = $this->db->select('SELECT * FROM test WHERE param = :param', [':param' => 'value']);
        $this->assertCount(1, $result);
        $this->assertEquals('Test', $result[0]['name']);
    }

    public function testExec()
    {
        $statementMock = Mockery::mock('PDOStatement');
        $statementMock->shouldReceive('execute')->once()->with([':name' => 'New Name', ':id' => 1])->andReturn(true);
        $statementMock->shouldReceive('rowCount')->once()->andReturn(1);

        $this->pdoMock->shouldReceive('prepare')->once()->with('UPDATE test SET name = :name WHERE id = :id')->andReturn($statementMock);

        $result = $this->db->exec('UPDATE test SET name = :name WHERE id = :id', [':name' => 'New Name', ':id' => 1]);
        $this->assertEquals(1, $result);
    }

    public function testLastInsertId()
    {
        $this->pdoMock->shouldReceive('lastInsertId')->once()->andReturn('1');

        $result = $this->db->lastInsertId();
        $this->assertEquals('1', $result);
    }
}
