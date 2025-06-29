<?php
namespace Administrator\Belajar\PHP\MVC\App {
  function handle(string $value)
  {
    echo $value;
  }
}

namespace Administrator\Belajar\PHP\MVC\Config {
  use PHPUnit\Framework\TestCase;
  use Administrator\Belajar\PHP\MVC\Database\Database;
  use Administrator\Belajar\PHP\MVC\Domain\User;
  use Administrator\Belajar\PHP\MVC\Controller\LoginController;
  use Administrator\Belajar\PHP\MVC\Controller\UserController;
  use Administrator\Belajar\PHP\MVC\Repository\UserRepository;

  class UserControllerTest extends TestCase
  {
    private UserController $userController;
    private LoginController $loginController;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
      $this->userController = new UserController();
      $this->loginController = new LoginController();
      $this->userRepository = new UserRepository(Database::getConnection());

      $this->userRepository->deleteAll();
      putenv("mode=test");
      $_SERVER['REQUEST_METHOD'] = 'POST';
    }

    public function testRegister()
    {
      $this->userController->register();

      $this->expectOutputRegex("[Register]");
      $this->expectOutputRegex("[id]");
      $this->expectOutputRegex("[name]");
      $this->expectOutputRegex("[password]");
      $this->expectOutputRegex("[Register new User]");
    }

    public function testPostRegisterSuccess()
    {
      $_POST['id'] = 'zani';
      $_POST['name'] = 'Zani';
      $_POST['password'] = '12345';

      $this->userController->postRegister();

      $this->expectOutputString("Location: /login");
    }

    public function testPostRegisterValidationError()
    {
      $_POST['id'] = '';
      $_POST['name'] = '';
      $_POST['password'] = '12345';

      $this->userController->postRegister();

      $this->expectOutputRegex("[Register]");
      $this->expectOutputRegex("[id]");
      $this->expectOutputRegex("[name]");
      $this->expectOutputRegex("[password]");
      $this->expectOutputRegex("[Register new User]");
      $this->expectOutputRegex("[Id, Name, Password cannot blank.]");
    }

    public function testPostRegisterDuplicate()
    {
      $user = new User();
      $user->id = "zani";
      $user->name = "Zani";
      $user->password = "12345";

      $this->userRepository->insert($user);

      $_POST['id'] = 'zani';
      $_POST['name'] = 'Zani';
      $_POST['password'] = '12345';

      $this->userController->postRegister();

      $this->expectOutputRegex("[Register]");
      $this->expectOutputRegex("[id]");
      $this->expectOutputRegex("[name]");
      $this->expectOutputRegex("[password]");
      $this->expectOutputRegex("[Register new User]");
      $this->expectOutputRegex("[User id already exists.]");
    }

    public function testLogin()
    {
      $this->loginController->login();

      $this->expectOutputRegex("[Login user]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Password]");
    }

    public function testLoginSuccess()
    {
      $user = new User();
      $user->id = 'zani';
      $user->name = 'Zani';
      $user->password = password_hash('12345', PASSWORD_BCRYPT);
      $this->userRepository->insert($user);
    
      $_POST['id'] = 'zani';
      $_POST['password'] = '12345';
    
      $this->loginController->postLogin();
    
      $this->expectOutputString("Location: /dashboard");
    }
    
    public function testLoginValidationError()
    {
      $_POST['id'] = '';
      $_POST['password'] = '';
    
      $this->loginController->postLogin();
    
      $this->expectOutputRegex("[Login user]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id and Password cannot blank.]");
    }
  }
}


