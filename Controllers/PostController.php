<?php
require_once 'Models/PostModel.php';

class PostController {
    private $postModel;

    public function __construct($pdo) {
        $this->postModel = new PostModel($pdo);
    }

    // Afficher le formulaire et gérer la création de messages
    public function create() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $titre = htmlspecialchars(trim($_POST['titre']));
            $contenu = htmlspecialchars(trim($_POST['contenu']));
            $utilisateur_id = $_SESSION['user_id'];

            // Ajouter le message à la base de données
            if ($this->postModel->createPost($titre, $contenu, $utilisateur_id)) {
                header("Location: index.php?action=Messages");
                exit();
            } else {
                $error = "Erreur lors de la création du message.";
                require 'views/creer_post.php';
            }
        } else {
            require 'views/creer_post.php';
        }
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
    
        // Récupérer tous les messages
        $messages = $this->postModel->getAllPosts();
    
        // Charger la vue
        require 'views/Messages.php';
    }


    public function delete() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
    
        $id = $_GET['id'];
        $utilisateur_id = $_SESSION['user_id'];
    
        if ($this->postModel->deletePost($id, $utilisateur_id)) {
            header("Location: index.php?action=messages");
            exit();
        } else {
            $error = "Erreur lors de la suppression.";
            header("Location: index.php?action=messages&error=" . urlencode($error));
        }
    }
}
