<?php
    require("connection.php");
    function insertInc($nom, $date_naissance, $genre, $email, $ville, $mdp){
        $query=sprintf("INSERT INTO `emprunts_membre` (`nom`, `date_naissance`, `genre`, `email`, `ville`, `mdp`, `image_profil`) VALUES ('%s', '%s', '%s', '%s', '%s')",
            $nom, $date_naissance, $genre, $email, $ville, $mdp, NULL 
        );
        mysqli_query(dbconnect(), $query);
    }

    function getObjet(){
        $query="SELECT * 
        FROM emprunts_objet obj
        INNER JOIN emprunts_emprunt emp ON obj.id_objet = emp.id_objet";
        $result=mysqli_query(dbconnect(), $query);
        return $result;
    }
    ?>