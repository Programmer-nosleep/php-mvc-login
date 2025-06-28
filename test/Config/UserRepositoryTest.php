<?php
  namespace Administrator\Belajar\PHP\MVC\Config;

  use Administrator\Belajar\PHP\MVC\Database\Database;
  use Administrator\Belajar\PHP\MVC\Repository\UserRepository;
  use Administrator\Belajar\PHP\MVC\Domain\User;
  use PHPUnit\Framework\TestCase;

  class UserRepositoryTest extends TestCase
  {
    private UserRepository $userRepository;

    protected function setUp(): void
    {
      $this->userRepository = new UserRepository(Database::getConnection());
      $this->userRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
      $user = new User();
      $user->id = "zani";
      $user->name = "Zani";
      $user->password = "12345";

      $this->userRepository->insert($user);
      $result = $this->userRepository->findById($user->id);

      self::assertEquals($user->id, $result->id);
      self::assertEquals($user->name, $result->name);
      self::assertEquals($user->password, $result->password);
    }

    public function testFindByIdNotFound()
    {
      $user = $this->userRepository->findById("not found");
      self::assertNull($user);
    }
  }