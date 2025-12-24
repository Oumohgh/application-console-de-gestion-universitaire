$host='localhost';
$dbname='gestion_unversitaies;
$username='root';
$pwd='';

try{
    $pdo=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);

    $pdo-> setattribute(PDO::ATRR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDO EXCEPTION $e){
    die('connection fialed'.$e->getMessage());d
}