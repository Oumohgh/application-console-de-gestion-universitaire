<?php


class Permission{

private int $id;
private string $name;
private string $description;
 private User $user ;

 
  public function __construct($name,$description)
 {
   
     $this->name= $name;
    $this->description=$description;
   
 }


  public function getName(): string
    {
        return $this->name;
    }
      public function getdescription(): string
    {
        return $this->description;
    }
    public function getUser(): User{
        return $this->user;
    }
 public function SetName($name){
    $this->name =$name;
 }
 public function SetDescription($description){
    $this->description =$description;
 }

 public function SetUser($user){
    $this->user =$user;
 }
}