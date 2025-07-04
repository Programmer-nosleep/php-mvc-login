<?php
  require_once __DIR__  . '/app/init.php';
  require_once __DIR__ . '/vendor/autoload.php';

  use Administrator\Belajar\PHP\MVC\App;
  use Administrator\Belajar\PHP\MVC\App\Router;
  use Administrator\Belajar\PHP\MVC\controller\HomeController;
  use Administrator\Belajar\PHP\MVC\Controller\LoginController;
  use Administrator\Belajar\PHP\MVC\Controller\UserController;
  use Administrator\Belajar\PHP\MVC\middleware\AuthMiddleware;

  use Administrator\Belajar\PHP\MVC\Database\Database;

  Database::getConnection('production');

  Router::add('GET', '/', HomeController::class, 'index');
  Router::add('GET', '/dashboard', HomeController::class, 'dashboard', [AuthMiddleware::class]);

  Router::add('GET', '/users/login', LoginController::class, 'login', []);
  Router::add('POST', '/users/login', LoginController::class, 'postLogin', []);

  Router::add('GET', '/users/register', UserController::class, 'register', []);
  Router::add('POST', '/users/register', UserController::class, 'postRegister', []);
  Router::run();
