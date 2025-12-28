<?php


class DatabaseConnection{

   private $conn;
   private $user = "root";
   private $hostname = "localhost";
   private $dbname = "application_gestion_universitaire";
   private $dbpass = "";

   public function __construct()
   {
    $this->conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname;charset=utf8mb4", $this->user, $this->dbpass);

   }
   public function connect(){
    return $this->conn;
   }
}



?>


 
// class DatabaseConnection
// {
//     private static ?PDO $pdo = null;

//     public static function getConnection(): PDO
//     {
//         if (self::$pdo === null) {
//             self::$pdo = new PDO(
//                 "mysql:host=localhost;dbname=application_gestion_universitaire;charset=utf8",
//                 "root",
//                 "",
//                 [
//                     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
//                 ]
//             );
//         }
//         return self::$pdo;
//     }
// }
