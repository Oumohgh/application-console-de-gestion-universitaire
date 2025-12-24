<?php
    class Formateur{
        protected $id;
        protected $email;
        protected $password;
        protected $firstName;
        protected $lastName;

        function __construct($id, $email, $firstName, $lastName){
            $this->id = $id;
            $this->email = $email;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
        }

        function getId(){
            return $this->id;
        }
        
        function getEmail(){
            return $this->email;
        }
        
        function getFirstName(){
            return $this->firstName;
        }
        
        function getLastName(){
            return $this->lastName;
        }
        
        function setEmail($email){
            $this->email = $email;
        }
        
        function setFirstName($firstName){
            $this->firstName = $firstName;
        }
        
        function setLastName($lastName){
            $this->lastName = $lastName;
        }
    }
?>