<?php ob_start(); ?>
<div class="container-fluid">
  <div class="row justify-content-md-center mt-3">
    <h2>Disponibilité Récurrente</h2>
  </div>
</div>
<div class="container-fluid mt-3">
  <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=addDispoRecurrente" method="post">
    <div class="form-group row justify-content-md-center">
      <label class="col-form-label" for="inputDateDebut">Date Debut</label>
      <div class="col-3">
        <input type="date" id="inputDateDebut" name="date_debut" class ="form-control" placeholder="Date Debut" required>
      </div>
      <label class="col-form-label" for="inputDateFin">Date Fin</label>
      <div class="col-3">
        <input type="date" id="inputDateFin" name="date_fin" class ="form-control" placeholder="Date Fin" required>
      </div>
    </div>
    <div class="form-group row justify-content-md-center">
      <?php
      $listeJour = array('LUN', 'MAR', 'MER', 'JEU', 'VEN', 'SAM', 'DIM');
      $listeType = array('Avant l\'école/crèche (6h-8h)', 'Matin (8h-12h)', 'Midi (12h-14h)', 'Après-Midi (14h-17h)', 'Après l\'école/crèche (17-20h)', 'Soirée (20h-23h)', 'Nuit (23h et +)');
      echo "<table class='table w-75 mt-3' cellspacing='0' cellpadding='0'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th></th>";
      foreach ($listeJour as $jour) {
        echo "<th>";
        echo "<span>{$jour}</span>";
        echo "</th>";
      }
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";
      foreach ($listeType as $type => $value) {
        echo "<tr>\n";
        echo "<td>{$value}</td>";
        for ($i = 1; $i < 8; $i++) {
          echo "<td><input name='weekday[{$i}][{$type}]' value='time_type_{$type}' type='checkbox' class='customCheck'></td>\n";
        }
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      ?>
    </div>
    <div class="form-group row justify-content-md-center">
      <div class="col-5">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
      </div>
    </div>
  </form>
</div>
<div class="container mt-5 mb-3">
  <div class="row justify-content-md-center">
    <div class="col-3">
      <a type="button" class="btn btn-outline-secondary btn-block" href="index.php">Retour</a>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
require('view/templateProfil.php'); ?>
