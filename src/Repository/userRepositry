<?php

require_once __DIR__ . '/../Entity/Users.php';
 class UserRepository extends CrudGeneric
 {
    protected string $tableName = 'users';

   public function findByemail(string $value){
    $sql = "SELECT id FROM $this->tableName WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':email', $value);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id'] ;
}
 }