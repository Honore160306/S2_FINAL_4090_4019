<?php 
    session_start();

    $_SESSION['idObjet']=$_GET['idObjet'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunter</title>
</head>
<body>
    <form action="../inc/traitEmprunt.php" method="post">
        <p>Nombre de jour à emprunter: <input type="text" nom="jour"></p>
        <button type="submit">Emprunter</button>
    </form>
</body>
</html>