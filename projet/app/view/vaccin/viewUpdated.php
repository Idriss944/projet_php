
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
     echo ("<h3>Le vaccin a été mis à jour </h3>");
     echo("<ul>");
     echo ("<li>Id = " . $results . "</li>");
     echo ("<li>Label = " . $last_view->getLabel() . "</li>");
     echo ("<li>Doses = " . $_GET['doses'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de mise à jour du vaccin</h3>");
     echo ("Label = " . $last_view->getLabel(). " - Doses = ".$last_view->getDoses());
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    