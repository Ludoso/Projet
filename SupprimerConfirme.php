<?php

$IDArticle = $_GET['ID'];

?>

<!doctype html>
   <html lang="en">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="monCSS.css" />
      <title>Supprimer</title>

   </head>
   <body>
   Voulez-vous vraiment supprimer cet article ?
   <BR><BR>

   <? $monlien= "SupprimerArticle.php?ID=".$IDArticle ?>  
               <a href="<? echo $monlien; ?>">Oui</a>
    <? $monlien= "ModifierProduit.php" ?>  
                <a href="<? echo $monlien; ?>">Non</a>
   </body>
</html>