
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
    if ($results) {
     echo ("<h3>Le nouveau vin a été ajouté </h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>cru = " . $_GET['cru'] . "</li>");
     echo ("<li>annee = " . $_GET['annee'] . "</li>");
     echo ("<li>degre = " . $_GET['degre'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion du Vin</h3>");
     echo ("id = " . $_GET['cru']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    