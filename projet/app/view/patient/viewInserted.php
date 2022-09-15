
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
     echo ("<h3>Le nouveau patient a été ajouté </h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo ("<li>Nom = " . $_GET['nom'] . "</li>");
     echo ("<li>Prenom = " . $_GET['prenom'] . "</li>");
     echo ("<li>Adresse = " . $_GET['adresse'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion du Patient</h3>");
     echo ("Nom = " . $_GET['nom']." - Prenom = ".$_GET["prenom"]." - Adresse = ".$GET["adresse"]);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    