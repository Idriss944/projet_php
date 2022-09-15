
<!-- ----- debut ControllerVaccin -->
<?php
require_once '../model/ModelVaccin.php';

class ControllerVaccin {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerVaccin : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des vaccins
 public static function vaccinReadAll() {
  $results = ModelVaccin::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewAll.php';
  if (DEBUG)
   echo ("ControllerVaccin : vaccinReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function vaccinReadId($args) {
  $results = ModelVaccin::getAllId();

  $target = $args["target"];
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewId.php';
  require ($vue);
 }

 // Affiche un vaccin particulier (id)
 public static function vaccinReadOne() {
  $vaccin_id = $_GET['id'];
  $results = ModelVaccin::getOne($vaccin_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un vaccin
 public static function vaccinCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau vaccin.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function vaccinCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelVaccin::insert(
      htmlspecialchars($_GET['label']), htmlspecialchars($_GET['doses'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewInserted.php';
  require ($vue);
 }
 
 
 public static function vaccinUpdate() {
  // ----- Construction chemin de la vue
  $liste_vaccin = ModelVaccin::getAll();

  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewUpdate.php';
  require ($vue);
 }
 
 public static function vaccinUpdated() {
  // ajouter une validation des informations du formulaire
  $id = intval(explode(" : ",htmlspecialchars($_GET['id']))[0] );
  $last_view = ModelVaccin::getOne(htmlspecialchars($id));
  $results = ModelVaccin::update(
      htmlspecialchars($id),htmlspecialchars($_GET['doses']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewUpdated.php';
  require ($vue);
 }
 
 public static function vaccinDeleted() {
  // ajouter une validation des informations du formulaire
  $last_view = ModelVaccin::getOne(htmlspecialchars($_GET['id']))[0];
  $results = ModelVaccin::delete(
      htmlspecialchars($_GET['id']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/vaccin/viewDeleted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerVaccin -->


