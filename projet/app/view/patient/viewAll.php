
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.php';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
      ?>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">Id</th>
          <th scope = "col">Nom</th>
          <th scope = "col">Prenom</th>
          <th scope = "col">Adresse</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des vins est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $element->getId(), 
             $element->getNom(), $element->getPrenom(), $element->getAdresse());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

  <!-- ----- fin viewAll -->
  
  
  