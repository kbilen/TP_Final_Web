<?php
require_once 'Models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    // Gestion de l'inscription
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $nom = htmlspecialchars(trim($_POST['nom']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = $_POST['password'];

            // Vérifier si l'email existe déjà
            if ($this->userModel->isEmailExists($email)) {
                $error = "Cet email est déjà utilisé.";
                require 'Views/inscription.php'; // Afficher l'erreur dans la vue
                return;
            }

            // Hachage du mot de passe
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Créer l'utilisateur
            if ($this->userModel->createUser($nom, $email, $password_hash)) {
                header("Location: index.php?action=login");
                exit();
            } else {
                $error = "Erreur lors de l'inscription. Veuillez réessayer.";
                require 'Views/inscription.php'; // Afficher l'erreur dans la vue
                return;
            }
        } else {
            require 'Views/inscription.php'; // Afficher le formulaire d'inscription
        }
    }   

    // Gestion de la connexion
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupérer les données du formulaire
            $email = htmlspecialchars(trim($_POST['email']));
            $password = $_POST['password'];

            // Vérifier si l'utilisateur existe
            $user = $this->userModel->getUserByEmail($email);
            if ($user) {
                // Vérifier si le mot de passe est correct
                if (password_verify($password, $user['password'])) {
                    // Authentification réussie : création des variables de session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['nom'];

                    // Redirection vers la page principale (ex. dashboard.php ou messages.php)
                    header("Location: Messages.php");
                    exit();
                } else {
                    $error = "Mot de passe incorrect.";
                }
            } else {
                $error = "Aucun utilisateur trouvé avec cet email.";
            }
        }

        // Afficher la vue de connexion
        require 'Views/Connexion.php';
    }
}
