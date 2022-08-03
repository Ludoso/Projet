<?php
try
{
   session_start();
   //ouverture de la connexion a la Bdd
   $pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
   $pdoStat = $pdo->prepare('UPDATE utilisateur SET NOM=\''.$_POST['nom'].'\', PRENOM=\''.$_POST['prenom'].'\', USERNAME=\''.$_POST['username'].'\', ADRESSE=\''.$_POST['adresse'].'\', PASSWORD=\''.$_POST['password'].'\', TELEPHONE=\''.$_POST['telephone'].'\' WHERE username=\''.$_SESSION['username'].'\'');
   $pdoStat->execute();
   header('Location: Profil.php');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}