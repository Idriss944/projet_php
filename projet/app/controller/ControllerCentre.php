
<!-- ----- debut ControllerCentre -->
<?php
require_once '../model/ModelCentre.php';

class ControllerCentre {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerCentre : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des centres
 public static function centreReadAll() {
  $results = ModelCentre::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewAll.php';
  if (DEBUG)
   echo ("ControllerCentre : centreReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function centreReadId($args) {
  $results = ModelCentre::getAllId();

  $target = $args["target"];
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewId.php';
  require ($vue);
 }

 // Affiche un centre particulier (id)
 public static function centreReadOne() {
  $centre_id = $_GET['id'];
  $results = ModelCentre::getOne($centre_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un centre
 public static function centreCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau centre.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function centreCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelCentre::insert(
      htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewInserted.php';
  require ($vue);
 }
 
 
 public static function centreUpdate() {
  // ----- Construction chemin de la vue
  $liste_centre = ModelCentre::getAll();

  include 'config.php';
  $vue = $root . '/app/view/centre/viewUpdate.php';
  require ($vue);
 }
 
 public static function centreUpdated() {
  // ajouter une validation des informations du formulaire
  $id = intval(explode(" : ",htmlspecialchars($_GET['id']))[0] );
  $last_view = ModelCentre::getOne(htmlspecialchars($id))[0];
  $results = ModelCentre::update(
      htmlspecialchars($id),htmlspecialchars($_GET['adresse']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewUpdated.php';
  require ($vue);
 }
 
 public static function centreDeleted() {
  // ajouter une validation des informations du formulaire
  $last_view = ModelCentre::getOne(htmlspecialchars($_GET['id']))[0];
  $results = ModelCentre::delete(
      htmlspecialchars($_GET['id']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewDeleted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerCentre -->


