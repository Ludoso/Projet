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

    $IDCommande = $_GET['ID'];

    //Requete SQL pour récupérer les états disponibles pour une commande pour affichage dans le menu déroulant.
    $pdoStat = $pdo->prepare('SELECT * from Etat');

    $executeisOK = $pdoStat->execute();
   
    $mesnoms = $pdoStat->fetchAll();

    //Récupère la commande dans laquelle il faut modifier l'état
    $pdoStat2 = $pdo->prepare('SELECT * from commande where ID_COMMANDE=\''.$IDCommande.'\' ');

    $executeisOK2 = $pdoStat2->execute();

    $mesnoms2 = $pdoStat2->fetchAll();
?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Modifier l'état</title>

   </head>

   <body>
        <form action="ValiderEtat.php" method="post">
            <fieldset>
                <?php foreach ($mesnoms2 as $monnom2): ?>
                    <input id="id" type="hidden" name="id" value=<?php echo $monnom2['ID_COMMANDE']; ?>> 
                
                <label for="etat">Etat a choisir : </label>
                    <select name="etat"> 
                        <?php // Affiche les différents états disponibles pour une commande ?>
                        <?php foreach ($mesnoms as $monnom): ?>
                           
                            <option value="<?php echo $monnom['ID_Etat']; ?>"><?php echo $monnom['DESCRIPTION_ETAT']; ?></option> 
                        <?php endforeach; ?>  
                    </select><br>
                    <?php echo $monnom2['ID'];?>
                    
                <?php endforeach; ?>
            </fieldset>
            <input type="submit" value="Enregistrer"><br>
        </form>
    </body>