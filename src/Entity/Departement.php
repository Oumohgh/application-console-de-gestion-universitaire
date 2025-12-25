
<?php 
 class Departement
 {
    private $id;
    private $name;
    private $description;

    public function __construct($id,$name,$description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description =$description;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        if(!is_int($id)|| $id<0 || $id==''){
            echo 'dkhl id shih';
            //exit();
        }
         return $this->id =$id;
    }
    
    public function getname(){
        return $this->name;
    }

    public function setname($name){
        if(!is_string($name)||empty($name)){
            echo '3mr luser';
            exit();
        }
        return $this->name =$name;
    }

    public function getdescription(){
        return $this->description;
    }

    public function setdescription($description){
        if(!is_string($description)||empty($description)){
            echo '3mr klxi';
            exit();
        }
        return $this->description =$description;
    }
    
 }


 $depa = new Departement(2,'ghizlane','number');
echo $depa->getId(); 
echo "\n";
$depa->setId(4);
echo "\n";
echo $depa->getname(); 
echo "\n";
echo $depa->getdescription();

 