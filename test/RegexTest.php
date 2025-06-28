<?php
  namespace Administrator\Belajar\PHP\MVC;

  use PHPUnit\Framework\TestCase;

  class RegexTest extends TestCase
  {
    public function testRegex()
    {
      $path = "/products/12345/categories/abcd";
      $pattern = "#^/products/([0-9a-zA-Z]*)/categories/([0-9a-zA-Z]*)$#";
      $result = preg_match($pattern, $path, $variables);

      self::assertEquals(1, $result);
      if ($result) 
      {
        $this->assertEquals('12345', $variables[1]);
        $this->assertEquals('abcd', $variables[2]);
      }
    }
  }