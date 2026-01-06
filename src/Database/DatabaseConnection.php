<?php

namespace App\Database;

use PDO;

class DatabaseConnection
{
    public  function getConnection()
    {
        $hostname = "localhost";
        $dbname = "application_gestion_universitaire";
        $user = "root";
        $dbpass = "";
        
        $dsn = "mysql:host=$hostname;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $dbpass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    }
}
