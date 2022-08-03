<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', 'root');
  } 
  
  catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
    
  }

  $pdoStat = $pdo->prepare('SELECT * from utilisateur WHERE USERNAME=\''.$_SESSION['username'].'\'');

  //execution de la requete
  $executeisOK = $pdoStat->execute();
  
  //recup des resultats en une seule fois
  $mesnoms = $pdoStat->fetchAll();



  ?>
  <head>
    <title>Profil</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="monCSS.css">
  </head>
  <body>
  <header>
		<div id="header">
			<div id="logo">
        <a href="AccueuilMembre.php">
        <img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
        <a href="Deconnexion.php">Se déconnecter</a><br>
			</div>
		</div>
	</header>

  <h1>Vos données </h1> <BR><BR>
  <table id="customers" border="1" align="center">
    <tr>
      <th>
        Nom
      </th>
      <th>
        Prenom
      </th>
      <th>
        Adresse
      </th>
      <th>
        Telephone
      </th>
    </tr>
  <?php foreach ($mesnoms as $monnom): ?>
    <tr> 
        <td><?= $monnom['NOM'] ?> 
        </td>
        <td><?= $monnom['PRENOM'] ?> 
        </td>  
        <td><?= $monnom['ADRESSE'] ?>
        </td>
        <td><?= $monnom['TELEPHONE'] ?>
        </td>
    </tr>
  <?php endforeach; ?>
  </table>

  <div id="Commande">
    <a href="ModifierCompte.php">Modifier Compte</a><br>
  </div>
<BR><BR>
<!-- Affichage de la liste des commandes de l'utilisateur connecté -->
<h1>Liste des commandes</h1>
  <table id="customers" border="1" align="center">
    <tr>
      <th>
        Produit
      </th>
      <th>
        Quantite
      </th>
      <th>
        Etat
      </th>
      <th>
        Prix commande
      </th>
    </tr>
    <?php foreach ($mesnoms as $Utilisateur): ?>
      <?php
        $pdoStat2 = $pdo->prepare('SELECT * from Commande WHERE ID_UTILISATEUR=\''.$Utilisateur['ID'].'\'');

        //execution de la requete
        $executeisOK2 = $pdoStat2->execute();
  
        //recup des resultats en une seule fois
        $mesnoms2 = $pdoStat2->fetchAll();
      ?>
      <?php foreach ($mesnoms2 as $monnom2): ?>
        <?php
        $pdoStat3 = $pdo->prepare('SELECT * from Article WHERE ID=\''.$monnom2['ID_PRODUIT'].'\'');

        //execution de la requete
        $executeisOK3 = $pdoStat3->execute();
  
        //recup des resultats en une seule fois
        $mesnoms3 = $pdoStat3->fetchAll();

        $pdoStat4 = $pdo->prepare('SELECT * from Etat WHERE ID_Etat=\''.$monnom2['ETAT'].'\'');

        //execution de la requete
        $executeisOK4 = $pdoStat4->execute();
  
        //recup des resultats en une seule fois
        $mesnoms4 = $pdoStat4->fetchAll();
        ?>
        <tr> 
          <?php foreach ($mesnoms3 as $monnom3): ?>
            <td><?= $monnom3['NOM'] ?> 
            </td>
          <?php endforeach; ?>
          <td><?= $monnom2['QUANTITE'] ?> 
          </td>  
          <?php foreach ($mesnoms4 as $monnom4): ?>
            <td><?= $monnom4['DESCRIPTION_ETAT'] ?>
            </td>
          <?php endforeach; ?>
          <td><?= $monnom2['PRIX_COMMANDE'] ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endforeach; ?>
  </table>
  </body>