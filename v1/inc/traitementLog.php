<?php 
    session_start();
    require("../inc/functions.php");

    if (isset($_POST['email']) && isset($_POST['mdp'])) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['mdp'] = $_POST['mdp'];
    }

    $email = $_SESSION['email'];
    $mdp = $_SESSION['mdp'];

    $query = "SELECT id_membre FROM emprunts_membre WHERE email='$email' AND mdp='$mdp'";
    $result = mysqli_query(dbconnect(), $query);

    if (mysqli_num_rows($result) > 0) {
        header("Location: ../pages/listeObjet.php");
    } else {
        header("Location: ../pages/formulaire.php?erreur=1");
    }
?>