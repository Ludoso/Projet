<?php
      session_start();
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

      $pdoUtilisateur = $db->prepare('SELECT * from Utilisateur WHERE USERNAME=\''.$_SESSION['username'].'\'');

      $executeUtilisateur = $pdoUtilisateur->execute();

      $Utilisateur = $pdoUtilisateur->fetchAll();
?>

<head>
  <title>Accueuil</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="monCSS.css">
</head>

<body>
<!-- Bandeau du haut de la page -->
<header>
	<div id="header">
		<div id="logo">
                  <a href="AccueuilMembre.php">
                  <img src="logo.jpg" alt="Image" height="40" width="40">
		</div>
            <div id="Utilisateur">
        <?php foreach ($Utilisateur as $UtilisateurNom):
          echo $UtilisateurNom['NOM']. " " .$UtilisateurNom['PRENOM'];
        endforeach;?>
		</div>
		<div id="texte">
        <a href="Profil.php">Profil</a><br>
        <a href="Deconnexion.php">Se déconnecter</a><br>
		</div>
	</div>
</header>

<form method="post" action="Panier.php">

      <fieldset>
            <input type="hidden" id="produit" name="produit" value=<?php echo $_GET["ID"] ?> /><br>
            <label for="Quantité">Quantité : </label>
                  <input type="number" id="quantite" name="quantite" value="" /><br>
            <input type="submit" name='commande' value="Commander">
      </fieldset>
</form>