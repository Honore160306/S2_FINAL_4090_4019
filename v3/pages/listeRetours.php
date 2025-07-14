<?php
require("../inc/functions.php");
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Liste des retours d'objets</title>
        <style>
            body { background: #f8f9fa; font-family: Arial, sans-serif; }
            table { margin: 40px auto; border-collapse: collapse; width: 90%; background: #fff; }
            th, td { padding: 10px 15px; border: 1px solid #ccc; text-align: center; }
            th { background: #e3e3e3; color: #333; }
            h1 { color: cadetblue; text-align: center; }
            .ok { color: #388e3c; font-weight: bold; }
            .abimer { color: #d32f2f; font-weight: bold; }
            </style>
</head>
<body>
    <h1>Liste des objets rendus</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom de l'objet</th>
            <th>Membre</th>
            <th>État</th>
            <th>Date de retour</th>
        </tr>
        <?php $result = getAllRetours();?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id_etat'] ?></td>
            <td><?= $row['nom_objet'] ?></td>
            <td class="<?= $row['etat'] ?>"><?= $row['etat'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
