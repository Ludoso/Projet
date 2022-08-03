<?php
try
{
   
   //ouverture de la connexion a la Bdd
   $IDArticle = $_POST['id'];
   $pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
   $pdoStat = $pdo->prepare('UPDATE article SET NOM=\''.$_POST['nom'].'\', DESCRIPTION=\''.$_POST['description'].'\', CATEGORIE=\''.$_POST['categorie'].'\', PRIX=\''.$_POST['prix'].'\', QUANTITE=\''.$_POST['quantite'].'\' WHERE ID=\''.$IDArticle.'\'');
   $pdoStat->execute();
   header('Location: ModifierProduit.php');

}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}
?>
