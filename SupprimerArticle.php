<?php
$IDArticle = $_GET['ID'];
echo $IDArticle;
?>

<!doctype html>

<html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Supprimer</title>

   </head>
   <body>

      <?php
         try
         {
            //ouverture de la connexion a la Bdd
            $pdo = new PDO('mysql:host=localhost;dbname=Projet;charset=utf8', 'root', 'root');
            $pdoStat = $pdo->prepare('DELETE from article where ID=\''.$IDArticle.'\' ');
            $pdoStat->execute();
            header('Location: ModifierProduit.php');
         }
         catch (Exception $e)
         {
            echo "il y a un probleme";
               die('Erreur : ' . $e->getMessage());
         }
      ?>
   </body>
</html>