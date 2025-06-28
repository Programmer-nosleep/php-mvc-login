<?php
namespace Administrator\Belajar\PHP\MVC\Config;

use Administrator\Belajar\PHP\MVC\Database\Database;
use Administrator\Belajar\PHP\MVC\Domain\User;
use Administrator\Belajar\PHP\MVC\Model\UserRegisterRequest;
use Administrator\Belajar\PHP\MVC\Repository\UserRepository;
use Administrator\Belajar\PHP\MVC\Service\UserService;
use Administrator\Belajar\PHP\MVC\Exception\ValidationException;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
  private UserService $userService;
  private UserRepository $userRepository;

  protected function setUp(): void
  {
    $conn = Database::getConnection();
    $this->userRepository = new UserRepository($conn);
    $this->userService = new UserService($this->userRepository);

    $this->userRepository->deleteAll();
  }

  public function testRegisterSuccess()
  {
    $req = new UserRegisterRequest();
    $req->id = "zani";
    $req->name = "Zani";
    $req->password = "12345";

    $res = $this->userService->register($req);

    self::assertEquals($req->id, $res->user->id);
    self::assertEquals($req->name, $res->user->name);
    self::assertNotEquals($req->password, $res->user->password);
    self::assertTrue(password_verify($req->password, $res->user->password));
  }

  public function testRegisterFailed()
  {
    $this->expectException(ValidationException::class);

    $req = new UserRegisterRequest();
    $req->id = "";
    $req->name = "";
    $req->password = null;

    $this->userService->register($req);
  }

  public function testRegisterDuplicate()
  {
    $user = new User();
    $user->id = "zani";
    $user->name = "Zani";
    $user->password = password_hash("12345", PASSWORD_BCRYPT); 

    $this->userRepository->insert($user);

    $this->expectException(ValidationException::class);

    $req = new UserRegisterRequest();
    $req->id = "zani";
    $req->name = "Zani";
    $req->password = "12345";

    $this->userService->register($req);
  }
}
