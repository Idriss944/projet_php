
<!-- ----- debut ModelRendezvous -->

<?php
require_once 'Model.php';
require_once 'ModelVaccin.php';
require_once 'ModelCentre.php';
require_once 'ModelPatient.php';
require_once 'ModelStock.php';

class ModelRendezvous {
 private $centre_id, $patient_id , $vaccin_id, $injection;

 // pas possible d'avoir 2 constructeurs
 public function __construct($centre_id = NULL,$patient_id = NULL, $vaccin_id = NULL, $injection = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($centre_id)) {
   $this->centre_id = $centre_id;
   $this->patient_id = $patient_id;
   $this->vaccin_id = $vaccin_id;
   $this->injection = $injection;
  }
 }

 function setCentre_id($centre_id) {
  $this->centre_id = $centre_id;
 }

 function setVaccin_id($vaccin_id) {
  $this->vaccin_id = $vaccin_id;
 }

 function setInjection($injection) {
  $this->injection = $injection;
 }

  function setPatient_id($patient_id){
     $this->patient_id = $patient_id;
 }
 
 function getPatient_id() {
     return $this->patient_id;
 }
 
 function getCentre_id() {
  return $this->centre_id;
 }

 function getVaccin_id() {
  return $this->vaccin_id;
 }

 function getInjection() {
  return $this->injection;
 }

 
// retourne une liste des id
 public static function getAllId() {
  $vaccins = ModelRendezvous::getListVaccinInRendezvous();
  $centres = ModelRendezvous::getListCentreInRendezvous();
  return array($vaccins,$centres);
 }
 
 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $results = $database->query($query,PDO::FETCH_NUM);
   $columns = array();
     for ($i=0;$i<$results->columnCount();$i++){
       $columns[]=$results->getColumnMeta($i)["name"];                    
     }
    $results = array($columns,$results->fetchAll());
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
    $query = "select * from rendezvous";
    return ModelRendezvous::getMany($query);
  
 }

 public static function getOne($vaccin_id,$centre_id) {
   $database = Model::getInstance();
   $query = "select * from rendezvous where vaccin_id = $vaccin_id AND centre_id = $centre_id";
   return ModelRendezvous::getMany($query);
 }

 public static function getListVaccin(){
     $query = "SELECT vaccin.* FROM vaccin" ;
     $results = ModelRendezvous::getMany($query)[1];
     return $results;
 }
 
 public static function getListCentre(){
     $query = "SELECT centre.* FROM centre" ;
     $results = ModelRendezvous::getMany($query)[1];
     return $results;
 }
 
 public static function getRendezVousByPatient($patient_id){
     $query = "SELECT * FROM rendezvous where patient_id = $patient_id AND injection = (SELECT MAX(injection) FROM rendezvous WHERE patient_id = $patient_id) " ;
     $results = ModelRendezvous::getMany($query)[1];
     return $results;
 }
 
 public static function getListVaccinInRendezvous(){
     $query = "SELECT DISTINCT vaccin.* FROM vaccin,rendezvous WHERE vaccin.id = rendezvous.vaccin_id" ;
     $results = ModelRendezvous::getMany($query)[1];
     return $results;
 }
 
 public static function getListPatientInRendezvous(){
     $query = "SELECT DISTINCT patient.* FROM patient,rendezvous WHERE patient.id = rendezvous.patient_id" ;
     $results = ModelRendezvous::getMany($query)[1];
     return $results;
 }
 
 public static function getListCentreInRendezvous(){
     $query = "SELECT DISTINCT  centre.* FROM centre,rendezvous WHERE centre.id = rendezvous.centre_id" ;
     $results = ModelRendezvous::getMany($query)[1];
     return $results;
 }
 
 
 public static function insert($centre_id,$patient_id,$injection,$vaccin_id) {
  try {
   $database = Model::getInstance();

   
   // ajout d'un nouveau tuple;
   $query = "insert into rendezvous value ( :centre_id, :patient_id, :injection, :vaccin_id)";
   $statement = $database->prepare($query);
   $statement->execute([
     'vaccin_id' => intval($vaccin_id),
     'patient_id' => intval($patient_id),
     'centre_id' => intval($centre_id),
     'injection' => intval($injection)
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("<p>INSERT :: %s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($patient_id,$vaccin_id,$centre_id,$injection) {
  try {
   $database = Model::getInstance();
   // Suppression d'un tuple
   $query = "UPDATE rendezvous SET injection = :injection WHERE vaccin_id = :vaccin_id AND centre_id = :centre_id AND patient_id = :patient_id";
   $statement = $database->prepare($query);
   $statement->execute([
     'vaccin_id' => $vaccin_id ,'patient_id' => $patient_id , 'centre_id' => $centre_id , 'injection' => $injection
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }
 
 public static function checkExistence($vaccin_id,$centre_id) {
    $query = "SELECT * FROM rendezvous where vaccin_id = $vaccin_id AND centre_id = $centre_id";
    return count( ModelRendezvous::getMany($query)[1]);
 }
 
 public static function checkExistencePatientId($patient_id) {
    $query = "SELECT * FROM rendezvous where patient_id = $patient_id";
    return count( ModelRendezvous::getMany($query)[1]);
 }

 public static function delete($vaccin_id,$centre_id) {
  try {
   $database = Model::getInstance();
   // Suppression d'un tuple
   $query = "DELETE FROM rendezvous WHERE vaccin_id = :vaccin_id AND centre_id = :centre_id";
   $statement = $database->prepare($query);
   $statement->execute([
     'vaccin_id' => $vaccin_id,'centre_id' => $centre_id 
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

}
?>
<!-- ----- fin ModelRendezvous -->
