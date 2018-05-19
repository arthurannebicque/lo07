<a type="button" class="btn btn-primary" href="index.php?action=deconnexion">Deconnexion</a>

<?php
if ($_SESSION['type'] == 1) {
    if ($babysitter['candidature_valide']) {
      echo "bonjour babysitter<br>";

      echo '<a type="button" class="btn btn-primary" href="index.php?action=disponibilite&type=simple">Disponibilité simple</a><br>';
      echo '<a type="button" class="btn btn-primary" href="index.php?action=disponibilite&type=recurrente">Disponibilité recurrente</a><br>';
      ?>
      <h2>Vos disponibilités :</h2>
      <table>
          <tr>
              <th>Date</th>
              <th>Heure</th>
              <th>Statut</th>
              <th></th>
          </tr>
          <?php
          while ($slot = $slots->fetch()) {
              if ($slot['statut'] != 'expiré') {
                  ?>
                  <tr>
                      <td><?= $slot['date'] ?></td>
                      <td><?= $slot['heure'] ?></td>
                      <td><?= $slot['statut'] ?></td>
              <?php if ($slot['statut'] == 'reservé')
                  echo
                  '<td><a type="button" class="btn btn-primary" href="index.php?action=showReservation&id=' . $slot['id_reservation'] . '">Détails</a></td>';
              ?>
                  </tr>
              <?php
            }
          }
      echo "</table>";
    }
    elseif (!$babysitter['candidature_valide']) {
      echo "Votre candidature n'a pas encore été validée";
    }

}

if ($_SESSION['type'] == 2) {
    echo "bonjour parent<br>";
    echo '<a type="button" class="btn btn-primary" href="index.php?action=reservation&type=ponctuelle">Réservation simple</a><br>';
    echo '<a type="button" class="btn btn-primary" href="index.php?action=reservation&type=reguliere">Réservation régulière</a><br>';
    echo '<a type="button" class="btn btn-primary" href="index.php?action=reservation&type=langue">Réservation par langue</a><br>';
    ?>
    <h2>Vos réservations :</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Heure début</th>
            <th>Babysitter</th>
        </tr>
        <?php
        while ($reservation = $reservations->fetch()) {
            ?>
            <tr>
                <td><?= $reservation['date'] ?></td>
                <td><?= $reservation['heure_debut'] ?></td>
                <td><?= $reservation['prenom'] ?> <?= $reservation['nom'] ?></td>
                <td><a type="button" class="btn btn-primary" href="index.php?action=showReservation&id=<?= $reservation['id'] ?>">Détails</a></td>
        <?php
        if ($reservation['diff'] <= 0) {
            if ($reservation['note'] == "-1") {
                echo '<td><a type="button" class="btn btn-primary" href="index.php?action=closeReservationForm&id=' . $reservation['id'] . '">Terminer</a></td>';
            } elseif ($reservation['note'] != "-1")
                echo '<td><i>Terminé</i></td>';
        }
        ?>

            </tr>
    <?php } ?>
    </table>
    <?php
}

if ($_SESSION['type'] == 3) {
  ?>
  <table>
      <tr>
          <th>id</th>
          <th>Nom</th>
          <th>Prenom</th>
          <th></th>

      </tr>
      <?php
  while ($babysitter = $babysitters->fetch()) {
    ?>
    <tr>
        <td><?= $babysitter['id'] ?></td>
        <td><?= $babysitter['nom'] ?></td>
        <td><?= $babysitter['prenom'] ?></td>
        <td><a type="button" class="btn btn-primary" href="index.php?action=validateApplication&id=<?= $babysitter['id'] ?>">Valider</a> <a type="button" class="btn btn-primary" href="index.php?action=declineApplication&id=<?= $babysitter['id'] ?>">Refuser</a></td>


    </tr>
    <?php } ?>
    </table>
    <?php } ?>
