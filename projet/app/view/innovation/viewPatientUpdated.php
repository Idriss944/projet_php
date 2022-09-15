
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
    if ($results >= 0) {
     echo ("<h3>Le patient a été mis à jour </h3>");
     echo("<ul>");
     echo ("<li>Id = " . $results . "</li>");
     echo ("<li>Nom = " . $last_view->getNom() . "</li>");
     echo ("<li>Prenom = " .$last_view->getPrenom() . "</li>");
     echo ("<li>Adresse = " .$last_view->getAdresse() . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de mise à jour d'un patient</h3>");
     echo ("Nom = " . $last_view->getNom(). " - Adresse = ".$last_view->getAdresse());
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    