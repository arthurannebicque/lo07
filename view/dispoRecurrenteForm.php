<form action="index.php?action=addDispoRecurrente" method="post">
<div class="form-label-group">
    <input type="date" id="inputDateDebut" name="date_debut" class ="form-control" placeholder="Date Debut" required>
    <label for="inputDateDebut">Date Debut</label>
</div>
<div class="form-label-group">
    <input type="date" id="inputDateFin" name="date_fin" class ="form-control" placeholder="Date Fin" required>
    <label for="inputDateFin">Date Fin</label>
</div>
<div>
      <?php
      $listeJour = array('LUN', 'MAR', 'MER', 'JEU', 'VEN', 'SAM', 'DIM');
      $listeType = array('Avant l\'école/crèche (6h-8h)', 'Matin (8h-12h)', 'Midi (12h-14h)', 'Après-Midi (14h-17h)', 'Après l\'école/crèche (17-20h)', 'Soirée (20h-23h)', 'Nuit (23h et +)');
      echo "<table>";
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
        for ($i=1; $i < 8; $i++) {
          echo "<td><input name='weekday[{$i}][{$type}]' value='time_type_{$type}' type='checkbox'></td>\n";
        }
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      ?>
   </div>
   <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
</form>
