<?php
    class Course{
        protected $id;
        protected $email;
        protected $password;
        protected $role;

        function __construct($id, $email, $password, $role){
            $this->id = $id;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }

        function getId(){
            return $this->id;
        }

        function getEmail(){
            return $this->email;
        }

        function setEmail(string $email){
            $this->email = $email;
        }
        function getPassword(){
            return $this->password;
        }

        function setPassword(string $password){
            $this->password = $password;
        }

        function getRole(){
            return $this->role;
        }

        function setRole(string $role){
            $this->role = $role;
        }        
    }
?>