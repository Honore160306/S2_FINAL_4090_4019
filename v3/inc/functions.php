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

    function getIdMembre($email, $mdp){
        $query = "SELECT id_membre FROM emprunts_membre WHERE email='$email' AND motDePasse='$mdp'";
        $result = mysqli_query(dbconnect(), $query);
        $row = mysqli_fetch_assoc($result);
        return $row['id_membre'];
    }

    function insertPublication($nomObjet, $categorie, $idMembre, $nomImage){
        $query = sprintf("INSERT INTO `emprunts_objet` (`nom_objet`, `id_categorie`, `id_membre`) VALUES ('%s', '%d', '%d')",
        $nomObjet,
        (int)$categorie,
        $idMembre
        );
        mysqli_query(dbconnect(), $query);

        $query = sprintf("INSERT INTO `emprunts_images_objet` (`id_objet`, `nom_image`) VALUES ('%s', '%d', '%d')",
        1,
        $nomImage
        );
        mysqli_query(dbconnect(), $query);
    }

       function getRecherche($rechercheCategorie, $rechercheObjet){
        $query= "SELECT * FROM emprunts_objet obj
        INNER JOIN emprunts_emprunt emp ON obj.id_objet = emp.id_objet
        INNER JOIN emprunts_categorie_objet catObj ON obj.id_categorie = catObj.id_categorie
        INNER JOIN emprunts_images_objet imgObj ON obj.id_objet = imgObj.id_objet
        WHERE catObj.nom_categorie LIKE '%$rechercheCategorie%' AND obj.nom_objet LIKE '%$rechercheObjet%'
        ";
        $result=mysqli_query(dbconnect(), $query);
        return $result;
    }

        function setDateEmprunt($idObjet, $idMembre, $jour){
            $query="UPDATE emprunts_emprunt 
            SET id_Membre=$idMembre, date_emprunt=NOW(), date_retour=NOW()+$jour 
            WHERE id_objet=$idObjet";
            mysqli_query(dbconnect(), $query);
        }
    ?>