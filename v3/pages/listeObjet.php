<?php
session_start();
require("../inc/functions.php");

$email = $_SESSION['email'];
$mdp = $_SESSION['mdp'];
// $idMembre = getIdMembre($email, $mdp);

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
    </style>
</head>

<body>
    <hr>
    <h2 style="color: cadetblue">Filtrer</h2>
    <form action="objetCategorie.php" method="POST">
        <select name="categorie">
            <?php while ($row = mysqli_fetch_assoc($getCategorie)) { ?>
                <option value="<?= $row['nom_categorie'] ?>"><?= $row['nom_categorie'] ?></option>
            <?php } ?>
        </select>
        <button type="submit">Valider</button>
    </form>
    <hr>

    <br>
    <hr>
    <h2 style="color: cadetblue">Ajout</h2>
    <form action="../inc/traitementPub.php" method="POST" enctype="multipart/form-data">
        <p>Nom de l'objet: <input type="text" name="nomObjet"></p>
        <p>Id catégorie: <input type="text" name="categorie"></p>
        <input type="file" name="nomImage" accept="image/*">
        <input type="submit" value="Ajouter">
    </form>
    <hr>
    <br>
    
    <hr>
    <h2 style="color: cadetblue">Fiche du Membre</h2>
    <aside>
        <a href="ficheMembre.php">Fiche du Membre</a>
    </aside>
    <hr>
    
    <hr>
    <h2 style="color: cadetblue">Recherche</h2>
    <form action="resultatRecherche.php" method="POST">
        <p>Categorie:<input type="text" name="rechercheCategorie" placeholder="categorie"></p>
        <p>Objet:<input type="text" name="rechercheObjet" placeholder="objet"></p>
        <button type="submit">Rechercher</button>
    </form>
    <hr>
    <br>
    <br>

    <h2 style="color: cadetblue">Liste des objets</h2>
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
                <td><a href="emprunter.php?idObjet=<?= $row['id_objet'] ?>">Emprunter</a></td>
            </tr>
        <?php } ?>

    </table>
</body>

</html>