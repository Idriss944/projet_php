
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
        if(!$existence){
            echo ("<h3>Le nouvelle stock a été ajouté </h3>");
        }else{
            echo ("<h3>Le stock a été mise à jour </h3>");
        }
    } else {
        if(!$existence){
          echo ("<h3>Problème d'insertion d'un stock</h3>");
         }else{
          echo ("<h3>Problème de modification d'un stock</h3>");
        }
    }
    
    echo("<ul>");
    echo ("<li>vaccin_id = " . $vaccin_id . "</li>");
    echo ("<li>centre_id = " . $centre_id . "</li>");
    echo ("<li>quantite = " . htmlspecialchars($_GET['quantite']) . "</li>");
    echo("</ul>");

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.php';
    ?>
    <!-- ----- fin viewInserted -->    

    
    