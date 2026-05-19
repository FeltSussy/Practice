<?php

namespace App\Solution\Test;

use PHPUnit\Framework\TestCase;

use function App\Solution\transfer;

class SolutionTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $conn = new \PDO('sqlite::memory:');
        $conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        $this->conn = $conn;
        $sql = file_get_contents("init.sql");
        $conn->exec($sql);
    }

    public function testSuccessTransaction()
    {
        $from = 1;
        $to = 3;

        transfer($this->conn, $from, $to, 100);

        $this->assertEquals(50, $this->getBalance($from));
        $this->assertEquals(100, $this->getBalance($to));
    }

    public function testFailTransaction()
    {
        $from = 4;
        $to = 5;

        transfer($this->conn, $from, $to, 300);

        $this->assertEquals(200, $this->getBalance($from));
        $this->assertEquals(1500, $this->getBalance($to));
    }

    public function testFailTransaction2()
    {
        $from = 4;
        $to = 50;

        transfer($this->conn, $from, $to, 100);

        $this->assertEquals(200, $this->getBalance($from));
    }

    private function getBalance($accountId)
    {
        $stmt = $this->conn->prepare("SELECT balance FROM accounts WHERE id = :accountId");
        $stmt->execute(['accountId' => $accountId]);
        return $stmt->fetchColumn();
    }
}