
<!-- ----- debut ControllerStock -->
<?php
require_once '../model/ModelVaccin.php';
require_once '../model/ModelCentre.php';
require_once '../model/ModelStock.php';


class ControllerStock {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerStock : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des stocks
 public static function stockReadAll() {
  $results = ModelStock::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  if (DEBUG)
   echo ("ControllerStock : stockReadAll : vue = $vue");
  require ($vue);
 }
 
 public static function stockReadAllByVaccin() {
  $results = ModelStock::getAllByVaccin();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  if (DEBUG)
   echo ("ControllerStock : stockReadAllByVaccin : vue = $vue");
  require ($vue);
 }
 
 public static function stockReadAllGlobal() {
  $results = ModelStock::getAllGlobal();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  if (DEBUG)
   echo ("ControllerStock : stockReadAllByVaccin : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function stockReadId($args) {
  $results = ModelStock::getAllId();
  $liste_vaccin = $results[0];
  $liste_centre = $results[1];
  
  $target = $args["target"];
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewId.php';
  require ($vue);
 }

 // Affiche un stock particulier (id)
 public static function stockReadOne() {
  $vaccin_id = intval(explode(" : ",htmlspecialchars($_GET['vaccin_id']))[0] );
  $centre_id = intval(explode(" : ",htmlspecialchars($_GET['centre_id']))[0] );
  $results = ModelStock::getOne($vaccin_id,$centre_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un stock
 public static function stockCreateUpdate() {
  // ----- Construction chemin de la vue
  $liste_vaccin = ModelVaccin::getAll();
  $liste_centre = ModelCentre::getAll();
  include 'config.php';
  $vue = $root . '/app/view/stock/viewInsert.php';
  require ($vue);
 }
 
 // Affiche le formulaire de creation d'un stock
 public static function stockDosesAdd() {
  // ----- Construction chemin de la vue
  $liste_centre = ModelCentre::getAll();
  include 'config.php';
  $vue = $root . '/app/view/stock/viewDosesAdd.php';
  require ($vue);
 }
 
 // Affiche le formulaire de creation d'un stock
 public static function stockDosesAddInsert() {
  // ----- Construction chemin de la vue
  $centre_id = intval(explode(" : ", htmlspecialchars($_GET['centre_id']))[0]);
  $liste_vaccin = ModelStock::getAllVaccin()[1];
  include 'config.php';
  $vue = $root . '/app/view/stock/viewDosesAddInsert.php';
  require ($vue);
 }
 
 // Affiche un formulaire pour récupérer les informations d'un nouveau stock.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function stockDosesAdded() {
  // ajouter une validation des informations du formulaire
  $list_vaccin_id = array();
  foreach ( $_GET as $key => $value) {
      if(strpos($key,"vaccin#") !== false ){
          $list_vaccin_id[]=intval(explode("#", htmlspecialchars($key))[1]);
      }
  }
  $centre_id = intval(explode("#", htmlspecialchars($_GET['centre_id']))[1]);
  foreach ($list_vaccin_id as $vaccin_id) {
    $existence = ModelStock::checkExistence($vaccin_id, $centre_id) ;
    if ($existence){
      $quantite = intval(htmlspecialchars($_GET["vaccin#$vaccin_id"]))+ ModelStock::getOne($vaccin_id, $centre_id)[1][0][2];
      $results = ModelStock::update($vaccin_id, $centre_id,$quantite);
    }else{
      $results = ModelStock::insert($vaccin_id, $centre_id, htmlspecialchars($_GET["vaccin#$vaccin_id"]));
    }
  }
  
  $results = ModelStock::getAllVaccinByCentre($centre_id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau stock.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function stockCreatedUpdated() {
  // ajouter une validation des informations du formulaire
  $vaccin_id = intval(explode(" : ", htmlspecialchars($_GET['vaccin_id']))[0]);
  $centre_id = intval(explode(" : ", htmlspecialchars($_GET['centre_id']))[0]);
  $existence = ModelStock::checkExistence($vaccin_id, $centre_id) ;
  if ($existence){
    $results = ModelStock::update($vaccin_id, $centre_id, htmlspecialchars($_GET['quantite']));
  }else{
    $results = ModelStock::insert($vaccin_id, $centre_id, htmlspecialchars($_GET['quantite']));
  }
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewInserted.php';
  require ($vue);
 }
 
 public static function stockDeleted() {
  // ajouter une validation des informations du formulaire
  $vaccin_id = intval(explode(" : ", htmlspecialchars($_GET['vaccin_id']))[0]);
  $centre_id = intval(explode(" : ", htmlspecialchars($_GET['centre_id']))[0]);
  $last_view = ModelStock::getOne($vaccin_id,$centre_id)[1];

  $results = ModelStock::delete($vaccin_id,$centre_id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewDeleted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerStock -->


