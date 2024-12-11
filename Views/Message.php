<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un message</title>
</head>
<body>
    <h1>Créer un nouveau message</h1>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="POST" action="index.php?action=create_post">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required>
        <br>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea>
        <br>

        <button type="submit">Publier</button>
    </form>
</body>
</html>
