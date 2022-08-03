<?php
session_start();
?>

<head>
    <title>Passer une commande</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
<body>


<?php

try {
   $pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
 } 
 
 catch (PDOException $e) {
   echo 'Impossible de se connecter à la base de données';
   
 }

//prepa de la requete
$pdoStat = $pdo->prepare('SELECT * from article');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();
// connexion
?>

<form method="post" action="Paiement.php">

<fieldset>
        <select name="produit">
            <?php foreach ($mesnoms as $monnom): ?>
               <option value="<?php echo $monnom['NOM']; ?>"><?php echo $monnom['NOM']; ?></option> 
            <?php endforeach; ?>  
         </select> 
         <label for="Quantité">Quantité : </label>
  <input type="number" id="quantite" name="quantite" value="" /><br>
            </fieldset>
  <button type="submit">Valider</button>
            </form>
</body>