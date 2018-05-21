<h2>Récapitulatif de la réservation :</h2>

<?php
if ($_SESSION['type'] == 2) {
  if ($type[0] == 1) {

    ?>
    <h3>Date</h3>
    <?php
    $slot = $slots->fetchall();
    echo $slot[0]['date'];
    $key = count($slot) - 1;
      }
    elseif ($type[0] == 3) {
      echo "<h3>Date</h3>";
      echo "du ".$dateDebut[0]." au ".$dateFin[0];
    }
    if ($type[0] == 1) {
    ?>
    <h3>Créneaux</h3>
    De <?= $slot[0]['heure'] . "h à " . ($slot[$key]['heure'] + 1) . "h."; }

    if ($type[0] == 3) {

    echo "<h3>Créneaux</h3>";
    $listeJour = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    foreach ($creneauResa as $weekday => $heures) {
      echo "<br>".$listeJour[$weekday]."<br>";
      echo "de ".$heures[0]['heure']."h à ".($heures[count($heures)-1]['heure']+1)."h";
      }


  }?>
    <h3>Babysitter</h3>
    <?= $babysitter['prenom'] . " " . $babysitter['nom']; ?>
    <h3>Portable</h3>
    <?= $babysitter['portable']; ?>
    <h3>Enfants gardés</h3>
    <?php
    while ($enfant = $listeEnfants->fetch()) {
        echo $enfant['prenom'];
        echo "<br>";
    }
}

if ($_SESSION['type'] == 1) {
    ?>
    <h3>Date</h3>
    <?php
    $slot = $slots->fetchall();
    echo $slot[0]['date'];
    $key = count($slot) - 1;
    ?>
    <h3>Créneaux</h3>
    De <?= $slot[0]['heure'] . "h à " . ($slot[$key]['heure'] + 1) . "h."; ?>
    <h3>Famille</h3>
    <?= $famille['nom']; ?>
    <h3>Enfants gardés</h3>
    <?php
    while ($enfant = $listeEnfants->fetch()) {
        echo $enfant['prenom'];
        echo "<br>";
        echo "Restrictions alimentaires : " . $enfant['restrictions'];
        echo "<br>";
    }
}
?>
<br>







<a type="button" class="btn btn-primary" href="index.php">Retour</a>
