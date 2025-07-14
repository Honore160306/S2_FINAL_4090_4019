<?php
require '../inc/functions.php';
session_start();

$email = $_SESSION['email'];
$mdp = $_SESSION['mdp'];
$idMembre = getIdMembre($email, $mdp);

$uploadDir = __DIR__ . '/../assets/images/';
$maxSize = 10 * 1024 * 1024;
$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];

$nomObjet = isset($_POST['nomObjet']) ? $_POST['nomObjet'] : null;
$categorie = isset($_POST['categorie']) ? $_POST['categorie'] : null;
$nomImage = null;

// Vérifie si un fichier est soumis
if (isset($_FILES['nomImage']) && $_FILES['nomImage']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['nomImage'];

    // Vérifie la taille
    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }

    // Vérifie le type MIME avec `finfo`
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    // Renomme le fichier
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    // Déplace le fichier
    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        die("Échec du déplacement du fichier.");
    }

    $nomImage = $newName;
}

// Insère la publication dans la base de données
insertPublication($nomObjet, $categorie, $idMembre, $nomImage);

// Redirige vers la page d'accueil
header("Location: ../pages/accueil.php");
exit();
?>