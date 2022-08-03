<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
  } 
  
  catch (PDOException $e) {
	echo 'Impossible de se connecter à la base de données';
	
  }
//Limite du nombre d'articles par page

$pdoStat2 = $pdo->prepare('SELECT * from Categorie');

$executeisOK2 = $pdoStat2->execute();

$mesnoms2 = $pdoStat2->fetchAll();

if (isset($_POST['connexion']) && $_POST['connexion'] == 'Connexion') {
   //Vérifie si l'username et le mot de passe ont été entrés sur la page de connexion
	if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['mdp']) && !empty($_POST['mdp']))) {
	
		$pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
      //Vérifie si les données entrées correspondent à celles d'un utilisateur normal
		$pdoStat = $pdo->prepare('SELECT count(*) AS total FROM Utilisateur WHERE USERNAME=\''.$_POST['username'].'\' AND PASSWORD=\''.$_POST['mdp'].'\'');
		$pdoStat->execute();
		$resultat = $pdoStat->fetch(PDO::FETCH_ASSOC);

      //Vérifie si les données entrées correspondent à celles d'un utilisateur admin
      $pdoStat2 = $pdo->prepare('SELECT count(*) AS total2 FROM Utilisateur WHERE USERNAME=\''.$_POST['username'].'\' AND PASSWORD=\''.$_POST['mdp'].'\' AND TYPE=1');
		$pdoStat2->execute();
		$resultat2 = $pdoStat2->fetch(PDO::FETCH_ASSOC);

      //Dans le cas où l'utilisateur est un admin
      if ($resultat2['total2'] == 1){
         session_start();
			$_SESSION['username'] = $_POST['username'];
			header('Location: AccueuilAdmin.php');
			exit();
      }

	   //Dans le cas où l'utilisateur est un membre normal
		elseif ($resultat['total'] == 1) {
			session_start();
			$_SESSION['username'] = $_POST['username'];
			header('Location: AccueuilMembre.php');
			exit();
		}
	}

		//aucune réponse
		elseif ($resultat['total'] == 0) {
			echo "On est dans l'erreur = 0";
			$erreur = 'Compte non reconnu.';
		}
		//gros problème
		elseif ($resultat['total'] > 1) {
			$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
	}
}
else {
	$erreur = 'Au moins un des champs est vide.';
	}
?>

<head>
    <title>Accueuil</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="monCSS.css">
</head>

<body>
   <!-- Bandeau de haut de page -->
	<header>
		<div id="header">
			<div id="logo">
            <a href="Accueuil.php">
				<img src="logo.jpg" alt="Image" height="40" width="40">
			</div>
			<div id="texte">
				<li><a href="Connexion.php">Se connecter</a></li>
				<li><a href="CreerCompte.php">S'inscrire</a></li>
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
</form>

<BR><BR><BR><BR>
      <!-- Affiche la liste des jeux disponibles avec leur quantité -->
      <?php

         //Vérification de la page actuelle pour la base de données
         $min = 0;
         $pagesuivante = 0;
         $pageprecedente = 0;
         if (isset($_GET['min'])){
            $min = $_GET['min'];
         }
         if ($min >= 5){
            $pageprecedente = $min  - 10;
            $pagesuivante = $min  + 10; 
            echo '<a href="Accueuil.php?min='.$pageprecedente.'">Précédent</a>'; 
            echo '<a href="Accueuil.php?min='.$pagesuivante.'">Suivant</a>'; 
         }
         else{
            $pagesuivante = $min  + 10; 
            echo '<a href="Accueuil.php?min='.$pagesuivante.'">Suivant</a>'; 
         }
?>
<br><br>
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
         <?php
         $pdoStat = $pdo->prepare("SELECT * from Article LIMIT $min, 10");

         $executeisOK = $pdoStat->execute();

         $mesnoms = $pdoStat->fetchAll();
         ?>
            <?php foreach ($mesnoms as $monnom): ?>
               <?php
               $pdoStat3 = $pdo->prepare('SELECT * from Categorie WHERE ID_CATEGORIE = \''.$monnom["CATEGORIE"].'\'');

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
          </tr>
         <?php endforeach; ?>
      </table>

<BR><BR><BR><BR>

</body>