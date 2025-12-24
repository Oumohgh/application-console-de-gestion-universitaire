<?php
class DatabaseConnection{
      
     private $host="localhost";
     protected $db="";
     private $user="root";
      private $pass='';
    private $dsn ="mysql:host=localhost;dbname=application_gestion_universtaires;charset=utf8";

    public static function connect(){

            try{
               $pdo= new PDO(self::$dsn, self::$user, self::$pass);
               $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "". $e->getMessage();
            }
    }
 }