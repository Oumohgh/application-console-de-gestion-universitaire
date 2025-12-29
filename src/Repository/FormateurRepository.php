<?php

class FormateurRepository extends CrudGeneric
{
    protected string $tableName = 'formateurs';
    
      public function getformateur(){
        $sql = "SELECT  users.id,
            users.firtname,
            users.lastname,
            users.email,
            users.age,
            users.role,
            formateurs.speciality FROM users JOIN formateurs ON formateurs.user_id = users.id";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $result  ;
    }
}