<?php
  namespace Administrator\Belajar\PHP\MVC\Service;

  use Administrator\Belajar\PHP\MVC\Domain\User;
  use Administrator\Belajar\PHP\MVC\Exception\ValidationException;
  use Administrator\Belajar\PHP\MVC\Model\UserRegisterRequest;
  use Administrator\Belajar\PHP\MVC\Model\UserRegisterResponse;
  use Administrator\Belajar\PHP\MVC\Repository\UserRepository;
  use Administrator\Belajar\PHP\MVC\Database\Database;
  use Administrator\Belajar\PHP\MVC\Model\UserLoginRequest;
  use Administrator\Belajar\PHP\MVC\Model\UserLoginResponse;

  class UserService
  {
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
      $this->userRepository = $userRepository;  
    }

    public function register(UserRegisterRequest $req): UserRegisterResponse
    {
      $this->validateUserRegistrationRequest($req);
      $user = $this->userRepository->findById($req->id);

      try {
        Database::beginTransaction();

        if ($user != null)
        {
          throw new ValidationException("User id already exists");
        } 
  
        $user = new User();
        $user->id = $req->id;
        $user->name = $req->name;
        $user->password = password_hash($req->password, PASSWORD_BCRYPT);
  
        $this->userRepository->insert($user);
  
        $res = new UserRegisterResponse();
        $res->user = $user;

        Database::commitTransaction();
      } catch (\Exception $exception) {
        Database::rollbackTransaction();
        throw $exception;
      }
      return $res;
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $req)
    {
      if ($req->id == null || $req->name == null || $req->password == null || trim($req->id) == "" || trim($req->name) == "" || trim($req->password) == "")
      {
        throw new ValidationException("Id, Name, Password cannot blank.");
      }
    }

    public function login(UserLoginRequest $req): UserLoginResponse
    {
      $this->validateUserLoginRequest($req);

      $user = $this->userRepository->findById($req->id);
      
      if ($user == null || !password_verify($req->password, $user->password)) {
        throw new ValidationException("Id or password is wrong");
      }

      $res = new UserLoginResponse();
      $res->user = $user;

      return $res;
    }

    public function validateUserLoginRequest(UserLoginRequest $req)
    {
      if ($req->id == null || $req->name == null || $req->password == null || trim($req->id) == "" || trim($req->name) == "" || trim($req->password) == "")
      {
        throw new ValidationException("Id, Name, Password cannot blank.");
      }
    }
  }