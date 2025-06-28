<?php
  namespace Administrator\Belajar\PHP\MVC\App;

  use Administrator\Belajar\PHP\MVC\Router\View;
  use PHPUnit\Framework\TestCase;

  class ViewTest extends TestCase
  {
    public function testRender()
    {
      View::render('home', [
        "title" => "PHP Login Management",
        "logo" => "Login Management",
        "content" => "Selamat datang di halaman utama"
      ]);

      $this->expectOutputRegex('/PHP Login Management/');
      $this->expectOutputRegex('/<html>/');
      $this->expectOutputRegex('/<body>/');
      $this->expectOutputRegex('/Login Management/');
      $this->expectOutputRegex('/Login/');
      $this->expectOutputRegex('/Register/');
    }
  }