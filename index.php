<?php

require_once __DIR__ . '/src/autoload.php';

use App\Entity\User;
use App\Exception\AuthorizationException;
use App\Exception\ValidationException;
use App\Repository\FormateurRepository;
use App\Repository\StudentRepository;
use App\Repository\UserRepository;
use App\Service\AuthService;
use App\Service\FormateurService;
use App\Service\StudentService;
use App\Service\UserService;

// Initialize services
$userRepository = new UserRepository();
$authService = new AuthService($userRepository);
$userService = new UserService($userRepository, $authService);
$studentRepository = new StudentRepository();
$studentService = new StudentService($studentRepository, $authService);
$formateurRepository = new FormateurRepository();
$formateurService = new FormateurService($formateurRepository, $authService);

function clearScreen()
{
    system('cls');
}

function printHeader($title)
{
    echo "\n" . str_repeat("=", 50) . "\n";
    echo "  " . strtoupper($title) . "\n";
    echo str_repeat("=", 50) . "\n\n";
}

function printMenu($options)
{
    foreach ($options as $key => $label) {
        echo "  {$key}. {$label}\n";
    }
    echo "\n";
}

function readInput($prompt)
{
    echo $prompt;
    return trim(fgets(STDIN));
}

function readInt($prompt)
{
    $input = readInput($prompt);
    return (int)$input;
}

function displayUser($user)
{
    echo "\n  ID : {$user->getId()}\n";
    echo "  Nom : {$user->getFullName()}\n";
    echo "  Email : {$user->getEmail()}\n";
    echo "  Âge : {$user->getAge()}\n";
    echo "  Rôle : {$user->getRole()}\n";
}

function displayStudent($student)
{
    echo "\n  ID : {$student->getId()}\n";
    echo "  Nom : {$student->getFullName()}\n";
    echo "  Email : {$student->getEmail()}\n";
    echo "  Âge : {$student->getAge()}\n";
    echo "  Classe : {$student->getClassName()}\n";
}

function displayFormateur($formateur)
{
    echo "\n  ID : {$formateur->getId()}\n";
    echo "  Nom : {$formateur->getFullName()}\n";
    echo "  Email : {$formateur->getEmail()}\n";
    echo "  Âge : {$formateur->getAge()}\n";
    echo "  Spécialité : {$formateur->getSpeciality()}\n";
}

// Connexion
printHeader("Systeme de Gestion Universitaire");
echo "Veuillez vous connecter pour continuer.\n\n";

do {
    $email = readInput("Email : ");
    $password = readInput("Mot de passe : ");

    try {
        $user = $authService->login($email, $password);
        echo "\n✓ Connexion réussie ! Bienvenue, {$user->getFullName()}\n";
        break;
    } catch (ValidationException | AuthorizationException $e) {
        echo "\n✗ Erreur : {$e->getMessage()}\n\n";
    }
} while (true);

// Menu principal
while (true) {
    clearScreen();
    printHeader("Menu Principal");
    echo "Connecté en tant que : {$user->getFullName()} ({$user->getRole()})\n\n";

    if ($user->isAdmin()) {
        $menuOptions = [
            '1' => 'Gerer les Utilisateurs',
            '2' => 'Gerer les Étudiants',
            '3' => 'Gerer les Formateurs',
            '0' => 'Deconnexion et Quitter'
        ];
    } else {
        $menuOptions = [
            '1' => 'Voir les etudiants',
            '2' => 'Voir les Formateurs',
            '0' => 'deconnexion et Quitter'
        ];
    }

    printMenu($menuOptions);
    $choice = readInput("Votre choix : ");

    try {
        if ($user->isAdmin()) {
            switch ($choice) {
                case '1':
                    manageUsers($userService, $authService);
                            break;
                case '2':
                    manageStudents($studentService, $authService, true);
                            break;
                case '3':
                    manageFormateurs($formateurService, $authService, true);
                                break;
                case '0':
                    echo "\nGoodbye!\n";
                    exit(0);
                default:
                    echo "\n✗ Invalid choice. Please try again.\n";
                    sleep(1);
            }
        } else {
            switch ($choice) {
                case '1':
                    viewStudents($studentService);
                    break;
                case '2':
                    viewFormateurs($formateurService);
                            break;
                case '0':
                    echo "\nGoodbye!\n";
                    exit(0);
                default:
                    echo "\n✗ Invalid choice.\n";
                    sleep(1);
            }
        }
    } catch (ValidationException | AuthorizationException $e) {
        echo "\n✗ Erreur : {$e->getMessage()}\n";
        readInput("\nAppuyez sur Entree pour continuer...");
    }
}

function manageUsers($userService, $authService)
{
    while (true) {
        clearScreen();
        printHeader("Gestion des Utilisateurs");
        printMenu([
            '1' => 'Creer un Utilisateur',
            '2' => 'Lister tous les Utilisateurs',
            '3' => 'Voir un Utilisateur par ID',
            '4' => 'Modifier un Utilisateur',
            '5' => 'Supprimer un Utilisateur',
            '0' => 'Retour au Menu Principal'
        ]);

        $choice = readInput("Votre choix : ");

        try {
            switch ($choice) {
                case '1':
                    $firstName = readInput("Prenom : ");
                    $lastName = readInput("Nom : ");
                    $email = readInput("Email : ");
                    $age = readInt("Âge : ");
                    $password = readInput("Mot de passe : ");
                    echo "Rôle (admin/academic) [academic] : ";
                    $role = trim(fgets(STDIN)) ?: 'academic';

                    $user = $userService->create($firstName, $lastName, $email, $age, $password, $role);
                    echo "\n✓ Utilisateur créé avec succès !\n";
                    displayUser($user);
                    readInput("\nAppuyez sur Entrée pour continuer...");
                                break;

                case '2':
                    $users = $userService->findAll();
                    echo "\nTotal Utilisateurs : " . count($users) . "\n";
                    foreach ($users as $u) {
                        displayUser($u);
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '3':
                    $id = readInt("ID Utilisateur : ");
                    $user = $userService->findById($id);
                    if ($user) {
                        displayUser($user);
                    } else {
                        echo "\n✗ Utilisateur non trouve.\n";
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '4':
                    $id = readInt("ID Utilisateur : ");
                    echo "Laissez vide pour garder la valeur actuelle.\n";
                    $firstName = readInput("Prénom : ");
                    $lastName = readInput("Nom : ");
                    $email = readInput("Email : ");
                    $ageInput = readInput("Âge : ");
                    $password = readInput("Mot de passe : ");
                    $role = readInput("Rôle (admin/academic) : ");

                    // Si vide, on garde null (pas de modification)
                    $age = empty($ageInput) ? null : (int)$ageInput;
                    $user = $userService->update(
                        $id,
                        empty($firstName) ? null : $firstName,
                        empty($lastName) ? null : $lastName,
                        empty($email) ? null : $email,
                        $age,
                        empty($password) ? null : $password,
                        empty($role) ? null : $role
                    );
                    echo "\n✓ Utilisateur modifié avec succès !\n";
                    displayUser($user);
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '5':
                    $id = readInt("ID Utilisateur : ");
                    $confirm = readInput("Êtes-vous sûr ? (oui/non) : ");
                    if (strtolower($confirm) === 'oui') {
                        if ($userService->delete($id)) {
                            echo "\n✓ Utilisateur supprimé avec succès !\n";
                        }
                    } else {
                        echo "\nSuppression annulée.\n";
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                break;

                case '0':
                    return;
                        default:
                    echo "\n✗ Choix invalide.\n";
                    sleep(1);
            }
        } catch (ValidationException | AuthorizationException $e) {
            echo "\n✗ Erreur : {$e->getMessage()}\n";
            readInput("\nAppuyez sur Entrée pour continuer...");
        }
    }
}

function manageStudents($studentService, $authService, $isAdmin)
{
    while (true) {
        clearScreen();
        printHeader("Gestion des Étudiants");
        $menu = [
            '1' => 'Lister tous les Étudiants',
            '2' => 'Voir un Étudiant par ID',
        ];
        if ($isAdmin) {
            $menu['3'] = 'Créer un Étudiant';
            $menu['4'] = 'Modifier un Étudiant';
            $menu['5'] = 'Supprimer un Étudiant';
        }
        $menu['0'] = 'Retour au Menu Principal';
        printMenu($menu);

        $choice = readInput("Votre choix : ");

        try {
            switch ($choice) {
                case '1':
                    $students = $studentService->findAll();
                    echo "\nTotal Étudiants : " . count($students) . "\n";
                    foreach ($students as $student) {
                        displayStudent($student);
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '2':
                    $id = readInt("ID Étudiant : ");
                    $student = $studentService->findById($id);
                    if ($student) {
                        displayStudent($student);
                    } else {
                        echo "\n✗ Étudiant non trouvé.\n";
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '3':
                    if (!$isAdmin) break;
                    $firstName = readInput("Prénom : ");
                    $lastName = readInput("Nom : ");
                    $email = readInput("Email : ");
                    $age = readInt("Âge : ");
                    $className = readInput("Nom de la Classe : ");

                    $student = $studentService->create($firstName, $lastName, $email, $age, $className);
                    echo "\n✓ Étudiant créé avec succès !\n";
                    displayStudent($student);
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '4':
                    if (!$isAdmin) break;
                    $id = readInt("ID Étudiant : ");
                    echo "Laissez vide pour garder la valeur actuelle.\n";
                    $firstName = readInput("Prénom : ");
                    $lastName = readInput("Nom : ");
                    $email = readInput("Email : ");
                    $ageInput = readInput("Âge : ");
                    $className = readInput("Nom de la Classe : ");

                    // Si vide, on garde null (pas de modification)
                    $age = empty($ageInput) ? null : (int)$ageInput;
                    $student = $studentService->update(
                        $id,
                        empty($firstName) ? null : $firstName,
                        empty($lastName) ? null : $lastName,
                        empty($email) ? null : $email,
                        $age,
                        empty($className) ? null : $className
                    );
                    echo "\n✓ Étudiant modifié avec succès !\n";
                    displayStudent($student);
                    readInput("\nAppuyez sur Entrée pour continuer...");
                            break;

                case '5':
                    if (!$isAdmin) break;
                    $id = readInt("ID Étudiant : ");
                    $confirm = readInput("Êtes-vous sûr ? (oui/non) : ");
                    if (strtolower($confirm) === 'oui') {
                        if ($studentService->delete($id)) {
                            echo "\n✓ Étudiant supprimé avec succès !\n";
                        }
                    } else {
                        echo "\nSuppression annulée.\n";
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                break;

                case '0':
                    return;
                                    default:
                    echo "\n✗ Choix invalide.\n";
                    sleep(1);
            }
        } catch (ValidationException | AuthorizationException $e) {
            echo "\n✗ Erreur : {$e->getMessage()}\n";
            readInput("\nAppuyez sur Entrée pour continuer...");
        }
    }
}

function manageFormateurs($formateurService, $authService, $isAdmin)
{
    while (true) {
        clearScreen();
        printHeader("Gestion des Formateurs");
        $menu = [
            '1' => 'Lister tous les Formateurs',
            '2' => 'Voir un Formateur par ID',
        ];
        if ($isAdmin) {
            $menu['3'] = 'Créer un Formateur';
            $menu['4'] = 'Modifier un Formateur';
            $menu['5'] = 'Supprimer un Formateur';
        }
        $menu['0'] = 'Retour au Menu Principal';
        printMenu($menu);

        $choice = readInput("Votre choix : ");

        try {
            switch ($choice) {
                case '1':
                    $formateurs = $formateurService->findAll();
                    echo "\nTotal Formateurs : " . count($formateurs) . "\n";
                    foreach ($formateurs as $formateur) {
                        displayFormateur($formateur);
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                                        break;

                case '2':
                    $id = readInt("ID Formateur : ");
                    $formateur = $formateurService->findById($id);
                    if ($formateur) {
                        displayFormateur($formateur);
                    } else {
                        echo "\n✗ Formateur non trouvé.\n";
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                                        break;

                case '3':
                    if (!$isAdmin) break;
                    $firstName = readInput("Prénom : ");
                    $lastName = readInput("Nom : ");
                    $email = readInput("Email : ");
                    $age = readInt("Âge : ");
                    $speciality = readInput("Spécialité : ");

                    $formateur = $formateurService->create($firstName, $lastName, $email, $age, $speciality);
                    echo "\n✓ Formateur créé avec succès !\n";
                    displayFormateur($formateur);
                    readInput("\nAppuyez sur Entrée pour continuer...");
                                        break;

                case '4':
                    if (!$isAdmin) break;
                    $id = readInt("ID Formateur : ");
                    echo "Laissez vide pour garder la valeur actuelle.\n";
                    $firstName = readInput("Prénom : ");
                    $lastName = readInput("Nom : ");
                    $email = readInput("Email : ");
                    $ageInput = readInput("Âge : ");
                    $speciality = readInput("Spécialité : ");

                    // Si vide, on garde null (pas de modification)
                    $age = empty($ageInput) ? null : (int)$ageInput;
                    $formateur = $formateurService->update(
                        $id,
                        empty($firstName) ? null : $firstName,
                        empty($lastName) ? null : $lastName,
                        empty($email) ? null : $email,
                        $age,
                        empty($speciality) ? null : $speciality
                    );
                    echo "\n✓ Formateur modifié avec succès !\n";
                    displayFormateur($formateur);
                    readInput("\nAppuyez sur Entrée pour continuer...");
                                        break;

                case '5':
                    if (!$isAdmin) break;
                    $id = readInt("ID Formateur : ");
                    $confirm = readInput("Êtes-vous sûr ? (oui/non) : ");
                    if (strtolower($confirm) === 'oui') {
                        if ($formateurService->delete($id)) {
                            echo "\n✓ Formateur supprimé avec succès !\n";
                        }
                    } else {
                        echo "\nSuppression annulée.\n";
                    }
                    readInput("\nAppuyez sur Entrée pour continuer...");
                break;

                case '0':
                    return;
                default:
                    echo "\n✗ Choix invalide.\n";
                    sleep(1);
            }
        } catch (ValidationException | AuthorizationException $e) {
            echo "\n✗ Erreur : {$e->getMessage()}\n";
            readInput("\nAppuyez sur Entrée pour continuer...");
        }
    }
}

function viewStudents($studentService)
{
    clearScreen();
    printHeader("Liste des Étudiants");
    $students = $studentService->findAll();
    echo "\nTotal Étudiants : " . count($students) . "\n";
    foreach ($students as $student) {
        displayStudent($student);
    }
    readInput("\nAppuyez sur Entrée pour continuer...");
}

function viewFormateurs($formateurService)
{
    clearScreen();
    printHeader("Liste des Formateurs");
    $formateurs = $formateurService->findAll();
    echo "\nTotal Formateurs : " . count($formateurs) . "\n";
    foreach ($formateurs as $formateur) {
        displayFormateur($formateur);
    }
    readInput("\nAppuyez sur Entree pour continuer...");
}
