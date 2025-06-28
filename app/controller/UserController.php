<?php
  namespace Administrator\Belajar\PHP\MVC\Controller;

  use Administrator\Belajar\PHP\MVC\Router\View;
  use Administrator\Belajar\PHP\MVC\Database\Database;
  use Administrator\Belajar\PHP\MVC\Model\UserRegisterRequest;
  use Administrator\Belajar\PHP\MVC\Repository\UserRepository;
  use Administrator\Belajar\PHP\MVC\Service\UserService;

  class UserController
  {
    private UserService $userService;

    public function __construct()
    {
      $conn = Database::getConnection();
      $userRepository = new UserRepository($conn);
      $this->userService = new UserService($userRepository);
    }

    public function register()
    {
      View::render('auth/Register', [
        'title' => 'Register',
        'content' => '',
        'error' => '',
        'form_action' => '/users/register',
        'alternate_link' => '/users/login',
        'alternate_text' => 'Sudah punya akun? Masuk di sini'
      ]);
    }

    public function postRegister()
    {
      $req = new UserRegisterRequest();
      $req->id = $_POST['id'];
      $req->name = $_POST['name'];
      $req->password = $_POST['password'];

      $this->userService->register($req);

      try {
        $this->userService->register($req);
      } catch (\Exception $exception) {
        View::render('auth/Register', [
          'title' => 'Register',
          'form_action' => '/users/register',
          'alternate_link' => '/users/login',
          'alternate_text' => 'Sudah punya akun?',
          'error' => $exception->getMessage(),
          'id' => $req->id,
          'name' => $req->name
        ]);
      }
    }
  }