<?php
namespace Administrator\Belajar\PHP\MVC\Router;

class View
{
  public static function render(string $view, $model = []): void
  {
    extract($model);

    // Load layout wrapper
    require_once __DIR__ . '/../view/' . $view . '.php';
  }

  public static function redirect(string $url) 
  {
    header("Location: $url");
    /* exit(); */
    if (getenv("mode") !== "test")
    {
      exit();
    }
  }
}
