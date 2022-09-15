
<!-- ----- debut ControllerXxxx -->
<?php
require_once '../model/ModelXxxx.php';

class ControllerXxxx {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerXxxx : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des xxxxs
 public static function xxxxReadAll() {
  $results = ModelXxxx::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/xxxx/viewAll.php';
  if (DEBUG)
   echo ("ControllerXxxx : xxxxReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function xxxxReadId($args) {
  $results = ModelXxxx::getAllId();

  $target = $args["target"];
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/xxxx/viewId.php';
  require ($vue);
 }

 // Affiche un xxxx particulier (id)
 public static function xxxxReadOne() {
  $xxxx_id = $_GET['id'];
  $results = ModelXxxx::getOne($xxxx_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/xxxx/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un xxxx
 public static function xxxxCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/xxxx/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau xxxx.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function xxxxCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelXxxx::insert(
      htmlspecialchars($_GET['cru']), htmlspecialchars($_GET['annee']), htmlspecialchars($_GET['degre'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/xxxx/viewInserted.php';
  require ($vue);
 }
 
 public static function xxxxDeleted() {
  // ajouter une validation des informations du formulaire
  $last_view = ModelXxxx::getOne(htmlspecialchars($_GET['id']))[0];
  $results = ModelXxxx::delete(
      htmlspecialchars($_GET['id']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/xxxx/viewDeleted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerXxxx -->


