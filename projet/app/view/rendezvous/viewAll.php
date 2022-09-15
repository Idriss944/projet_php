
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
        <?php 
              $columns = $results[0] ;
              echo table_line($columns,array(),array(), true);
              $datas = $results[1];  
        ?>
      </thead>
      <tbody>
          <?php
          // La liste des Vaccins est dans une variable $results             
          foreach ($datas as $element) {
              /*echo("<tr>");
              for($i=0;$i<count($element);$i++){
                echo("<td>".$element[$i]."</td>");
              }
              echo("</tr>");*/
           echo table_line($element);
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

  <!-- ----- fin viewAll -->
  
  
  