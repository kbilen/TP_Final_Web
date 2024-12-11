<?php
class PostModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un nouveau message
    public function createPost($titre, $contenu, $utilisateur_id) {
        $stmt = $this->pdo->prepare("INSERT INTO posts (titre, contenu, utilisateur_id) VALUES (:titre, :contenu, :utilisateur_id)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':contenu', $contenu);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        return $stmt->execute();
    }

    public function getAllPosts() {
        $stmt = $this->pdo->prepare("
            SELECT posts.id, posts.titre, posts.contenu, posts.date_publication, users.nom 
            FROM posts 
            JOIN users ON posts.utilisateur_id = users.id
            ORDER BY posts.date_publication DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletePost($id, $utilisateur_id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM posts 
            WHERE id = :id AND utilisateur_id = :utilisateur_id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        return $stmt->execute();
    }
}
