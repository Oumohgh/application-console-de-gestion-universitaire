<?php 

class User {

    private   int $id ;
    private string $username;
    private    string $password;
  
 private Permission $permission ;

 public function __construct($username,$permission)
 {
   
   $this->username = $username;
   
    $this ->permission=$permission;
 }
  
 

  public function getUsername(): string
    {
        return $this->username;
        
    }

     public function getPermision(): Permission
    {
        return $this->permission;
        
    }
    public function  getPassword(): string
    {
        return $this->password;
    }
public  function setUsername($username){
    $this->username=$username;
}
public function Setpassword($password){
    $this->password =$password;
 }

 public function SetPermision($permission){
    $this ->permission=$permission ;
 }
}
?>