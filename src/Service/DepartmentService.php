<?php 
class DepartmentService{
    private $table = [];

    //-------------CREATE
    public function createDepartment(Departement $department){
        $this->table[] = $department;
        return true;
    }

    //--------------READ ALL
    public function getAllDepartments(){
        return $this->table;
    }

    //-----------READ BY ID
    public function getDepartmentById($id){
        foreach($this->table as $dep){
            if($dep->getId() === $id){
                return $dep;
            }
        }
        return null;
    }

    //---------------UPDATE
    public function updateDepartment($id, $name, $description){
        foreach($this->table as $key => $dep){
            if($dep->getId() === $id){
                $dep->setName($name);
                $dep->setDescription($description);
                $this->table[$key] = $dep;
                return true;
            }
        }
        return false;
    }

    //---------------DELETE
    public function deleteDepartment($id){
        foreach($this->table as $key => $dep){
            if($dep->getId() === $id){
                unset($this->table[$key]);
                $this->table = array_values($this->table);
                return true;
            }
        }
        return false;
    }
}
