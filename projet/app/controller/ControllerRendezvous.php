
<!-- ----- debut ControllerRendezvous -->
<?php
require_once '../model/ModelRendezvous.php';
require_once '../model/ModelVaccin.php';
require_once '../model/ModelPatient.php';
require_once '../model/ModelStock.php';
require_once '../model/ModelCentre.php';

class ControllerRendezvous {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerRendezvous : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des rendezvouss
 public static function rendezvousReadAll() {
  $results = ModelRendezvous::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewAll.php';
  if (DEBUG)
   echo ("ControllerRendezvous : rendezvousReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function rendezvousReadId($args) {
  $results = ModelPatient::getAll();
  
  //$target = $args["target"];
  $target = "rendezvousProcess";
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewId.php';
  require ($vue);
 }

 // Affiche un rendezvous particulier (id)
 public static function rendezvousReadOne() {
  $vaccin_id = intval(explode(" : ",htmlspecialchars($_GET['vaccin_id']))[0] );
  $prod_id = intval(explode(" : ",htmlspecialchars($_GET['centre_id']))[0] );
  $results = ModelRendezvous::getOne($vaccin_id,$prod_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un rendezvous
 public static function rendezvousCreateUpdate() {
  // ----- Construction chemin de la vue
  $liste_vaccin = ModelVaccin::getAll();
  $liste_centre = ModelCentre::getAll();
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau rendezvous.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function rendezvousCreatedUpdated() {
  // ajouter une validation des informations du formulaire
  $vaccin_id = intval(explode(" : ", htmlspecialchars($_GET['vaccin_id']))[0]);
  $prod_id = intval(explode(" : ", htmlspecialchars($_GET['centre_id']))[0]);
  $existence = ModelRendezvous::checkExistence($vaccin_id, $prod_id) ;
  if ($existence){
    $results = ModelRendezvous::update($vaccin_id, $prod_id, htmlspecialchars($_GET['quantite']));
  }else{
    $results = ModelRendezvous::insert($vaccin_id, $prod_id, htmlspecialchars($_GET['quantite']));
  }
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewInserted.php';
  require ($vue);
 }
 
 public static function rendezvousProcess() {
  // ajouter une validation des informations du formulaire
  $patient_id = intval(explode(" : ", htmlspecialchars($_GET['patient_id']))[0]);
  $existence = ModelRendezvous::checkExistencePatientId($patient_id) ;
  $injection = 0 ;
  if ($existence){
    //LE PATIENT EXISTE DANS LA TABLE RENDEZ-VOUS DONC INJECTION >= 0
    //Recuperer le nombre d'injection
    $rendezvous = ModelRendezvous::getRendezVousByPatient($patient_id)[0];
    $injection = $rendezvous[2];
    $vaccin_id = $rendezvous[3];
    $centre_id = $rendezvous[0];
    $doses = ModelVaccin::getOne($vaccin_id)->getDoses();
    if($injection === 0 ){
        $results = ModelRendezvous::getMany("SELECT centre.id as ID,centre.label as Centre, SUM(stock.quantite) as Doses FROM centre,stock WHERE stock.centre_id = centre.id GROUP BY ID HAVING Doses > 0 ORDER BY Doses DESC;")[1];
        include 'config.php';
        $target = "rendezvousMakeVaccination" ;
        //PREMIRE VACCINATION
        $status = 1 ;
        $vue = $root . '/app/view/rendezvous/viewSelectCentre.php';
        require ($vue);
    }elseif ( $injection > 0 && $injection < $doses ) {
        $results = ModelRendezvous::getMany("SELECT centre.id as ID,centre.label as Centre, stock.quantite as Quantite FROM centre,vaccin,stock WHERE stock.centre_id = centre.id  AND stock.vaccin_id = vaccin.id AND stock.vaccin_id = $vaccin_id and stock.quantite > 0")[1];
        include 'config.php';
        $target = "rendezvousMakeVaccination" ;
        //SECONDE VACCINATION ET PLUS
        $status = 2 ;
        
        $flagNoMoreVaccin = false;
        if(count($results)===0){
            $flagNoMoreVaccin = true;
        }
        $vue = $root . '/app/view/rendezvous/viewSelectCentre.php';
        require ($vue);        
    }else{
        $results = ModelRendezvous::getMany("SELECT DISTINCT patient.nom as Nom, patient.prenom as Prenom, vaccin.label as Vaccin, rendezvous.injection as Injections "
                                          . "FROM vaccin,centre,patient,rendezvous "
                                          . "WHERE rendezvous.patient_id = patient.id AND rendezvous.patient_id = $patient_id AND vaccin.id = rendezvous.vaccin_id AND rendezvous.centre_id = $centre_id AND rendezvous.vaccin_id = $vaccin_id ");
        include 'config.php';
        $target = "truc" ;
        $vue = $root . '/app/view/rendezvous/viewAll.php';
        require ($vue);
    }
    //$results = ModelRendezvous::update($vaccin_id, $prod_id, htmlspecialchars($_GET['quantite']));
  }else{
    //LE PATIENT N'EXISTE PAS DANS LA TABLE RENDEZ-VOUS DONC INJECTION == 0
    //
    $results = ModelRendezvous::getMany("SELECT centre.id as ID,centre.label as Centre, SUM(stock.quantite) as Doses FROM centre,stock WHERE stock.centre_id = centre.id GROUP BY Centre HAVING Doses > 0 ORDER BY Doses DESC;")[1];
    include 'config.php';
    $target = "rendezvousMakeVaccination" ;
    //PREMIERE VACCINATION
    $status = 1 ;
    $injection = 0;

    $vue = $root . '/app/view/rendezvous/viewSelectCentre.php';
    require ($vue);
  }
  // ----- Construction chemin de la vue
  
 }
 
  public static function rendezvousMakeVaccination() {
  // ajouter une validation des informations du formulaire
  $centre_id = intval(explode(" : ", htmlspecialchars($_GET['centre_id']))[0]);
  $status = intval(htmlspecialchars($_GET['status']));
  $flagReussite = True ;
  
  switch ($status) {
      //PREMIERE VACCINATION
      case 1:
         //Le vaccin qui sera utilisé
         $stock = ModelRendezvous::getMany("SELECT stock.vaccin_id, quantite FROM  stock WHERE stock.centre_id = $centre_id AND stock.quantite = (SELECT MAX(stock.quantite) FROM stock WHERE stock.centre_id = $centre_id) ;")[1][0];
         $vaccin_id = $stock[0];
         $quantite = $stock[1] - 1 ;
         //mise à jour du stock dans le centre
         $results = ModelStock::update($vaccin_id, $centre_id,$quantite);
         //mise à jour du dossier de rendez-vous du client
         $results = ModelRendezvous::insert($centre_id,intval(htmlspecialchars($_GET['patient_id'])),intval(htmlspecialchars($_GET['injection']))+1,$vaccin_id);
         
        $results = ModelRendezvous::getMany("SELECT DISTINCT patient.nom as Nom, patient.prenom as Prenom, vaccin.label as Vaccin, rendezvous.injection as Injections "
                                          . "FROM vaccin,centre,patient,rendezvous "
                                          . "WHERE rendezvous.patient_id = patient.id AND rendezvous.patient_id = ".intval(htmlspecialchars($_GET['patient_id']))." AND vaccin.id = rendezvous.vaccin_id AND rendezvous.centre_id = $centre_id AND rendezvous.vaccin_id = $vaccin_id ");
         include 'config.php';
         $target = "truc" ;
         $vue = $root . '/app/view/rendezvous/viewAll.php';
         require ($vue);  
      break;
  
      //SECONDE VACCINATION ET PLUS
      case 2:
          //Le vaccin qui a déjà été administré
         $vaccin_id = intval(htmlspecialchars($_GET['vaccin_id']));
         $stock = ModelRendezvous::getMany("SELECT stock.vaccin_id, stock.quantite FROM  stock WHERE stock.vaccin_id = $vaccin_id AND stock.centre_id = $centre_id  ;")[1][0];     
         $quantite = $stock[1] - 1 ;
         //mise à jour du stock dans le centre
         $results = ModelStock::update($vaccin_id, $centre_id,$quantite);
         //mise à jour du dossier de rendez-vous du client
         //echo "<br><br><br><br><br><br><br><br>";
         $results = ModelRendezvous::update(intval(htmlspecialchars($_GET['patient_id'])), $vaccin_id, $centre_id, intval(htmlspecialchars($_GET['injection']))+1);
         if($results === 0 ){
             $results = ModelRendezvous::insert($centre_id,intval(htmlspecialchars($_GET['patient_id'])),intval(htmlspecialchars($_GET['injection']))+1,$vaccin_id);
         }
         //echo "<br><br><br><br><br><br><br><br>RESULT : $results";
        $results = ModelRendezvous::getMany("SELECT DISTINCT patient.nom as Nom, patient.prenom as Prenom, vaccin.label as Vaccin, rendezvous.injection as Injections "
                                          . "FROM vaccin,centre,patient,rendezvous "
                                          . "WHERE rendezvous.patient_id = patient.id AND rendezvous.patient_id = ".intval(htmlspecialchars($_GET['patient_id']))." AND vaccin.id = rendezvous.vaccin_id AND rendezvous.centre_id = $centre_id AND rendezvous.vaccin_id = $vaccin_id ");
         include 'config.php';
         $target = "truc" ;
         $vue = $root . '/app/view/rendezvous/viewAll.php';
         require ($vue);
      break;
  
      default:
      break;
  }
  
 }
 
 public static function rendezvousDeleted() {
  // ajouter une validation des informations du formulaire
  $vaccin_id = intval(explode(" : ", htmlspecialchars($_GET['vaccin_id']))[0]);
  $prod_id = intval(explode(" : ", htmlspecialchars($_GET['centre_id']))[0]);
  $last_view = ModelRendezvous::getOne($vaccin_id,$prod_id)[1];

  $results = ModelRendezvous::delete($vaccin_id,$prod_id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewDeleted.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerRendezvous -->


