<?php
session_start();
try{
   $pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
   $pdoStat = $pdo->prepare('SELECT * from Article WHERE CATEGORIE = \''.$_POST['liste'].'\'');
   //execution de la requete
   $executeisOK = $pdoStat->execute();
  
   //recup des resultats en une seule fois
   $mesnoms = $pdoStat->fetchAll();

   $pdoStat2 = $pdo->prepare('SELECT * from Categorie');

   $executeisOK2 = $pdoStat2->execute();

   $mesnoms2 = $pdoStat2->fetchAll();
}

catch (PDOException $error){
  echo 'Échec de la connexion : ' . $error->getMessage();
}
  ?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Jeux</title>

   </head>
<body>

<header>
		<div id="header">
			<div id="logo">
        <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
        <a href="Profil.php">Profil</a><br>
        <a href="AccueuilMembre.php">Accueuil</a><br>
        <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>
   <form method="post" action="Filtrage.php">
      <select name="liste">
         <?php foreach ($mesnoms2 as $monnom2): ?>
            <option value="<?php echo $monnom2['ID_CATEGORIE']; ?>"><?php echo $monnom2['DESCRIPTION_CATEGORIE']; ?></option> 
         <?php endforeach; ?>  
      </select><br> 
  <button type="submit">Filtrer</button>
  <br>
  <li><a href="AccueuilMembre.php">Retirer filtre</a></li>
   </form>
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
         </tr>
         <?php foreach ($mesnoms as $monnom): ?>
         <tr> 
            <td><?= $monnom['NOM'] ?> 
            </td>
            <td><?= $monnom['PRIX'] ?> 
            </td>  
            <td><?= $monnom['DESCRIPTION'] ?>
            </td>
            <td><?= $monnom['QUANTITE'] ?>
            </td>
            <td><?= $monnom['CATEGORIE'] ?>
            </td>
          </tr>
         <?php endforeach; ?>
      </table>
</body>