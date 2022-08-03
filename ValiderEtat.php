<?php
try
{
   
   //ouverture de la connexion a la Bdd
   $pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');

   //Commande lancée pour changer l'état de la commande choisie
   $pdoStat = $pdo->prepare('UPDATE commande SET ETAT=\''.$_POST['etat'].'\' WHERE ID_COMMANDE=\''.$_POST['id'].'\'');
   $pdoStat->execute();
   header('Location: AccueuilAdmin.php');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}

?>

