<?php
session_start();
try
{
   
   //ouverture de la connexion a la Bdd
   $pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
   echo "il y a un probleme";
        die('Erreur : ' . $e->getMessage());
}

//Récupération des données du compte à modifier
$pdoStat = $pdo->prepare('SELECT * from Utilisateur where USERNAME=\''.$_SESSION['username'].'\'');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();

?>
<head>
    <title>Modifier son profil</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="monCSS.css">
  </head>
<body>
    <!-- Bandeau de haut de page -->
    <header>
		<div id="header">
			<div id="logo">
                <a href="AccueuilMembre.php">
                <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
                <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>

    <!-- Formulaire de modification des données de l'utilisateur connecté -->
    <form action="ValiderModification.php" method="post">
        <fieldset>
            <?php foreach ($mesnoms as $monnom): ?>
                <legend>Nouvel article</legend>
                <label for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" value="<?php echo $monnom['NOM']; ?>"><br>
                <label for="prenom">Prenom</label>
                    <input id="prenom" type="text" name="prenom" value="<?php echo $monnom['PRENOM']; ?>"><br>
                <label for="username">Nom d'utilisateur</label>
                    <input id="username" type="text" name="username" value="<?php echo $monnom['USERNAME']; ?>"><br>
                <label for="password">Mot de passe</label>
                    <input id="password" type="float" name="password" value="<?php echo $monnom['PASSWORD']; ?>"><br>
                <label for="adresse">Adresse</label>
                    <input id="adresse" type="text" name="adresse" value="<?php echo $monnom['ADRESSE']; ?>"><br>
                <label for="telephone">Téléphone</label>
                    <input id="telephone" type="number" name="telephone" value="<?php echo $monnom['TELEPHONE']; ?>"><br>
            <?php endforeach; ?>  
        </fieldset>
        <input type="submit" value="Enregistrer"><br>
    </form>
</body>