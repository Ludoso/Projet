<?php
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
$IDArticle = $_GET['ID'];

$pdoStat = $pdo->prepare('SELECT * from article where ID=\''.$IDArticle.'\' ');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();

$pdoStat2 = $pdo->prepare('SELECT * from Categorie');

//execution de la requete
$executeisOK2 = $pdoStat2->execute();

//recup des resultats en une seule fois
$mesnoms2 = $pdoStat2->fetchAll();
?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Modifier un article</title>

   </head>

   <body>

   <header>
		<div id="header">
			<div id="logo">
        <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
            <a href="AccueulAdmin.php">Accueuil</a><br>
            <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>
   <form action="ChangerArticle.php" method="post">

<fieldset>
   <?php foreach ($mesnoms as $monnom): ?>
      <legend>Nouvel article</legend>
      <input id="id" type="hidden" name="id" value=<?php echo $monnom['ID']; ?>>

      <label for="nom">Nom</label>
      <input id="nom" type="text" name="nom" value="<?php echo $monnom['NOM']; ?>"><br>
    
      <label for="description">Description</label>
      <input id="description" type="text" name="description" value="<?php echo $monnom['DESCRIPTION']; ?>"><br>

      <label for="categorie">Catégorie</label>
         <select name="categorie"> 
            <?php foreach ($mesnoms2 as $monnom2): ?>
               <option value="<?php echo $monnom2['ID_CATEGORIE']; ?>"><?php echo $monnom2['DESCRIPTION_CATEGORIE']; ?></option> 
            <?php endforeach; ?>  
         </select><br>
 
      <label for="prix">Prix</label>
      <input id="prix" type="float" name="prix" value="<?php echo $monnom['PRIX']; ?>"><br>

      <label for="quantite">Quantité</label>
      <input id="quantite" type="number" name="quantite" value="<?php echo $monnom['QUANTITE']; ?>"><br>
   <?php endforeach; ?>  
</fieldset>

   <input type="submit" value="Enregistrer"><br>
</form>
   </body>

