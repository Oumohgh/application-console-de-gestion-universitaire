<?php
require_once'User.php';
require_once'Permission.php';


$permission = new Permission("Read",'ddd');


$user = new User("ough",  $permission);


echo "name: " . $user->getUsername() . "<br>";
echo "Perm " . $user->getPermission()->getName() . "<br>";

$user->setUsername("oughlane");
// $user->getPermission()->setName("mm");


echo "Updated Username: " . $user->getUsername() . "<br>";
// echo "Updated Perm: " . $user->getPermission()->getName();


 
?>