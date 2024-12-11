<?php
require_once 'Models/connectDb.php';
require_once 'Controllers/UserController.php';
require_once 'Controllers/PostController.php'; 

$postController = new PostController($pdo); 

// Récupérer l'action depuis l'URL (par défaut, on charge la page de connexion)
$action = isset($_GET['action']) ? $_GET['action'] : 'register';

// Instancier les contrôleurs
$userController = new UserController($pdo);

// Gérer l'action via un switch
switch ($action) {
    case 'login':
        // Afficher la page de connexion
        $userController->login();
        break;

    case 'register':
        // Afficher la page d'inscription
        $userController->register();
        break;

    case 'messages':
        // Afficher la page des messages
        $postController->index(); 
        break;

    case 'edit_post':
        $postController->edit();
        break;

    case 'delete_post':
        $postController->delete();
        break;   

    default:
        // Par défaut, rediriger vers la page de connexion
        $userController->register();
        break;
}