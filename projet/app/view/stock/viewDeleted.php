
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
          echo ("<h3>Suppression de la stock suivant </h3>");
    } else {
     echo ("<h3>Erreur de suppression de la stock suivant : Elle n'existe peut être pas. </h3>");
    }
    echo("<ul>");
     echo ("<li>vin_id = " . htmlspecialchars($_GET['vin_id']) . "</li>");
     echo ("<li>producteur_id = " . htmlspecialchars($_GET['producteur_id']) . "</li>");
     echo("</ul>");

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    