<?php
    require("connection.php");
    function insertInc($nom, $date_naissance, $genre, $email, $ville, $mdp){
        $query=sprintf("INSERT INTO `emprunts_membre` (`nom`, `date_naissance`, `genre`, `email`, `ville`, `mdp`, `image_profil`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $nom, $date_naissance, $genre, $email, $ville, $mdp, NULL 
        );
        mysqli_query(dbconnect(), $query);
    }

    function getObjet(){
        $query="SELECT * 
        FROM emprunts_objet obj
        INNER JOIN emprunts_emprunt emp ON obj.id_objet = emp.id_objet
        INNER JOIN emprunts_categorie_objet catObj ON obj.id_categorie = catObj.id_categorie
        INNER JOIN emprunts_images_objet imgObj ON obj.id_objet = imgObj.id_objet
        ";
        $result=mysqli_query(dbconnect(), $query);
        return $result;
    }

    function getCategorie(){
        $query="SELECT * FROM emprunts_categorie_objet";
        $result=mysqli_query(dbconnect(), $query);
        return $result;
    }
    ?>