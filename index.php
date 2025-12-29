<?php
require_once  '/src/Entity/User.php';
require_once '/src/Entity/Department.php';
require_once '/src/Service/serviceDepartment.php';
require_once '/src/Service/UserService.php';
require_once  '/src/Service/FormateurService.php';
require_once  '/src/Service/CourseService.php';
require_once  '/src/Entity/Course.php';
require_once  '/menu.php';
require_once  '/src/Entity/Fourmateur.php';


$userrepo = new UserRepository();
$user = new UserService($userrepo);

do {

    echo "register\n";
    echo "Entrer  email : ";
    $email = trim(fgets(STDIN));
    echo "Enter Password : ";
    $pass = trim(fgets(STDIN));
    global $user;
    try {
        $Auth = $user->Login($email,$pass);
    } catch (Exception $e) {
        throw new Exception('user not fond');
    }
    var_dump($Auth);
    if (!$Auth) {
        echo 'not fond';
    }
} while ($Auth['password'] != $pass);

if ($Auth['role'] == 'admin') {
    do {
        echo "Bonjour $email\n";
        echo "1 : Gerer les departements\n";
        echo "2 : Gerer les cours\n";
        echo "3 : Gérer les formateurs\n";
        echo "4 : Affecter un formateur à un cours\n";
        echo "0 : Exit\n\n";
        echo 'Entrer votre choi : ';
        $choi = trim(fgets(STDIN));
        $dep = new Department();
        $serviceDep = new ServiceDepartment($dep);
        global $serviceDep;
        switch ($choi) {
            case 1:
                do {

                    $choi = menu($dep->getTableName());
                    switch ($choi) {
                        default:
                            'Entrer number between 0 et 4';
                            break;
                        case 1:
                            echo 'Enter le name de department : ';
                            $name = trim(fgets(STDIN));
                            echo 'Enter le description  : ';
                            $description = trim(fgets(STDIN));
                            $serviceDep->CreateDep($name,$description);
                            echo "\n department create\n\n";
                            break;
                        case 2:
                            echo 'Entre id de department que vous modifier : ';
                            $nID = trim(fgets(STDIN));
                            $result = $dep->getRow($nID,'id');
                            if(!$result){
                                echo "je n'ai trouve ce department \n\n";
                                break;
                            }
                            $data = [];
                            echo 'Entrer la nouvell name de department : ';
                            $nDep = trim(fgets(STDIN));
                            echo 'Entrer la nouvell Description : ';
                            $nDescption = trim(fgets(STDIN));
                            $data['name'] = $nDep;
                            $data['description'] = $nDescption;
                            $dep->Update($data,$nID,'id');
                            echo "\n\n Update success \n\n";
                            break;
                        case 3:
                            echo 'Entre id de department que vous Delete : ';
                            $sID = trim(fgets(STDIN));
                            $result = $dep->getRow($sID,'id');
                            if(!$result){
                                echo "je n ai pas trouv ce department \n\n";
                                break;
                            }
                            $dep->Delete($sID,'id');
                            echo "\n Delete success \n\n";
                            break;
                        case 4:
                            $result = $dep->getAll();
                            var_dump($result);
                            break;
                        case 5:
                            break;
                    }
                } while ($choix != 5);
                break;
            case 2:

                do {
                    $cours = new Course();
                    $courseRepo = new CourseRepository();
                    $couresServ = new CourseService($courseRepo);
                    $choi = menu($cours->getTableName());
                    switch ($choi) {
                        default:
                            'Entrer nuber between 0 et 4';
                            break;
                        case 1:
                            echo 'Enter le name de Course : ';
                            $name = trim(fgets(STDIN));
                            echo 'Enter name department to inser this course : ';
                            $nameDep = trim(fgets(STDIN));
                            $dep = new Department();
                            $result = $dep->getRow($nameDep,'name');
                            $couresServ->CreateCourse($name,$nameDep,$result['id']);
                            echo "\n\n Creation success \n\n";
                            break;
                        case 2:
                            echo 'Entre id de course que vous modifier : ';
                            $cID = trim(fgets(STDIN));
                            $result = $cours->getRow($cID,'id');
                            if(!$result){
                                echo "je n'ai trouvé ce course \n\n";
                                break;
                            }
                            $data = [];
                            echo 'Entrer la nouvell name de Course : ';
                            $nCourse = trim(fgets(STDIN));
                            echo 'Entrer la nouvell name de deaprtment : ';
                            $nameDep = trim(fgets(STDIN));
                            $data['name'] = $nCourse;
                            $cours->Update($data,$cID,'id');
                            echo "\n\n Update success \n\n";
                            break;
                        case 3:
                            echo 'Entre id de course que vous supprimer : ';
                            $cID = trim(fgets(STDIN));
                            $result = $cours->getRow($cID,'id');
                            if(!$result){
                                echo "je n'ai trouvé ce cours \n\n";
                                break;
                            }
                            $cours->Delete($cID,'id');
                            echo "\n Delete success \n\n";
                            break;
                        case 4:
                            $result = $cours->getAll();
                            var_dump($result);
                            break;
                        case 5:
                            break;
                    }
                } while ($choi != 5);
                break;
            case 3:
                do {
                              
                                $formateurRepo = new FormateurRepository();
                                $formateur = new FormateurService($formateurRepo);
                                global $formateur;
                                $choix = menu('formateur');
                                switch ($choix) {
                                    default:
                                        'Entrer nuber between 1 et 4';
                                        break;
                                    case 1:
                                        echo 'Enter le firstname de formateur : ';
                                        $firstname = trim(fgets(STDIN));
                                        echo 'Enter le lastname de formateur : ';
                                        $lastname = trim(fgets(STDIN));
                                        echo 'Enter email de formateur : ';  
                                        $email = trim(fgets(STDIN));
                                        echo 'Enter le age de formateur : ';
                                        $age = trim(fgets(STDIN));
                                        echo 'Enter paswword de formateur : ';
                                        $password = trim(fgets(STDIN));
                                        echo 'Enter le specialité de formateur : ';
                                        $special = trim(fgets(STDIN));
                                        $role = 'formateur';
                                        $user->Createuser($firstname,$lastname,$age,$email,$password,$role);
                                        $userid = $userrepo->findByemail($email);
                                        $formateur->CreateFormateur($userid,$special);
                                        echo "\n\n Creation success \n\n";
                                        break;
                                    case 2:
                                        
                                                echo 'entrer email de formateur qui veux modifier : ';
                                                $emailuse = trim(fgets(STDIN));
                                                $formaid = $userrepo->findByemail($emailuse);
                                                var_dump($formaid);
                                                if(!$formaid){
                                                    echo "je n'ai pas trouve formateur";
                                                    break;
                                                }
                                                echo 'Enter le firstname de formateur : ';
                                                $firstname = trim(fgets(STDIN));
                                                echo 'Enter le lastname de formateur : ';
                                                $lastname = trim(fgets(STDIN));
                                                echo 'Enter le age de formateur : ';
                                                $age = trim(fgets(STDIN));
                                                echo 'Enter le specialité de formateur : ';
                                                $special = trim(fgets(STDIN));
                                                $data = [];
                                                $data['firtname'] = $firstname;
                                                $data['lastname'] = $lastname;
                                                $data['age'] = $age;
                                                $forma['speciality'] = $special;
                                                $userrepo->Update($data,$emailuse,'email');
                                                $formateurRepo->Update($forma,$formaid,'user_id');
                                                echo "\n\nupdate succef\n\n";

                                                
                                        break;
                                    case 3:
                                         echo 'entrer email de formateur : ';
                                                $emailfor = trim(fgets(STDIN));
                                                $formaid = $userrepo->findByemail($emailfor);
                                                if(!$formaid){
                                                    echo "je n'ai  pas trouve formateur avec ce nom ";
                                                    break;
                                                }
                                                $userrepo->Delete($emailfor,'email');
                                                echo "\n\n delete success\n \n";
                                        break;
                                    case 4:
                                        $result = $formateurRepo->getformateur();
                                        var_dump($result);
                                        break;
                                    case 5:
                                        break;
                                }
                            } while ($choix != 5);
                break;
            case 4:
                break;
            case 0:
                echo "\nExit";
                break;
        }
    } while ($choix != 0);
}
else{
    echo "Bonjour:$email \n";
        echo "1 : la liste des etudiants\n";
        echo "2 : consulter les cours par departement\n";
        echo 'votre choix : ';
        $choix = trim(fgets(STDIN));
}

