<?php
require_once '/../Repository/UserRepository.php';


class UserService 
{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function Login($email,$pass){
         if(empty($pass) || empty($email)) throw new Exception('name or password Vide');
         return $this->userRepo->getRow($email,'email');
    }

      public function Createuser($firstname,$lastname,$age,$email,$password,$role){
        if(strlen($firstname)<3 || strlen($lastname)<3 || $age<0  )
             throw new Exception('erreur name minimum caracter est 3 , virifier votre age');
        $this->userRepo->Create(['firtname'=> $firstname, 'lastname'=>$lastname, 'age'=>$age, 'email'=>$email, 'password'=>$password,'role'=>$role]);
        
    }
}