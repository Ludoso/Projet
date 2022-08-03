<?php
try
{
   
   //ouverture de la connexion a la Bdd
   $db = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}
// Si tout va bien, on peut continuer 
$TypeUtilisateur = 2;
//prepa de la requete
$pdoStat = $db->prepare('SELECT * from Utilisateur WHERE TYPE=\''.$TypeUtilisateur.'\'');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();
?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Utilisateurs</title>

   </head>
   <body>

   <!-- Bandeau du haut de la page -->
   <header>
		<div id="header">
			<div id="logo">
                <a href="AccueuilAdmin.php">
                <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
            <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>
      <h1>Liste des Utilisateurs</h1>
    <table id="customers" border="1" align="center">
        <tr>
            <th>
               Nom
            </th>
            <th>
               Prenom
            </th>
            <th>
               Username
            </th>
            <th>
               Téléphone
            </th>
            <th>
               Adresse mail
            </th>
            <th>
               Modifier
            </th>
        </tr>


        <?php foreach ($mesnoms as $monnom): ?>
        <tr> 
            <td>
                <?= $monnom['NOM'] ?> 
            </td>
            <td>
                <?= $monnom['PRENOM'] ?> 
            </td>  
            <td>
                <?= $monnom['USERNAME'] ?>
            </td>
            <td>
                <?= $monnom['TELEPHONE'] ?>
            </td>
            <td>
                <?= $monnom['ADRESSE'] ?>
            </td>
            <td>
                <? $monlien= "ModifierPersonne.php?ID=".$monnom['ID'] ?>  
                <a href="<? echo $monlien; ?>">Modifier</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<BR><BR><BR><BR>