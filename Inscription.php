<?php
$serveur = "localhost";
$dbname = "Projet";
$user = "root";
$pass = "root";

$nom = valid_donnees($_POST["nom"]);
$prenom = valid_donnees($_POST["prenom"]);
$adresse = valid_donnees($_POST["adresse"]);
$telephone = valid_donnees($_POST["tel"]);
$username = valid_donnees($_POST["username"]);
$password = valid_donnees($_POST["mdp"]);
$password2 = valid_donnees($_POST["mdp2"]);
$type = 2;
echo 'ok';

function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}  
     
echo $username."<BR>";
echo $password."<BR>";
/*
if (isset($_POST['inscription']) && $_POST['inscription'] == 'Inscription'){
echo 'ok';
if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['mdp']) && !empty($_POST['mdp'])) && (isset($_POST['mdp2']) && !empty($_POST['mdp2']))) {
    if ($_POST['mdp'] != $_POST['mdp2']{
        echo 'Erreur, les deux mots de passe entrés sont différents.';
        echo"<br/><a href=\"Accueuil.php\">Accueuil</a>";exit();}
    })
    else {
        
    }
}
*/
try{
    //On se connecte à la BDD
    $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $dbco->prepare("
INSERT INTO Utilisateur(NOM, PRENOM, ADRESSE, TELEPHONE, USERNAME, PASSWORD, TYPE)
VALUES(:nom, :prenom, :adresse, :telephone, :username, :password, :type)");

$sth->bindParam(':nom',$nom);
$sth->bindParam(':prenom',$prenom);
$sth->bindParam(':adresse',$adresse);
$sth->bindParam(':telephone',$telephone);
$sth->bindParam(':username',$username);
$sth->bindParam(':password',$password);
$sth->bindParam(':type', $type);
echo 'ok';
$sth->execute();
header("Location: Connexion.php");
    
}
catch(PDOException $e){
    echo 'Impossible d inserer les données. Erreur : '.$e->getMessage();
}

?>