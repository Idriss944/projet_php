
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
     echo ("<h3>Le nouveau centre a été ajouté </h3>");
     echo("<ul>");
     echo ("<li>Id = " . $results . "</li>");
     echo ("<li>Label = " . $_GET['label'] . "</li>");
     echo ("<li>Adresse = " . $_GET['adresse'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion du centre</h3>");
     echo ("Label = " . $_GET['label']." - Adresse  = ".$_GET['adresse']);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    