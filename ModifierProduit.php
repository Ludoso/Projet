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
      <!-- Bandeau du haut de la page -->
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
      <!-- Tableau affichant la totalité des articles avec leur quantité disponible, leur prix et leur catégorie -->
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
               Supprimer
            </th>
            <th>
               Modifier
            </th>
         </tr>
         <?php
            $pdoStat = $db->prepare("SELECT * from Article LIMIT $min, 10");

            $executeisOK = $pdoStat->execute();

            $mesnoms = $pdoStat->fetchAll();
         ?>
         <?php foreach ($mesnoms as $monnom): ?>
            <?php
               $pdoStat2 = $db->prepare('SELECT * from Categorie WHERE ID_CATEGORIE = \''.$monnom["CATEGORIE"].'\'');

               $executeisOK2 = $pdoStat2->execute();

               $mesnoms2 = $pdoStat2->fetchAll();
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
               <?php foreach ($mesnoms2 as $monnom2): ?>
                  <?= $monnom2['DESCRIPTION_CATEGORIE'] ?>
               <?php endforeach; ?>
            </td>
            <td>
            <? $monlien= "SupprimerConfirme.php?ID=".$monnom['ID'] ?>
               <a href="<? echo $monlien; ?>">Supprimer</a>
            </td>
            <td>
            <? $monlien= "ModifierArticle.php?ID=".$monnom['ID'] ?>  
               <a href="<? echo $monlien; ?>">Modifier</a>
            </td>
          </tr>
         <?php endforeach; ?>
         </table>
         <BR><BR><BR><BR>

         <button button2 onclick="window.location.href = 'NouvelArticle.php'">Saisir un nouvel article</button>

   </body>
   </html>