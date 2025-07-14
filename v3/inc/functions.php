
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

    function supprimerEmprunt($id_objet) {
        $query = "DELETE FROM emprunts_emprunt WHERE id_objet = " . intval($id_objet);
        mysqli_query(dbconnect(), $query);
    }

    function enregistrerEtatRetour($id_objet, $id_membre, $etat) {
        $id_objet = intval($id_objet);
        $id_membre = intval($id_membre);
        $etat = ($etat === 'abimer') ? 'abimer' : 'ok';
        $query = "INSERT INTO emprunts_etat_emprunt (id_objet, id_membre, etat) VALUES ($id_objet, $id_membre, '$etat')";
        mysqli_query(dbconnect(), $query);
    }

    function getAllRetours() {
        $query = "SELECT e.id_etat, o.nom_objet, m.nom AS nom_membre, e.etat, e.date_retour
              FROM emprunts_etat_emprunt e
              INNER JOIN emprunts_objet o ON e.id_objet = o.id_objet
              INNER JOIN emprunts_membre m ON e.id_membre = m.id_membre
              ORDER BY e.date_retour DESC";
        return mysqli_query(dbconnect(), $query);
    }
    ?>