
<!-- ----- debut ModelStock -->

<?php
require_once 'Model.php';
require_once 'ModelVaccin.php';
require_once 'ModelCentre.php';

class ModelStock {
 private $centre_id, $vaccin_id, $quantite;

 // pas possible d'avoir 2 constructeurs
 public function __construct($centre_id = NULL, $vaccin_id = NULL, $quantite = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($centre_id)) {
   $this->centre_id = $centre_id;
   $this->vaccin_id = $vaccin_id;
   $this->quantite = $quantite;
  }
 }

 function setCentre_id($centre_id) {
  $this->centre_id = $centre_id;
 }

 function setVaccin_id($vaccin_id) {
  $this->vaccin_id = $vaccin_id;
 }

 function setQuantite($quantite) {
  $this->quantite = $quantite;
 }

 function getCentre_id() {
  return $this->centre_id;
 }

 function getVaccin_id() {
  return $this->vaccin_id;
 }

 function getQuantite() {
  return $this->quantite;
 }

 
// retourne une liste des id
 public static function getAllId() {
  $vaccins = ModelStock::getListVaccinInStock();
  $prods = ModelStock::getListCentreInStock();
  return array($vaccins,$prods);
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
   printf("
<br><br><br><br> %s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
    $query = "select * from stock";
    return ModelStock::getMany($query);
  
 }
 
 public static function getAllByVaccin() {
    $query = "SELECT centre.label as Centre ,vaccin.label as Vaccin ,stock.quantite as Quantite FROM centre,vaccin,stock WHERE stock.centre_id = centre.id  AND stock.vaccin_id = vaccin.id;";
    return ModelStock::getMany($query);
 }
 
 
 
 public static function getAllVaccin() {
    $query = "SELECT vaccin.id as ID ,vaccin.label as Vaccin FROM vaccin";
    return ModelStock::getMany($query);
  
 }
 
  public static function getAllVaccinByCentre($centre_id) {
    $query = "SELECT centre.label as Centre, vaccin.label as Vaccin,stock.quantite as Doses FROM vaccin,stock,centre WHERE stock.vaccin_id=vaccin.id AND stock.centre_id = centre.id AND stock.centre_id =$centre_id  ;";
    return ModelStock::getMany($query);
  
 }
 
 public static function getAllGlobal() {
    $query = "SELECT centre.label as Centre, SUM(stock.quantite) as Doses FROM centre,stock WHERE stock.centre_id = centre.id GROUP BY Centre  ORDER BY Doses DESC;";
    return ModelStock::getMany($query);
  
 }

 public static function getOne($vaccin_id,$centre_id) {
   $database = Model::getInstance();
   $query = "select * from stock where vaccin_id = $vaccin_id AND centre_id = $centre_id";
   return ModelStock::getMany($query);
 }

 public static function getListVaccin(){
     $query = "SELECT vaccin.* FROM vaccin" ;
     $results = ModelStock::getMany($query)[1];
     return $results;
 }
 
 public static function getListCentre(){
     $query = "SELECT centre.* FROM centre" ;
     $results = ModelStock::getMany($query)[1];
     return $results;
 }
 
 public static function getListVaccinInStock(){
     $query = "SELECT DISTINCT vaccin.* FROM vaccin,stock WHERE vaccin.id = stock.vaccin_id" ;
     $results = ModelStock::getMany($query)[1];
     return $results;
 }
 
 public static function getListCentreInStock(){
     $query = "SELECT DISTINCT  centre.* FROM centre,stock WHERE centre.id = stock.centre_id" ;
     $results = ModelStock::getMany($query)[1];
     return $results;
 }
 
 
 public static function insert($vaccin_id,$prod_id,$quantite) {
  try {
   $database = Model::getInstance();

   
   // ajout d'un nouveau tuple;
   $query = "insert into stock value ( :prod_id,:vaccin_id, :qtt)";
   $statement = $database->prepare($query);
   $statement->execute([
     'vaccin_id' => intval($vaccin_id),
     'prod_id' => intval($prod_id),
     'qtt' => $quantite,
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("<p>INSERT :: %s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($vaccin_id,$centre_id,$quantite) {
  try {
   $database = Model::getInstance();
   // Suppression d'un tuple
   $query = "UPDATE stock SET quantite = :qtt WHERE vaccin_id = :vaccin_id AND centre_id = :centre_id";
   $statement = $database->prepare($query);
   $statement->execute([
     'vaccin_id' => $vaccin_id , 'centre_id' => $centre_id , 'qtt' => $quantite
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("<p>%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }
 
 public static function checkExistence($vaccin_id,$prod_id) {
    $query = "SELECT * FROM stock where vaccin_id = $vaccin_id AND centre_id = $prod_id";
    return count( ModelStock::getMany($query)[1]);
 }

 public static function delete($vaccin_id,$prod_id) {
  try {
   $database = Model::getInstance();
   // Suppression d'un tuple
   $query = "DELETE FROM stock WHERE vaccin_id = :vaccin_id AND centre_id = :prod_id";
   $statement = $database->prepare($query);
   $statement->execute([
     'vaccin_id' => $vaccin_id,'prod_id' => $prod_id 
   ]);
   return $statement->rowCount();
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

}
?>
<!-- ----- fin ModelStock -->
