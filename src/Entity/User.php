<?php
    class User{
        protected $email;
        protected $password;
        protected $role;

        function __construct($email, $password, $role){
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }

        function getEmail(){
            return $this->email;
        }

        function getPassword(){
            return $this->password;
        }

        function getRole(){
            return $this->role;
        }

        function setEmail($email){
            $this->email = $email;
        }

        function setPassword($password){
            $this->password = $password;
        }

        function setRole($role){
            $this->role = $role;
        }
    }
?>