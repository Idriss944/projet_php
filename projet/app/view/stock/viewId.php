
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
        <label for="centre_id">Selectionnez un centre : </label><br/>
        <select name="centre_id" id="centre_id" ><?php foreach ($liste_centre as $centre) {
                    $option_value = $centre[0]." : ".$centre[1]." : ".$centre[2];
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