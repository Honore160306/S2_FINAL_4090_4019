<?php
    session_start();
    require("functions.php");

    $_SESSION['email']=$_POST['email'];
    $_SESSION['mdp']=$_POST['mdp'];
    $email = $_SESSION['email'];
    $mdp = $_SESSION['mdp'];

    $idMembre = getIdMembre($email, $mdp);

    setDateEmprunt($_SESSION['idObjet'], $idMembre, $_POST['jour']);

    header("Location: ../pages/listeObjet.php");
?>