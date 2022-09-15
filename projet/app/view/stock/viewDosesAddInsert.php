
<!-- ----- début viewInsert -->
 
<?php 
require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>


<body>
    
  <div class="container">
    <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.php';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?> 

    <form role="form" method='get' action=''>
      <div class="form-group">
        <input type="hidden" name='action' value='stockDosesAdded'>
        <input type="hidden" name='centre_id' value='<?php echo "centre#$centre_id"; ?>'>
        <?php 
                foreach ($liste_vaccin as $vaccin) {
                    $vaccin_id = $vaccin[0];
                    $vaccin_label = $vaccin[1];
                    echo(" <label for='vaccin#$vaccin_id'>Augmenter la quantité de vaccin $vaccin_label : </label><br/><input type='number' name='vaccin#$vaccin_id' id='vaccin#$vaccin_id' value='0'><br/> ");
                }
        ?>                                       
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

<!-- ----- fin viewInsert -->



