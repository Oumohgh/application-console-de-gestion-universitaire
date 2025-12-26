<?php

class  CouresService{
   private $table =[];

   public function criteCourse(Course  $cours){
    array_push($this->table ,$cours);
   }

   public function getcour(){
    return $this->table;
   }

}