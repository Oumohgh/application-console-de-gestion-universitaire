<?php

class EtudiantRepository extends CrudGeneric
{
    protected string $tableName = 'etudiant';
    
      public function getetudiant(){
        $sql = "SELECT  users.id,
            users.firtname,
            users.lastname,
            users.email,
            users.age,
            users.role,
            etudiant.nameclass FROM users JOIN etudiant ON etudiant.user_id = users.id";
        $stmt = $this->conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $result  ;
    }
}