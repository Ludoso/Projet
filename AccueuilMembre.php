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

//Prépare la récupération de toutes les catégories disponibles
$pdoStat2 = $db->prepare('SELECT * from Categorie');

$executeisOK2 = $pdoStat2->execute();

$mesnoms2 = $pdoStat2->fetchAll();

//Prépare a récupérer les données de l'utilisateur
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
        <a href="Panier.php">Voir son panier</a><br>
			</div>
		</div>
	</header>
  <!-- Afficher ce texte plus le nom de l'utilisateur si connecté -->
Bienvenue <?php echo $_SESSION['username']; ?> !<br/>

<form method="post" action="FiltrageMembre.php">
  <select name="liste">
    <?php foreach ($mesnoms2 as $monnom2): ?>
      <option value="<?php echo $monnom2['ID_CATEGORIE']; ?>"><?php echo $monnom2['DESCRIPTION_CATEGORIE']; ?></option> 
    <?php endforeach; ?>  
  </select><br> 
  <button type="submit">Filtrer</button>
</form>

<BR><BR><BR><BR>
<?php
  $min = 0;
  $pagesuivante = 0;
  $pageprecedente = 0;
  if (isset($_GET['min'])){
    $min = $_GET['min'];
  }
  if ($min >= 5){
    $pageprecedente = $min  - 10;
    $pagesuivante = $min  + 10; 
    echo '<a href="AccueuilMembre.php?min='.$pageprecedente.'">Précédent</a>'; 
    echo '<a href="AccueuilMembre.php?min='.$pagesuivante.'">Suivant</a>'; 
  }
  else{
    $pagesuivante = $min  + 10; 
    echo '<a href="AccueuilMembre.php?min='.$pagesuivante.'">Suivant</a>'; 
  }
?>
<h1>Liste des jeux</h1>
  <table id="customers" border="1" align="center">
    <tr>
      <th>
        Nom
      </th>
      <th>
        Prix
      </th>
      <th>
        Description
      </th>
      <th>
        Quantité
      </th>
      <th>
        Catégorie
      </th>
      <th>
        Détail
      </th>
    </tr>
    <?php
      //prepa de la requete pour récupérer les produits disponibles
      $pdoStat = $db->prepare("SELECT * from Article LIMIT $min, 10");

      //execution de la requete
      $executeisOK = $pdoStat->execute();

      //recup des resultats en une seule fois
      $mesnoms = $pdoStat->fetchAll();
    ?>

  <?php foreach ($mesnoms as $monnom): ?>
    <?php
      $pdoStat3 = $db->prepare('SELECT * from Categorie WHERE ID_CATEGORIE = \''.$monnom["CATEGORIE"].'\'');

      $executeisOK3 = $pdoStat3->execute();

      $mesnoms3 = $pdoStat3->fetchAll();
    ?>
    <tr> 
      <td><?= $monnom['NOM'] ?> 
      </td>
      <td><?= $monnom['PRIX'] ?> 
      </td>  
      <td><?= $monnom['DESCRIPTION'] ?>
      </td>
      <td><?= $monnom['QUANTITE'] ?>
      </td>
      <td>
        <?php foreach ($mesnoms3 as $monnom3): ?>
          <?= $monnom3['DESCRIPTION_CATEGORIE'] ?>
        <?php endforeach; ?>
      </td>
      <td>
      <? $monlien= "Detail.php?ID=".$monnom['ID'] ?>  
               <a href="<? echo $monlien; ?>">Voir détail</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>

<BR><BR><BR><BR>

  <div id="Commande">
    <a href="Commande.php">Passer commande</a><br>
  </div>

</body>