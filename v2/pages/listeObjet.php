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
</head>

<body>
    <form action="objetCategorie.php" method="POST">
        <select name="categorie">
            <?php while ($row = mysqli_fetch_assoc($getCategorie)) { ?>
                <option value="<?= $row['nom_categorie'] ?>"><?= $row['nom_categorie'] ?></option>
            <?php } ?>
        </select>
        <button type="submit">Valider</button>
    </form>

    <br>
    <h2 style="color: cadetblue">Ajout</h2>
    <hr>
    <form action="../inc/traitementPub.php" method="POST" enctype="multipart/form-data">
        <p>Nom de l'objet: <input type="text" name="nomObjet"></p>
        <p>Id catégorie: <input type="text" name="categorie"></p>
        <input type="file" name="nomImage" accept="image/*">
        <input type="submit" value="Ajouter">
    </form>
    <hr>
    <br>
    
    <aside>
        <a href="ficheMembre.php">Fiche du Membre</a>
    </aside>

    <h1 style="color: cadetblue">Recherche</h1>
    <form action="resultatRecherche.php" method="POST">
        <p>Categorie:<input type="text" name="rechercheCategorie" placeholder="categorie"></p>
        <p>Objet:<input type="text" name="rechercheObjet" placeholder="objet"></p>
        <button type="submit">Rechercher</button>

    <br>
    <br>

    <table border="2px solid black">
        <tr>
            <th>Nom Objet</th>
            <th>Date emprunt</th>
            <th>Date retour</th>
            <th>Categorie</th>
            <th>Image</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($getObjet)) { ?>
            <tr>    
                <td><a href="ficheObjet.php?nomObjet=<?= $row['nom_objet'] ?>"><?= $row['nom_objet'] ?></a></td>
                <td><?= $row['date_emprunt'] ?></td>
                <td><?= $row['date_retour'] ?></td>
                <td><?= $row['nom_categorie'] ?></td>
                <td><img src="../assets/images/<?= $row['nom_image'] ?>" alt="" width="10%" style="margin-left:560px"></td>
            </tr>
        <?php } ?>

    </table>
</body>

</html>