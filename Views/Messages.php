<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des messages</title>
</head>
<body>
    <h1>Liste des messages</h1>
    <a href="index.php?action=create_post">Créer un message</a>
    
    <?php if (!empty($messages)): ?>
        <ul>
            <?php foreach ($messages as $message): ?>
                <li>
                    <h2><?= htmlspecialchars($message['titre']); ?></h2>
                    <p><?= nl2br(htmlspecialchars($message['contenu'])); ?></p>
                    <p>
                        Posté par <?= htmlspecialchars($message['nom']); ?> 
                        le <?= htmlspecialchars($message['date_publication']); ?>
                    </p>
                    <a href="index.php?action=add_comment&post_id=<?= $message['id']; ?>">Ajouter un commentaire</a>
                    <?php if ($_SESSION['user_id'] == $message['utilisateur_id']): ?>
                        <a href="index.php?action=edit_post&id=<?= $message['id']; ?>">Modifier</a>
                        <a href="index.php?action=delete_post&id=<?= $message['id']; ?>" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">Supprimer</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun message disponible.</p>
    <?php endif; ?>
</body>
</html>
