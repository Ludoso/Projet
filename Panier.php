<?php
session_start()
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

$Commande = array();
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
                <a href="Panier.php">Voir son panier</a><br>
			</div>
		</div>
	</header>

<?php
if (isset($_POST['commande']) && $_POST['commande'] == 'Valider') {
    array_push($Commande, $_POST['produit'], $_POST['quantite']);
}

foreach($Commande as $element){
    echo $element . "\n";
}

?>

<form action="SupprimerCommande.php">
    <button type="submit">Supprimer commande</button> 
</form>

<form action="Paiement.php">
    <button type="submit">Valider commande</button> 
</form>
</body>