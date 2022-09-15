
<!-- ----- debut ControllerPatient -->
<?php
require_once '../model/ModelPatient.php';

class ControllerPatient {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerPatient : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des patients
 public static function patientReadAll() {
  $results = ModelPatient::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewAll.php';
  if (DEBUG)
   echo ("ControllerPatient : patientReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function patientReadId($args) {
  $results = ModelPatient::getAllId();

  $target = $args["target"];
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewId.php';
  require ($vue);
 }

 // Affiche un patient particulier (id)
 public static function patientReadOne() {
  $patient_id = $_GET['id'];
  $results = ModelPatient::getOne($patient_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un patient
 public static function patientCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau patient.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function patientCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelPatient::insert(
      htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewInserted.php';
  require ($vue);
 }
 
 
 public static function patientUpdate() {
  // ----- Construction chemin de la vue
  $liste_patient = ModelPatient::getAll();

  include 'config.php';
  $vue = $root . '/app/view/patient/viewUpdate.php';
  require ($vue);
 }
 
 public static function patientUpdated() {
  // ajouter une validation des informations du formulaire
  $id = intval(explode(" : ",htmlspecialchars($_GET['id']))[0] );
  $last_view = ModelPatient::getOne(htmlspecialchars($id))[0];
  $results = ModelPatient::update(
      htmlspecialchars($id),htmlspecialchars($_GET['adresse']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewUpdated.php';
  require ($vue);
 }
 
 public static function patientDeleted() {
  // ajouter une validation des informations du formulaire
  $last_view = ModelPatient::getOne(htmlspecialchars($_GET['id']))[0];
  $results = ModelPatient::delete(
      htmlspecialchars($_GET['id']));
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewDeleted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerPatient -->


