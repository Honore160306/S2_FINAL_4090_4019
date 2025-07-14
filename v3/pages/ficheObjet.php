<?php
session_start();
require("../inc/functions.php");

$email = $_SESSION['email'];
$mdp = $_SESSION['mdp'];

$getObjet = getObjet();
$getCategorie = getCategorie();
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
      <style>
        body { background: #f8f9fa; font-family: Arial, sans-serif; }
        table { margin: 40px auto; border-collapse: collapse; width: 80%; background: #fff; }
        th, td { padding: 10px 15px; border: 1px solid #ccc; text-align: center; }
        th { background: #e3e3e3; color: #333; }
        img { border-radius: 8px; }
        h1, h2, h3 { color: cadetblue; }
        form { margin: 20px auto; width: 60%; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
        input, select, button { margin: 5px 0; padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc; }
    </style>
</head>

<body>
    <table border="2px solid black">
        <tr>
            <th>Nom Objet</th>
            <th>Date emprunt</th>
            <th>Date retour</th>
            <th>Categorie</th>
            <th>Image</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($getObjet)) { 
            if($row['nom_objet']==$_GET['nomObjet']){
            ?>
            <tr>    
                <td><?= $row['nom_objet'] ?></td>
                <td><?= $row['date_emprunt'] ?></td>
                <td><?= $row['date_retour'] ?></td>
                <td><?= $row['nom_categorie'] ?></td>
                <td><img src="../assets/images/<?= $row['nom_image'] ?>" alt="" width="10%" style="margin-left:560px"></td>
            </tr>
        <?php } 
    } ?>

    </table>
</body>

</html>