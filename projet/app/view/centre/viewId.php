
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
        <label for="id">id : </label> <select class="form-control" id='id' name='id' style="width: 100px">
            <?php
            foreach ($results as $id) {
             echo ("<option>$id</option>");
            }
            ?>
        </select>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.php'; ?>

  <!-- ----- fin viewId -->