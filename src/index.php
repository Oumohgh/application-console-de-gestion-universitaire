<?php
<<<<<<< HEAD
	include ("Service/UniversirtyService.php");


	$user1= new UserService();
	run($user1);

?>
=======


include 'Entity/Departement.php';
include 'Entity/Course.php';
//  $studen = new Person();
//     $prenom =new Person();
   

   



$cour =new Course(3,"almofid",2,5);
echo $cour->getid();
echo "\n";
//$cour->setid(-3);
echo $cour->getTitre();
echo "\n";
echo $cour->getVolumeHoraire();
echo "\n";
echo $cour->getdepartmentId();




 $depa = new Departement(2,'ghizlane','number');
echo $depa->getId(); 
echo "\n";
$depa->setId(4);
echo "\n";
echo $depa->getname(); 
echo "\n";
echo $depa->getdescription();
>>>>>>> ba8a6d25ba588c701e1da1076399521199aa11b5
