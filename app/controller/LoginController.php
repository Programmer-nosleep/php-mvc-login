<?php
  namespace Administrator\Belajar\PHP\MVC\Controller;

  use Administrator\Belajar\PHP\MVC\Database\Database;
  use Administrator\Belajar\PHP\MVC\Exception\ValidationException;
  use Administrator\Belajar\PHP\MVC\Model\UserLoginRequest;
  use Administrator\Belajar\PHP\MVC\Repository\UserRepository;
  use Administrator\Belajar\PHP\MVC\Router\View;
  use Administrator\Belajar\PHP\MVC\Service\UserService;

  class LoginController
  {
    private UserService $userService;

    public function __construct()
    {
      $conn = Database::getConnection();
      $userRepository = new UserRepository($conn);
      $this->userService = new UserService($userRepository);
    }

    public function login()
    {
      View::render('auth/Login', [
        'title' => 'Login',
        'content' => '',
        'error' => '',
        'form_action' => '/users/login',
        'alternate_link' => '/users/register',
        'alternate_button' => 'Login',
        'alternate_text' => 'Belum punya akun? Masuk di sini'
      ]);
    }

    public function postLogin()
    {
      $req = new UserLoginRequest();
      $req->id = $_POST['id'];
      $req->password = $_POST['password'];

      try {
        //code...
        $this->userService->login($req);
        View::redirect('/');
      } catch (ValidationException $exception) {
        View::render('auth/Login', [
          'title' => 'Login User',
          'error' => $exception->getMessage()
        ]);
      }
    }

    public function logout(): void
    {
      session_destroy();
      header('Location: /login');
    }
  }