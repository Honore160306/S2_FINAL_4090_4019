<?php
session_start();
require("../inc/functions.php");

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$mdp = isset($_SESSION['mdp']) ? $_SESSION['mdp'] : '';

$queryMembre = "SELECT * FROM emprunts_membre WHERE email='$email' AND mdp='$mdp'";
$resultMembre = mysqli_query(dbconnect(), $queryMembre);
$membre = mysqli_fetch_assoc($resultMembre);


$queryObjets = "SELECT obj.nom_objet, obj.id_objet, cat.nom_categorie, emp.date_emprunt, emp.date_retour
    FROM emprunts_objet obj
    INNER JOIN emprunts_emprunt emp ON obj.id_objet = emp.id_objet
    INNER JOIN emprunts_categorie_objet cat ON obj.id_categorie = cat.id_categorie
    WHERE obj.id_membre = '{$membre['id_membre']}'";
$resultObjets = mysqli_query(dbconnect(), $queryObjets);


$objetsParCategorie = [];
while ($row = mysqli_fetch_assoc($resultObjets)) {
    $cat = $row['nom_categorie'];
    if (!isset($objetsParCategorie[$cat])) {
        $objetsParCategorie[$cat] = [];
    }
    $objetsParCategorie[$cat][] = $row;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche du membre</title>
</head>
<body>
    <h1>Information du membre</h1>
    <?php if ($membre) { ?>
        <p>Nom: <?= $membre['nom'] ?></p>
        <p>Email: <?= $membre['email'] ?></p>
        <p>Genre: <?= $membre['genre'] ?></p>
        <p>Date de naissance: <?= $membre['date_naissance'] ?></p>
        <p>Ville: <?= $membre['ville'] ?></p>

        <h2>Objets empruntés (regroupés par catégorie)</h2>
        <?php if (!empty($objetsParCategorie)) { ?>
            <?php foreach ($objetsParCategorie as $categorie => $objets) { ?>
                <h3><?= $categorie ?></h3>
                <table border="1">
                    <tr>
                        <th>Nom de l'objet</th>
                        <th>Date d'emprunt</th>
                        <th>Date de retour</th>
                    </tr>
                    <?php foreach ($objets as $obj) { ?>
                    <tr>
                        <td><?= $obj['nom_objet'] ?></td>
                        <td><?= $obj['date_emprunt'] ?></td>
                        <td><?= $obj['date_retour'] ?></td>
                    </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        <?php } else { ?>
            <p>Aucun objet emprunté.</p>
        <?php } ?>
    <?php } else { ?>
        <p style="color:red;">Aucun membre trouvé. Veuillez vous connecter.</p>
    <?php } ?>
</body>
</html>