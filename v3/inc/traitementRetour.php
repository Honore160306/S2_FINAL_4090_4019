<?php
require("functions.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_objet'], $_POST['etat'])) {
    $id_objet = intval($_POST['id_objet']);
    $etat = ($_POST['etat'] === 'abimer') ? 'abimer' : 'ok';

    $query = "SELECT id_membre FROM emprunts_objet WHERE id_objet = $id_objet";
    $result = mysqli_query(dbconnect(), $query);
    $row = mysqli_fetch_assoc($result);
    $id_membre = $row ? $row['id_membre'] : null;

    if ($id_membre) {
        enregistrerEtatRetour($id_objet, $id_membre, $etat);
    }

    supprimerEmprunt($id_objet);

    header("Location: ../pages/ficheMembre.php");
    exit();
} else {
    echo "Requête invalide.";
}
