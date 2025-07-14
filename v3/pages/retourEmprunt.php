<?php
require("../inc/functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_objet'])) {
    $id_objet = intval($_POST['id_objet']);
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Retour de l'objet</title>
        <style>
            body { background: #f8f9fa; font-family: Arial, sans-serif; }
            .box { margin: 100px auto; width: 350px; background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px #ccc; text-align: center; }
            button { margin: 10px 20px; padding: 10px 30px; border-radius: 5px; border: none; font-size: 1.1em; cursor: pointer; }
            .ok { background: #4caf50; color: #fff; }
            .abimer { background: #e53935; color: #fff; }
        </style>
    </head>
    <body>
        <div class="box">
            <h2>Dans quel état rendez-vous cet objet ?</h2>
            <form method="post" action="../inc/traitementRetour.php" style="display:inline;">
                <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
                <input type="hidden" name="etat" value="ok">
                <button type="submit" class="ok">OK</button>
            </form>
            <form method="post" action="../inc/traitementRetour.php" style="display:inline;">
                <input type="hidden" name="id_objet" value="<?= $id_objet ?>">
                <input type="hidden" name="etat" value="abimer">
                <button type="submit" class="abimer">Abîmé</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit();
} else {
    echo "Requête invalide.";
}
