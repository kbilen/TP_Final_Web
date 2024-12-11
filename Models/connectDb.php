<?php 
try {
    // Connexion à la base de données
    $host = '127.0.0.1';
    $dbname = 'Entreprise';
    $user = 'root'; 
    $password = 'mariadb';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
