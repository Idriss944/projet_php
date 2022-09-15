
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
        <input type="hidden" name='action' value='vaccinUpdated'>        
        <label for="id">Selectionnez un patient : </label><br/>
        <select name="id" id="id" ><?php foreach ($liste_patient as $patient) {
                    $option_value = $patient->getId()." : ".$patient->getLabel();
                    echo("<option> $option_value </option>");
                      }
                ?>
        </select><br/>                          
        <label for="adresse">Adresse : </label><br/><input type="number" step='any' name='adresse' value='Lombards'>                
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

<!-- ----- fin viewInsert -->



