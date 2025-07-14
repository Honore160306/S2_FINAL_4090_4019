<?php
session_start();
require("../inc/functions.php");

$email = $_SESSION['email'];
$mdp = $_SESSION['mdp'];

$getObjet=getObjet();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Objets</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <table>
        <tr>
            <th>Nom Objet</th>
            <th>Date emprunt</th>
            <th>Date retour</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($getObjet)) { ?>
        <tr>
            <td><?= $row['nom_objet'] ?></td>
            <td><?= $row['date_emprunt'] ?></td>
            <td><?= $row['date_retour'] ?></td>
        </tr>
        <?php } ?>

    </table>
</body>

</html>