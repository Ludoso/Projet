<?php

try {
   $pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
 } 
 
 catch (PDOException $e) {
   echo 'Impossible de se connecter à la base de données';
   
 }
// Si tout va bien, on peut continuer 
//prepa de la requete
$pdoStat = $pdo->prepare('SELECT * from Categorie');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();
echo 'ok';
?>

<!DOCTYPE html>
<html>
<head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
    <title>Saisie d'un nouvel article</title>
</head>
 
<body>


<h1>Ajout d'un article</h1>
<form action="InsertionArticle.php" method="post">

<fieldset>
    <legend>Nouvel article</legend>

    
        <label for="nom">Nom</label>
        <input id="nom" placeholder="Nom du jeu" type="text" name="Nom"><br>
    
        <label for="description">Description</label>
        <input id="description" type="text" name="Description"><br>

        <label for="categorie">Catégorie</label>
         <select name="categorie">
            <?php foreach ($mesnoms as $monnom): ?>
               <option value="<?php echo $monnom['ID_CATEGORIE']; ?>"><?php echo $monnom['DESCRIPTION_CATEGORIE']; ?></option> 
            <?php endforeach; ?>  
         </select>    
         <br>
 
        <label for="prix">Prix</label>
        <input id="prix" type="float" name="Prix"><br>

        <label for="quantite">Quantité</label>
        <input id="quantite" type="number" name="Quantite"><br>
    
 </fieldset>
<input type="submit" value="Enregistrer"><br>
</form>

</body>
</html>
