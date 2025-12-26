<?php


include 'Entity/Departement.php';
include 'Entity/Course.php';
include 'Service/DepartmentService.php';
include 'Service/couresService.php';

//  $studen = new Person();
//     $prenom =new Person();
   
$DEP1 =new Course(3,"ghi",5,5);
   
$DEP2 =new CouresService();

$DEP2->criteCourse($DEP1);

var_dump($DEP2->getcour());


// $cour =new Course(3,"almofid",2,5);
// echo $cour->getid();
// echo "\n";
// //$cour->setid(-3);
// echo $cour->getTitre();
// echo "\n";
// echo $cour->getVolumeHoraire();
// echo "\n";
// echo $cour->getdepartmentId();




//  $depa = new Departement(2,'ghizlane','number');
// echo $depa->getId(); 
// echo "\n";
// $depa->setId(4);
// echo "\n";
// echo $depa->getname(); 
// echo "\n";
// echo $depa->getdescription();


