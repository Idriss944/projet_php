
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
          echo ("<h3>Suppression de la rendezvous suivant </h3>");
    } else {
     echo ("<h3>Erreur de suppression de la rendezvous suivant : Elle n'existe peut être pas. </h3>");
    }
    echo("<ul>");
     echo ("<li>Vaccin_id = " . htmlspecialchars($_GET['Vaccin_id']) . "</li>");
     echo ("<li>centre_id = " . htmlspecialchars($_GET['centre_id']) . "</li>");
     echo("</ul>");

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    