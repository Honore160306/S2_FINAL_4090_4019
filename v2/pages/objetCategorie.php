<?php
session_start();
require("../inc/functions.php");
$getObjet=getObjet();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objet par categorie</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../assets/bootstrap-5.3.5-dist/css/bootstrap.min.css">
    <script src="../assets/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h2><?= $_POST['categorie'] ?></h2>

    <br>
    <br>
    <table border="2px solid black">
        <tr>
            <th>Nom Objet</th>
            <th>Date emprunt</th>
            <th>Date retour</th>
            <th>Image</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($getObjet)) { ?>
    <?php if($_POST['categorie']==$row['nom_categorie']){?>
        <tr>
            <td><?= $row['nom_objet'] ?></td>
            <td><?= $row['date_emprunt'] ?></td>
            <td><?= $row['date_retour'] ?></td>
            <td><img src="../assets/images/<?= $row['nom_image'] ?>" alt="" width="10%" style="margin-left:560px"></td>

        </tr>
        <?php } 
    } ?>

    </table>
</body>

</html>