<!-- ----- début fragmentCaveMenu -->

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="router.php?action=CaveAccueil">Yann Kevin & Jeff Jordan</a>
    </div>
    <ul class="nav navbar-nav">
        
      <?php
      addDropdownMenuItem("Gestion des vaccins",array(
          array("action"=>"vaccinReadAll","label"=>"Liste des vaccins"),
          array("action"=>"vaccinCreate","label"=>"Ajout d'un vaccin"),
          array("action"=>"vaccinUpdate","label"=>"Mise à jour d'un vaccin")
      ));

      addDropdownMenuItem("Gestion des centres",array(
          array("action"=>"centreCreate","label"=>"Ajout d'un centre"),
          array("action"=>"centreReadAll","label"=>"Liste des centres")
      ));
      
      addDropdownMenuItem("Gestion des patients",array(
          array("action"=>"patientCreate","label"=>"Ajout d'un patient"),
          array("action"=>"patientReadAll","label"=>"Liste des patients")
      ));
      
      addDropdownMenuItem("Gestion des stocks",array(
          array("action"=>"stockReadAllByVaccin","label"=>"Liste des centres avec le nombre de dose de chaque vaccin"),
          array("action"=>"stockReadAllGlobal","label"=>"Nombre global de doses des centres"),
          array("action"=>"stockDosesAdd","label"=>"Attribution d'un vaccin pour un centre")
       
      ));
      
      addDropdownMenuItem("Gestion des rendez-vous",array(
          array("action"=>"rendezvousReadId","label"=>"Dossier de vaccination d'un client")
      ));
      
      addDropdownMenuItem("Mes innovations",array(
          array("action"=>" ","label"=>" ")
      ));
      
      addDropdownMenuItem("Documentation",array(
          array("action"=>" ","label"=>" ")
      ));
   
      ?>
     
    </ul>
  </div>
</nav>

<!-- ----- fin fragmentCaveMenu -->

