
<!-- ----- debut ControllerCave -->
<?php
//require_once '../model/ModelCave.php'; 

class ControllerCave {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerCave : caveAccueil : vue = $vue");
  require ($vue);
 }
 
 public static function mesPropositions() {
     include 'config.php';
  $vue = $root . '/public/documentation/mesPropositions.php';
  //if (DEBUG)
   echo ("ControllerCave : mesPropositions : vue = $vue");
  require ($vue);
 }

 
}
?>
<!-- ----- fin ControllerCave -->


