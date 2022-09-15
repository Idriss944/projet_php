
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.php';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results > 0) {
     echo ("<h3>Le vin suivant a été supprimé </h3>");
     echo("<ul>");
     echo ("<li>id = " . $last_view->getId() . "</li>");
     echo ("<li>cru = " . $last_view->getCru() . "</li>");
     echo ("<li>annee = " . $last_view->getAnnee() . "</li>");
     echo ("<li>degre = " . $last_view->getDegre() . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Erreur de suppression du Vin suivant :  Il est probable qu'il soit présent dans la table récolte</h3>");
     echo ("<ul><li><h4>id = " . $_GET['id']."</h4></li></ul>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    