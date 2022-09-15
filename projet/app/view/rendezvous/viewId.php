
<!-- ----- début viewId -->
<?php 
require ($root . '/app/view/fragment/fragmentCaveHeader.php');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.php';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.php';

      // $results contient un tableau avec la liste des clés.
      ?>

    <form role="form" method='get' action='router.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='<?php echo($target); ?>'>
        <label for="patient_id">Selectionnez un patient : </label><br/>
        <?php //print_r($results); ?>
        <select name="patient_id" id="patient_id" >
            <?php 
            
            foreach ($results as $patient) {
                    $option_value = $patient->getId()." : ".$patient->getNom()." : ".$patient->getPrenom()." : ".$patient->getAdresse();
                    echo("<option> $option_value </option>");
            }
            ?>
        </select><br/>                          
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

  <!-- ----- fin viewId -->