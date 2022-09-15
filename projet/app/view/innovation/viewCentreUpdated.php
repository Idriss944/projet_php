
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
     echo ("<h3>Le centre a été mis à jour </h3>");
     echo("<ul>");
     echo ("<li>Id = " . $results . "</li>");
     echo ("<li>Label = " . $_GET["label"] . "</li>");
     echo ("<li>Adresse = " .$_GET["adresse"]. "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de mise à jour d'un centre</h3>");
     echo ("Label = " . $last_view->getLabel(). " - Adresse = ".$last_view->getAdresse());
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
   