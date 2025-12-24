<?php
	class etudiant{
		
	}
	$classes =get_declared_classes();
	echo "les  cours:". implode(',',$classes). "<br/>";
	
	$class_names=['flan','flan','oughlane'];
	foreach($class_names as $class_name) {
		if(class_exists($class_name)){
			echo "${class_name} is  here <br />";
		} else {
			echo "{$class_name} is not here .<br />";
			
		}
}
?>