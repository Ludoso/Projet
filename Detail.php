<?php
session_start();
try {
	$pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
  } 
  
  catch (PDOException $e) {
	echo 'Impossible de se connecter à la base de données';
	
  }

$IDArticle = $_GET['ID'];

$pdoStat = $pdo->prepare('SELECT * from Article WHERE ID=\''.$IDArticle.'\'');

$executeisOK = $pdoStat->execute();

$mesnoms = $pdoStat->fetchAll();


?>

<head>
    <title>Accueuil</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="monCSS.css">
</head>

<!-- Bandeau du haut de la page -->
<header>
	<div id="header">
		<div id="logo">
      <a href="AccueuilMembre.php">
      <img src="logo.jpg" alt="Image" height="40" width="40">
		</div>
		<div id="texte">
      <a href="Profil.php">Profil</a><br>
      <a href="Deconnexion.php">Se déconnecter</a><br>
		</div>
	</div>
</header>

<?php foreach ($mesnoms as $monnom): ?>
    <?php
        $pdoStat2 = $pdo->prepare('SELECT * from Categorie WHERE ID_CATEGORIE = \''.$monnom["CATEGORIE"].'\'');

        $executeisOK2 = $pdoStat2->execute();

        $mesnoms2 = $pdoStat2->fetchAll();
    ?>
    <!-- Image de l'article  -->
    <img src="<?php echo $IDArticle; ?>.png" alt="Image" height="100" width="100">

    <!-- Caractéristiques de l'article -->
    Nom : <?= $monnom['NOM'] ?> <br>
    Prix : <?= $monnom['PRIX'] ?> € <br>  
    Description : <?= $monnom['DESCRIPTION'] ?> <br> 
    Quantité disponible : <?= $monnom['QUANTITE'] ?> <br> 
    <?php foreach ($mesnoms2 as $monnom2): ?>
        Catégorie : <?= $monnom2['DESCRIPTION_CATEGORIE'] ?> <br> 
    <?php endforeach; ?>
    <?php $monlien="CommanderArticle.php?ID=".$monnom['ID'] ?>
      <a href="<? echo $monlien; ?>">Commander article</a> <br>
<?php endforeach; ?>



<a href="AccueuilMembre.php">Accueuil</a>