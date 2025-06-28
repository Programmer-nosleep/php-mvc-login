<?php
  namespace Administrator\Belajar\PHP\MVC\Config;

  use PHPUnit\Framework\TestCase;
  use Administrator\Belajar\PHP\MVC\Database\Database;

  class DatabaseTest extends TestCase
  {
    public function testGetConnection()
    {
      $conn = Database::getConnection();
      self::assertNotNull($conn);
    }

    public function testGetConnectionSingleton()
    {
      $conn1 = Database::getConnection();
      $conn2 = Database::getConnection();

      self::assertSame($conn1, $conn2);
    }
  }