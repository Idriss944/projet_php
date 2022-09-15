
<!-- ----- debut Router1 -->
<?php
require ('../controller/ControllerVaccin.php');
require ('../controller/ControllerCentre.php');
require ('../controller/ControllerPatient.php');
require ('../controller/ControllerStock.php');
require ('../controller/ControllerRendezvous.php');
require ('../controller/ControllerCave.php');




// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

unset($param["action"]);
$args = $param ;

// --- Liste des méthodes autorisées
switch ($action) {
 case "vaccinReadAll" :
 case "vaccinReadOne" :
 case "vaccinReadId" :
 case "vaccinCreate" :
 case "vaccinCreated" :
 case "vaccinUpdate" :
 case "vaccinUpdated" :     
  ControllerVaccin::$action($args);
  break;


 case "centreReadAll" :
 case "centreReadOne" :
 case "centreReadId" :
 case "centreCreate" :
 case "centreCreated" :    
  ControllerCentre::$action($args);
  break;

 case "patientReadAll" :
 case "patientReadOne" :
 case "patientReadId" :
 case "patientCreate" :
 case "patientCreated" :    
  ControllerPatient::$action($args);
  break;

 case "stockReadAll" :
 case "stockReadAllByVaccin" :
 case "stockReadAllGlobal" :
 case "stockReadOne" :
 case "stockReadId" :
 case "stockCreateUpdate" :
 case "stockCreatedUpdated" :
 case "stockDosesAdd" :
 case "stockDosesAddInsert" :
 case "stockDosesAdded" :     
 case "stockDeleted" :
  ControllerStock::$action($args);
  break;

 case "rendezvousReadAll" :
 case "rendezvousReadOne" :
 case "rendezvousReadId" :
 case "rendezvousRegionReadAll" :
 case "rendezvousCountByRegion" :
 case "rendezvousCreate" :
 case "rendezvousCreated" :
 case "rendezvousProcess" :
 case "rendezvousMakeVaccination" :
  ControllerRendezvous::$action($args);
  break;

case "mesPropositions" :
  ControllerCave::$action();
  break;



 // Tache par défaut
 default:
  $action = "caveAccueil";
  ControllerCave::$action();
}
?>
<!-- ----- Fin Router1 -->

