
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

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='stockCreatedUpdated'>        
        <label for="vaccin_id">Selectionnez un vaccin : </label><br/>
        <select name="vaccin_id" id="vaccin_id" ><?php foreach ($liste_vaccin as $vaccin) {
                    $option_value = $vaccin->getId()." : ".$vaccin->getLabel();//." : ".$vaccin->getDoses();
                    echo("<option> $option_value </option>");
                      }
                ?>
        </select><br/>                          
        <label for="centre_id">Selectionnez un centre : </label><br/>
        <select name="centre_id" id="centre_id" ><?php foreach ($liste_centre as $centre) {
                    $option_value = $centre->getId()." : ".$centre->getLabel()." : ".$centre->getAdresse();
                    echo("<option> $option_value </option>");
                      }
                ?>
        </select><br/>
        <label for="quantite">Quantité : </label><br/><input type="number" step='any' name='quantite' value='10'>                
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

<!-- ----- fin viewInsert -->



