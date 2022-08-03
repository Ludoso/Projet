<?php
    $serveur = "localhost";
    $dbname = "Projet";
    $user = "root";
    $pass = "root";
    
    $nom = valid_donnees($_POST["Nom"]);
    $description = valid_donnees($_POST["Description"]);
    $categorie = valid_donnees($_POST["categorie"]);
    $prix = valid_donnees($_POST["Prix"]);
    $quantite = valid_donnees($_POST["Quantite"]);

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }  
         
    echo $nom."<BR>";
    echo $description."<BR>";
    echo $categorie."<BR>";
    echo $prix."<BR>";
    echo $quantite."<BR>";




    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbco->prepare("
            INSERT INTO Article(NOM, PRIX, DESCRIPTION, QUANTITE, CATEGORIE)
            VALUES(:nom, :prix, :description, :quantite, :categorie)");
        $sth->bindParam(':nom',$nom);
        $sth->bindParam(':prix',$prix);
        $sth->bindParam(':description',$description);
        $sth->bindParam(':quantite',$quantite);
        $sth->bindParam(':categorie',$categorie);
        $sth->execute();

        header("Location: ModifierProduit.php");

        echo 'Le nouvel jeu a bien été inséré dans la base de données';
        }
    catch(PDOException $e){
        echo 'Impossible d inserer les données. Erreur : '.$e->getMessage();
    }
?>