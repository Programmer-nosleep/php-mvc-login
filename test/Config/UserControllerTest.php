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
  use Administrator\Belajar\PHP\MVC\Controller\UserController;
  use Administrator\Belajar\PHP\MVC\Repository\UserRepository;

  class UserControllerTest extends TestCase
  {
    private UserController $userController;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
      $this->userController = new UserController();

      $userRepository = new UserRepository(Database::getConnection());
      $userRepository->deleteAll();

      putenv("mode=test");
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
  }
}


