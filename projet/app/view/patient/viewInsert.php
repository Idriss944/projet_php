
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
        <input type="hidden" name='action' value='patientCreated'>        
        <label for="nom">Nom : </label><input type="text" name='nom' size='75' value='tosen'><br/>                           
        <label for="prenom">Prenom : </label><input type="text" name='prenom' size='75' value='sama'><br/>
        <label for="adresse">Adresse : </label><input type="text" name='adresse' size='75' value='Soul Society'>  <br/>              
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

<!-- ----- fin viewInsert -->



