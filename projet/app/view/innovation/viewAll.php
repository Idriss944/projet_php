
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
          <th scope = "col">id</th>
          <th scope = "col">cru</th>
          <th scope = "col">année</th>
          <th scope = "col">degré</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des vins est dans une variable $results             
          foreach ($results as $element) {
           printf("<tr><td>%d</td><td>%s</td><td>%d</td><td>%.2f</td></tr>", $element->getId(), 
             $element->getCru(), $element->getAnnee(), $element->getDegre());
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

  <!-- ----- fin viewAll -->
  
  
  