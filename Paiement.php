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
        $ProduitNom = valid_donnees($_POST["produit"]);
        $quantite = valid_donnees($_POST["quantite"]);
       echo "Comment voulez vous payer ?"; <BR><BR>
    ?>


<!--Dans le cas où l'utilisateur veut payer avec une carte de crédit, dans ce cas, il doit entrer un numéro de carte -->
<form method="post" action="ValiderCommandeCarte.php">
    <?php echo "Par carte"; ?>
    <fieldset>
        <label for="Carte">Numéro de carte : </label>
            <input type="text" id="carte" name="carte" value="" /><br>
        <input type="hidden" id="produit" name="produit" value=<?php echo $ProduitNom; ?> />
        <input type="hidden" id="quantite" name="quantite" value=<?php echo $quantite; ?> />
    </fieldset>
  <button type="submit">Valider</button>
</form>

<!--Dans le cas où l'utilisateur veut payer avec un cheque -->
<form action="ValiderCommande.php">
    <input type="hidden" id="produit" name="produit" value=<?php echo $ProduitNom; ?> />
    <input type="hidden" id="quantite" name="quantite" value=<?php echo $quantite; ?> />
    <button type="submit">Par cheque</button>
</form>

<!--Dans le cas où l'utilisateur veut annuler sa commande -->
<form action="AccueuilMembre.php">
    <button type="submit">Annuler Commande</button>
</form>

</body>