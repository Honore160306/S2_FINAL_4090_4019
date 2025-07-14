<?php
session_start();
require("../inc/functions.php");

$email = $_SESSION['email'];
$mdp = $_SESSION['mdp'];

$getObjet=getObjet();
$getCategorie=getCategorie();
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
    <form action="objetCategorie.php" method="POST">
        <select name="categorie" >
            <?php while ($row = mysqli_fetch_assoc($getCategorie)) { ?>
            <option value="<?= $row['nom_categorie'] ?>" ><?= $row['nom_categorie'] ?></option>
            <?php } ?>
        </select>
        <button type="submit">Valider</button>
    </form>

    <table>
        <tr>
            <th>Nom Objet</th>
            <th>Date emprunt</th>
            <th>Date retour</th>
            <th>Categorie</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($getObjet)) { ?>
        <tr>
            <td><?= $row['nom_objet'] ?></td>
            <td><?= $row['date_emprunt'] ?></td>
            <td><?= $row['date_retour'] ?></td>
            <td><?= $row['nom_categorie'] ?></td>
        </tr>
        <?php } ?>

    </table>
</body>

</html>