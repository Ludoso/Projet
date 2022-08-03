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
$pdoStat = $pdo->prepare('SELECT * from Commande');

//execution de la requete
$executeisOK = $pdoStat->execute();

//recup des resultats en une seule fois
$mesnoms = $pdoStat->fetchAll();
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
            <a href="AccueuilAdmin.php">
            <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
		   <div id="texte">
            <a href="Deconnexion.php">Se déconnecter</a><br>
            <a href="ModifierProduit.php">Modifier produits</a><br>
            <a href="ModifierUtilisateurs.php">Modifier utilisateurs</a><br>
            <a href="ModifierCategorie.php">Modifier catégories</a><br>
			</div>
		</div>
	</header>
  <!-- Afficher ce texte plus le nom de l'utilisateur si connecté -->
Bienvenue

<h1>Commandes</h1>
      <table id="customers" border="1" align="center">
         <tr>
            <th>
               Produit
            </th>
            <th>
               Quantite
            </th>
            <th>
               Prix
            </th>
            <th>
               Utilisateur
            </th>
            <th>
               Etat de la commande
            </th>
            <th>
               Changer l'etat
            </th>
         </tr>


         <?php foreach ($mesnoms as $monnom): ?>
            <?php
            //Récupère les noms des articles en fonction de l'id
            $pdoStat2 = $pdo->prepare('SELECT * from Article WHERE ID = \''.$monnom["ID_PRODUIT"].'\'');

            $executeisOK2 = $pdoStat2->execute();

            $Articles = $pdoStat2->fetchAll();

            //Récupère les noms des utilisateurs en fonctions de leur id
            $pdoStat3 = $pdo->prepare('SELECT * from Utilisateur WHERE ID = \''.$monnom["ID_UTILISATEUR"].'\'');

            $executeisOK3 = $pdoStat3->execute();

            $Utilisateurs = $pdoStat3->fetchAll();

            //Récupère les états des commandes en fonction de l'id de l'état
            $pdoStat4 = $pdo->prepare('SELECT * from Etat WHERE ID_Etat = \''.$monnom["ETAT"].'\'');

            $executeisOK4 = $pdoStat4->execute();

            $Etats = $pdoStat4->fetchAll();
            ?>
            <tr> 
               <td>
                  <?php foreach ($Articles as $ArticlesNom): ?>
                     <?= $ArticlesNom['NOM'] ?> 
                  <?php endforeach; ?>
               </td>
               <td><?= $monnom['QUANTITE'] ?> 
               </td>  
               <td><?= $monnom['PRIX_ARTICLE'] ?>
               </td>
               <td>
                  <?php foreach ($Utilisateurs as $UtilisateursNom): ?>
                     <?= $UtilisateursNom['USERNAME'] ?>
                  <?php endforeach; ?>
               </td>
               <td>
                  <?php foreach ($Etats as $EtatsNom): ?>
                     <?= $EtatsNom['DESCRIPTION_ETAT'] ?>
                  <?php endforeach; ?>
               </td>
               <td>
                  <? $monlien= "ChangerEtat.php?ID=".$monnom['ID_COMMANDE'] ?>
                  <a href="<? echo $monlien; ?>">Modifier l'etat</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </table>


</body>