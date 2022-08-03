<?php
session_start();
try {
    $pdo = new PDO('mysql:host=localhost;dbname=Projet', 'root', 'root');
  } 
  
  catch (PDOException $e) {
    echo 'Impossible de se connecter à la base de données';
    
  }
$UtilisateurNom = $_SESSION['username'];
$ProduitNom = valid_donnees($_POST["produit"]);
$quantite = valid_donnees($_POST["quantite"]);

function valid_donnees($donnees){
  $donnees = trim($donnees);
  $donnees = stripslashes($donnees);
  $donnees = htmlspecialchars($donnees);
  return $donnees;
}  
  
$ProduitStat = $pdo->prepare('SELECT ID, QUANTITE, PRIX FROM article  WHERE NOM = \''.$ProduitNom.'\'');
$ProduitOK = $ProduitStat->execute();
$Produit = $ProduitStat->fetchAll();
$UtilisateurStat = $pdo->prepare('SELECT ID FROM utilisateur WHERE USERNAME = \''.$UtilisateurNom.'\'');
$UtilisateurOK = $UtilisateurStat->execute();
$Utilisateur = $UtilisateurStat->fetchAll();
foreach($Produit as $row1){
  foreach ($Utilisateur as $row2){
      if ($row1['QUANTITE'] < $quantite){
        echo "Il n'y a pas assez de produits dans la réserve pour satisfaire votre commande";
      }
      else{
        $Prix = ($row1['PRIX'] * $quantite);
        $etat = 1;
        $data = $pdo->prepare("
          INSERT INTO COMMANDE(ID_UTILISATEUR, ID_PRODUIT, QUANTITE, ETAT, PRIX_ARTICLE, PRIX_COMMANDE) 
          VALUES (:IDU, :IDP, :quantite, :etat, :prixA, :prixC)");
        $data->bindParam(':IDU',$row2["ID"]);
        $data->bindParam(':IDP',$row1["ID"]);
        $data->bindParam(':quantite',$quantite);
        $data->bindParam(':etat',$etat);
        $data->bindParam(':prixA',$Prix);
        $data->bindParam(':prixC',$Prix);
        $data->execute();
        echo "Votre commande a été bien prise en compte et sera envoyée lors de la réception du chèque.";
      }
  }
}
//$data->bindValue($valeur, ID_COMMANDE);

?>

<form action="AccueuilMembre.php">
<button type="submit">Retour à l'accueuil</button>
</form>