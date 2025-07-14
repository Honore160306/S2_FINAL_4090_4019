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
                        <th>Action</th>
                    </tr>
                    <?php foreach ($objets as $obj) { ?>
                    <tr>
                        <td><?= $obj['nom_objet'] ?></td>
                        <td><?= $obj['date_emprunt'] ?></td>
                        <td><?= $obj['date_retour'] ?></td>
                        <td>
                            <form method="post" action="retourEmprunt.php" style="margin:0;">
                                <input type="hidden" name="id_objet" value="<?= $obj['id_objet'] ?>">
                                <button type="submit">Retour</button>
                            </form>
                        </td>
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