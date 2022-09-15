
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
        <input type="hidden" name='status' value='<?php echo($status); ?>'>
        <input type="hidden" name='patient_id' value='<?php echo($patient_id); ?>'>
        <input type="hidden" name='injection' value='<?php echo($injection); ?>'>
        <?php if(isset($vaccin_id)){
            echo("<input type='hidden' name='vaccin_id' value='$vaccin_id'>");
        }?>
        
        <label for="centre_id">Selectionnez un centre : </label><br/>
        <?php //print_r($results); ?>
        <select name="centre_id" id="centre_id" >
            <?php 
            
            foreach ($results as $centre) {
                    $option_value = $centre[0]." : ".$centre[1]." : ".$centre[2];
                    echo("<option> $option_value </option>");
            }
            ?>
        </select><br/>                          
      </div>
      <p/>
      <?php
        if(isset($flagNoMoreVaccin)){
           if($flagNoMoreVaccin === false){
                echo '<button class="btn btn-primary" type="submit">Go</button>';
           }else{
                echo '<h2>Votre vaccin est en rupture de stock dans tous les centres de vaccination. Veuillez repasser ultérieurement.</h2>';
           }
        }else{
                echo '<button class="btn btn-primary" type="submit">Go</button>';
        }
      ?>
      
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

  <!-- ----- fin viewId -->