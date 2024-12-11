<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Vérifier si l'email existe déjà
    public function isEmailExists($email) {
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    // Créer un nouvel utilisateur
    public function createUser($nom, $email, $password_hash) {
        $stmt = $this->pdo->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hash);
        return $stmt->execute();
    }


    // Récupérer l'utilisateur par email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un utilisateur ou false
    }
}