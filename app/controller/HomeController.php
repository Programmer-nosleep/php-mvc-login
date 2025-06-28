<?php
  namespace Administrator\Belajar\PHP\MVC\controller;
  
  use Administrator\Belajar\PHP\MVC\Router\View;

  class HomeController
  {
    public function index(): void
    {
      View::render('home', [
        "title" => "Beranda",
        "logo" => "Login Management",
        "content" => "Selamat datang di halaman utama"
      ]);
    }
  }