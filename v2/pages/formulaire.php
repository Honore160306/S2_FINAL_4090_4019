<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
</head>
<body>
    <hr>
    <h2 style="color: cadetblue">Connexion</h2>
    <form action="../inc/traitementLog.php" method="POST">
        <p>Email: <input type="text" name="email" required></p>
        <p>Mot de passe: <input type="password" name="mdp" required></p>
        <input type="submit" value="Se connecter">
    </form>

    <h2 style="color: cadetblue">Inscription</h2>
    <form action="../inc/traitementInc.php" method="POST">
        <p>Email: <input type="text" name="email" required></p>
        <p>Nom: <input type="text" name="nom" required></p>
        <p>Genre: <input type="text" name="genre" required></p>
        <p>Date de Naissance: <input type="date" name="dateNaissance" required></p>
        <p>Ville: <input type="text" name="ville" required></p>
        <p>Mot de passe: <input type="password" name="mdp" required></p>
        <input type="submit" value="S'inscrire">
    </form>
    <hr>
</body>
</html>