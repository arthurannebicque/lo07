<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>
  <!-- Bootstrap core CSS -->
  <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
<nav class="navbar navbar-light bg-light static-top justify-content-between border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <img src="icon.png" width="50" height="50">
    </a>
    <div class="navbar">
    <a class="nav-link" href="#discover">Découvrir</a>

    <?php
    if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
      echo('
      <a class="nav-link" href="index.php">Profil</a>
      <a type="button" class="btn btn-outline-primary" href="index.php?action=deconnexion">Deconnexion</a>
      ');
  } else {
    echo('
    <a class="nav-link" href="index.php?action=registration">Inscription</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connexionModalCenter">Connexion</button>

    ');
  }
    ?>


    </div>
  </div>
</nav>

<div class="container-fluid">
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

    ?>
    <div class="container-fluid mt-3">
      <div class="row justify-content-md-center">
        <div class="col-lg-4 col-md-6">
          <div class="panel panel-primary">
            <div class="panel panel-heading">
          <div class="row justify-content-md-center">
            <span>Réservation</span>
          </div>
          <div class="row justify-content-md-center">
            <a class="huge" href="index.php?action=reservation&type=ponctuelle">Ponctuelle</a>
          </div>
        </div>

        </div>
      </div>
          <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
              <div class="panel panel-heading">
                <div class="row justify-content-md-center">
                  <span>Réservation<span>
                  </div>
                <div class="row justify-content-md-center">
                    <a class="huge" href="index.php?action=reservation&type=reguliere">Régulière</a>
                  </div>

                </div>
      </div>
    </div>
        <div class="col-lg-4 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel panel-heading">
          <div class="row justify-content-md-center">
            <span>Réservation</span>
          </div>
          <div class="row justify-content-md-center">
            <a class="huge" href="index.php?action=reservation&type=langue">Par langue</a>
          </div>
        </div>

      </div>
        </div>
          </div>
    </div>
    <div class="row justify-content-md-center mt-3">
    <h2>Vos réservations :</h2>
    </div>
    <div class="container">
    <table class="table table-hover btn-table">
    <thead class="thead-light">
        <tr>
            <th>Date</th>
            <th>Babysitter</th>
            <th style="width: 20%"></th>
        </tr>
      </thead>
        <?php
        while ($reservation = $reservations->fetch()) {
            ?>
            <tr>
                <td><?= $reservation['date'] ?></td>
                <td><?= $reservation['prenom'] ?> <?= $reservation['nom'] ?></td>
                <td><a type="button" class="btn btn-primary btn-sm my-0" href="index.php?action=showReservation&id=<?= $reservation['id'] ?>">Détails</a>
        <?php
        if ($reservation['diff'] <= 0) {
            if ($reservation['note'] == "-1") {
                echo '<a type="button" class="btn btn-primary btn-sm my-0" href="index.php?action=closeReservationForm&id=' . $reservation['id'] . '">Terminer</a>';
            } elseif ($reservation['note'] != "-1")
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
    <div class="row justify-content-md-center">
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
          <div class="panel panel-heading">
        <div class="row justify-content-md-center">
          <span>Nombre de candidature</span>
        </div>
        <div class="row justify-content-md-center">
          <a class="huge" href="index.php?element=application"><?=$applicationCount[0]?></a>
        </div>
        <br>
      </div>
      <div class="panel-footer text-center">

        <a href="index.php?element=application">Voir plus</a>
    </div>
      </div>
    </div>
        <div class="col-lg-4 col-md-6">
          <?php
          if (isset($_GET['revenu'])) {
            if ($_GET['revenu'] == 'trimestriel') {
              $periode = "des trois derniers mois";
              $revenu = $revenuTrimestrielGlobal[0];
            }
            if ($_GET['revenu'] == 'annuel') {
              $periode = "de l'année en cours";
              $revenu = $revenuAnnuelGlobal[0];
            }
            if ($_GET['revenu'] == 'mensuel') {
              $periode = "du mois";
              $revenu = $revenuMensuelGlobal[0];
            }
          }
          else {
            $periode = "du mois";
            $revenu = $revenuMensuelGlobal[0];
          }?>
          <div class="panel panel-green">
            <div class="panel panel-heading">
              <div class="row justify-content-md-center">
                <span>Chiffre d'affaire <?=$periode?><span>
                </div>
              <div class="row justify-content-md-center">
                  <a class="huge" href="index.php?element=revenu"><?=$revenu?>€</a>
                </div>
                <div class="row justify-content-md-center">
                <a href="index.php?revenu=mensuel&element=<?=$_GET['element']?>">Mensuel</a><a href="index.php?revenu=trimestriel&element=<?=$_GET['element']?>"> Trimestriel </a> <a href="index.php?revenu=annuel&element=<?=$_GET['element']?>"> Annuel</a>
              </div>
              </div>
          <div class="panel-footer text-center">

            <a href="index.php?element=revenu">Voir plus</a>
        </div>
    </div>
  </div>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
          <div class="panel panel-heading">
        <div class="row justify-content-md-center">
          <span>Nombre de babysitters inscrits</span>
        </div>
        <div class="row justify-content-md-center">
          <a class="huge" href="index.php?element=babysitters"><?=$babysitterCount[0]?></a>
        </div>
        <br>
      </div>
      <div class="panel-footer text-center">

        <a href="index.php?element=babysitters">Voir plus</a>
    </div>
    </div>
      </div>
        </div>
  </div>
  <hr>

  <div class="container">
      <?php
      if (isset($_GET['element'])) {
        if ($_GET['element']=='application') {
  while ($babysitter = $babysitters->fetch()) {
    ?>
        <div class="row m-auto">
        <div class="col-2">
          photo
        </div>
        <div class="col-10">
            <div class="row">
              <div class="col-10">
                <h3 ><?= $babysitter['prenom']." ".$babysitter['nom']?></h3><p class="card-text"><?= $babysitter['ville']?></p>
              </div>
              <div class="col-2">
                <div class="btn-group-vertical btn-group-justified">
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
    <?php }
  }
if ($_GET['element']=='revenu') {

    while ($revenuBabysitter = $listeRevenuBabysitter->fetch()) {
      echo $revenuBabysitter['prenom']." ".$revenuBabysitter['nom']." Revenu : ".$revenuBabysitter['revenu']."<br>";
    }
  }
}
   } ?>
  </div>
  </div>
</body>
