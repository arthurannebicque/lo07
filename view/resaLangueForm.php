<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script>
      $(function() {
      // run on change for the selectbox
      $( "#dispo<?= $babysitter['id'];?>" ).change(function() {
        updateInputNumber();

      });

      // handle the updating of the duration divs
      function updateInputNumber() {
       // hide all form-duration-divs
       //$('.form-input-children').hide();
       $("#newinput").empty();
       var divKey = $( "#nombre_enfants option:selected" ).val();
       //$('#enfant'+divKey).show();

      var i;
      for ( i=0 ; i < divKey ; i++) {
       var txt = "<h3>Enfant n°"+ (i+1) +"</h3><label>Prenom</label><input type='text' name='enfants["
       + i +"][name]' class ='form-control' placeholder='Prenom' required><div class='form-label-group'>Date de naissance<input type='date' name='enfants["
       + i +"][date]'></div><div class='form-label-group' required><label for='inputRestriction'>Restrictions alimentaires</label><textarea id='inputRestriction' name='enfants["
       + i +"][restrictions]' class='form-control' placeholder='Restrictions' required></textarea></div>";
       $("#newinput").append(txt);
      }
    }
      // run at load, for the currently selected div to show up
      updateInputNumber();

      });
    </script>
  </head>

  <body>
<form class="form-signin" action="index.php?action=requestResaLangue" method="post">
  <div class="text-center mb-4">
    <h1 class="h3 mb-3 font-weight-normal">Réservation par langue</h1>
  </div>
  <div class="form-label-group">
    <label for="inputLangues">Langue recherchée</label>
      <select id="inputLangues" name="langue" class ="form-control">
        <?php
        while ($langue = $listeLangues->fetch()) {
          echo "<option value=".$langue['id'].">".$langue['langue']."</option>";
        }
         ?>
         </select>
  <div class="form-label-group">
    <label>Enfants à garder :</label>
    <select name="enfants[]" multiple>
      <?php
      while ($enfant = $listeEnfants->fetch()) {
        echo "<option value=".$enfant['id'].">".$enfant['prenom']."</option>";
      }
      ?>
   </select>
 </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
</form>
<?php if (!empty($listBabysitters)) {

//$req = htmlspecialchars(serialize($req), ENT_QUOTES);
//$req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
?>
<h2>Babysitters parlant <?= $selectedLangue['langue']; ?> :</h2>
<!--<h3>le <?= $date ?> de <?= $heure_debut ?>h à <?= $heure_fin ?>h.</h3>-->

 <?php
 print_r ($selectedEnfants);
 foreach ($babysitters as $babysitter) {
   echo $babysitter['id']." ".$babysitter['prenom']." ".$babysitter['nom']." ";
   echo "<a type='button' class='btn btn-primary' id='dispo".$babysitter['id']."' href=''>Voir disponibilités</a>";?>
   <form class="form-signin" action="index.php?action=createResaLangue" method="post">
   <?php
   foreach ($Dispos as $listDispo) {
     foreach ($listDispo as $dispo) {
       echo $dispo['date']." ". $dispo['heure']." <input type='checkbox' name='dispo[]' value=".$dispo['id_dispo']."><br>";
     }
   }
   echo "<input type='hidden' name='id_babysitter' value=".$babysitter['id'].">";
   foreach ($selectedEnfants as $selectedEnfant) {
     echo "<input type='hidden' name='enfants[]' value=".$selectedEnfant.">";
   }
   echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Choisir</button>";
   echo "</form>";
 }
echo "<br>";
} ?>
<br>
<a type="button" class="btn btn-primary" href="index.php">Retour</a>

</body>
