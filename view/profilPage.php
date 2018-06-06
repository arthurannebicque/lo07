<?php
ob_start();
if ($_SESSION['type'] == 1 && $babysitter['candidature_valide']) {


      ?>

      <div class="container-fluid">
      <div class="row justify-content-md-center mt-3">
      <h2>Vos disponibilités</h2>
      </div>
    </div>
    <div class="container" style="min-height:350px">
    <table class="table table-hover btn-table">
    <thead class="thead-light">
          <tr>
              <th>Date</th>
              <th>Heure</th>
              <th style="width: 20%">Statut</th>

          </tr>
        </thead>
          <?php
          while ($slot = $slots->fetch()) {
              if ($slot['statut'] != 'expiré') {
                  if ($slot['statut'] == 'reservé') echo "<tr class='table-danger'>";
                  if ($slot['statut'] == 'disponible') echo "<tr class='table-success'>";?>
                      <td><?= $slot['date'] ?></td>
                      <td><?= $slot['heure'] ?></td>
                      <td><?= $slot['statut'] ?>
              <?php if ($slot['statut'] == 'reservé')
                  echo
                  '<a type="button" class="btn btn-primary btn-sm" href="index.php?action=showReservation&id=' . $slot['id_reservation'] . '">Détails</a></td>';
              ?>
                  </tr>
              <?php
            }
          }
      echo "</table>";
      echo "</div>";
}


if ($_SESSION['type'] == 2) {

    ?>
    <div class="container-fluid">
    <div class="row justify-content-md-center mt-3">
    <h2>Vos réservations :</h2>
    </div>
  </div>
    <div class="container" style="min-height:450px">
    <table class="table table-hover btn-table">
    <thead class="thead-light">
        <tr>
            <th>Date</th>
            <th>Babysitter</th>
            <th style="width: 20%"></th>
        </tr>
      </thead>
        <?php
        foreach ($reservation as $resa) {

            ?>
            <tr>
                <td><?= $resa['date'] ?></td>
                <td><?= $resa['prenom'] ?> <?= $resa['nom'] ?></td>
                <td><a type="button" class="btn btn-primary btn-sm my-0" href="index.php?action=showReservation&id=<?= $resa['id'] ?>">Détails</a>
        <?php
        if ($resa['fin']['difference'] <= 0) {
            if ($resa['note'] == "-1") {
                echo '<a type="button" class="btn btn-outline-danger btn-sm my-0" href="index.php?action=showReservation&id=' . $resa['id'] . '">Terminer</a>';
            } elseif ($resa['note'] != "-1")
                echo '<i>Terminé</i>';
        }
        ?>
      </td>
            </tr>
    <?php } ?>
    </table>
  </div>
    <?php
}

if ($_SESSION['type'] == 3) {
  ?>
  <div class="container-fluid">
  <div class="row justify-content-md-center mt-3">
      <h2>Candidatures en attente</h2>
  </div>
  </div>

  <div class="container justify-content-md-center mb-3" style="min-height:350px">
      <?php


  while ($babysitter = $babysitters->fetch()) {
    ?>
    <div class="bg-light mt-3">
      <div class="card pt-3 px-3 pb-0 border">
          <div class="row">
        <aside class="col-2">
          <div class="row justify-content-md-center">

          <img src="ressources/pictures/<?=$babysitter['photo']?>" height="120px" width="120px">
        </div>
          <div class="row justify-content-md-center">
          <?= $babysitter['ville'] ?>
        </div>
        </aside>
        <div class="col-8">
        <div class="row p-1">
        <h3><?= $babysitter['prenom']." ".$babysitter['nom'] ?></h3>
      </div>
      <div class="row border-top p-1">
        <ul class="list-inline list-unstyled">
          <li class="list-inline-item"><?=$babysitter['age']?> ans,</li>
          <li class="list-inline-item"><?=$babysitter['experience']?> d'expérience</li>
        </ul>
      </div>
      <div class="row p-1">
        <p><?=$babysitter['presentation']?></p>
      </div>
      </div>
      <div class="col-2 ">

        <div class="row ">
          <h4>Langues parlées</h4>
    </div>
    <div class="row" style="height: 50%">
      <ul class="list-unstyled">
        <li>Anglais</li>
        <li>Allemand</li>

      </ul>

  </div>
    <div class="row justify-content-md-end mb-auto">
      <div class="btn-group btn-group-justified mx-auto">
        <div class="btn-group">
          <a type="button" class="btn btn-block btn-success" href="index.php?action=validateApplication&id=<?= $babysitter['id'] ?>">Valider</a>
          </div>
          <div class="btn-group">
            <a type="button" class="btn btn-block btn-danger" href="index.php?action=declineApplication&id=<?= $babysitter['id'] ?>">Refuser</a>
            </div>
          </div>
    </div>
  </div>
</div>

</div>
  </div>

    <?php }
?>
</div>
<?php
}
$content = ob_get_clean();
require('view/templateProfil.php'); ?>
