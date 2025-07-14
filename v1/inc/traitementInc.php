<?php
    session_start();
    require("functions.php");

    insertInc($_POST['nom'], $_POST['dateNaissance'], $_POST['genre'], $_POST['email'], $_POST['ville'], $_POST['mdp']);

    $_SESSION['email']=$_POST['email'];
    $_SESSION['mdp']=$_POST['mdp'];

    header("Location: ../pages/formulaire.php");
?>