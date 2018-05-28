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

<div class="container-fluid mt-3">
  <div class="row justify-content-md-center">
    <div class="col-lg-4 col-md-6">
      <div class="panel panel-primary">
        <div class="panel panel-heading">
      <div class="row justify-content-md-center">
        <span>Nombre de candidature</span>
      </div>
      <div class="row justify-content-md-center">
        <a class="huge" href="index.php"><?=$applicationCount[0]?></a>
      </div>
      <br>
    </div>
    <div class="panel-footer text-center">

      <a href="index.php">Voir plus</a>
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
                <a class="huge" href="index.php?action=showRevenuList"><?=$revenu?>€</a>
              </div>
              <div class="row justify-content-md-center">
              <a href="index.php?action=showSearchForm&revenu=mensuel">Mensuel</a><a href="index.php?action=showSearchForm&revenu=trimestriel"> Trimestriel </a> <a href="index.php?action=showSearchForm&revenu=annuel"> Annuel</a>
            </div>
            </div>
        <div class="panel-footer text-center">

          <a href="index.php?action=showRevenuList">Voir plus</a>
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
        <a class="huge" href="index.php?action=showSearchForm"><?=$babysitterCount[0]?></a>
      </div>
      <br>
    </div>
    <div class="panel-footer text-center">

      <a href="index.php?action=showSearchForm">Voir plus</a>
  </div>
  </div>
    </div>
      </div>
</div>

<div class="container-fluid">
<div class="row justify-content-md-center mt-3">
    <h2>Rechercher un Babysitter</h2>
</div>
</div>
<div class="container-fluid mt-3">
  <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=searchBabysitter" method="post">


        <div class="form-group row justify-content-md-center">
          <div class="col-3">
          <input class="form-control" type="text" name="name" placeholder="Nom de famille" required>
        </div>

            <div class="col-2">
          <button class="btn btn-primary form-control" type="submit">Rechercher</button>
        </div>
        </div>
      </form>
    </div>
<?php if (isset($babysittersSearch)) {
   ?>


    <div class="container">
    <table class="table table-hover btn-table mt-3">
    <thead class="thead-light">
    <tr>
        <th>Prénom</th>
        <th>Nom</th>
        <th style="width: 20%"></th>
    </tr>
    </thead>
    <?php

    while ($babysitter = $babysittersSearch->fetch()) {

        ?>
        <tr>
            <td><?= $babysitter['prenom'] ?></td>
            <td><?= $babysitter['nom'] ?></td>
            <td><a type="button" class="btn btn-primary btn-sm my-0" href="index.php?action=showBabysitterDetails&id=<?= $babysitter['id'] ?>">Voir prestations</a></td>
        </tr>
    <?php } ?>
    </table>
    </div>
<?php }
if (isset($reservations)) {
  ?>
  <div class="container justify-content-md-center mb-3">
  <div class="bg-light mt-4">
    <div class="card pt-3 px-3 pb-0">
        <div class="row">
      <aside class="col-2 ">
        <div class="row justify-content-md-center">

        <img src="ressources/pictures/<?=$babysitterInfos['photo']?>" maxheight="180px">
      </div>
        <div class="row justify-content-md-center">
        <?= $babysitterInfos['ville'] ?>
      </div>
      </aside>
      <div class="col-8 ">
      <div class="row p-1">
      <h3><?= $babysitterInfos['prenom']." ".$babysitterInfos['nom'] ?></h3>
    </div>
    <div class="row border-top p-1">
      <ul class="list-inline list-unstyled">
        <li class="list-inline-item"><?=$babysitterInfos['age']?> ans,</li>
        <li class="list-inline-item"><?=$babysitterInfos['experience']?> d'expérience</li>
      </ul>
    </div>
    <div class="row p-1">
      <p>Bonjour, Je suis actuellement en Terminale Littéraire spécialité musique, je suis disponible tout les weekends, pendant les vacances scolaires et les mercredis après-midi. N'hésitez...</p>
    </div>
    </div>
    <div class="col-2">

      <div class="row ">
        <h4>Langues parlées</h4>
  </div>
  <div class="row p-1">
    <ul class="list-unstyled">
      <li>Anglais</li>
      <li>Allemand</li>

    </ul>

</div>

</div>
</div>

</div>
</div>
</div>

<div class="container justify-content-md-center mb-3">
<div class="card pt-3 px-3 pb-0">
  <div class="row justify-content-md-center mt-3">
      <h2>Résumé des prestations</h2>
  </div>
  <?php
  foreach ($reservations as $reservation) {
    echo "<div class='container-fluid mt-3'>";

    echo "<div class='row justify-content-md-center'>";

    echo "<h5>Date :";

      $slot = $reservation['slots']->fetchall();
      if (($reservation['type'] == 1)||($reservation['type'] == 2)) {

        echo " <small>".$slot[0]['date']."</small></h2>";
      } elseif ($reservation['type'] == 3) {
        echo " <small>Du ".$reservation['dateDebut'][0]." au ".$reservation['dateFin'][0]."</small></h5>";

      }

    echo "</div>";
    echo "<div class='row justify-content-md-center mt-2'>";
    if (($reservation['type'] == 1)||($reservation['type'] == 2)) {
        echo "<h5>Créneau :";
      } elseif ($reservation['type'] == 3) {
        echo "<h5>Créneaux :</h5>";

      }

      if (($reservation['type'] == 1)||($reservation['type'] == 2)) {
        $key = count($slot) - 1;
        echo " <small>De ".$slot[0]['heure']. "h à " . ($slot[$key]['heure'] + 1) . "h.</small></h5>";

      } elseif ($reservation['type'] == 3) {

        $listeJour = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        foreach ($reservation['creneauResa'] as $weekday => $heures) {
          echo "<div class='col-2'>";
          echo "<div class='row justify-content-md-center'>";
          echo "<h5><small>".$listeJour[$weekday]."</small></h5>";
          echo "</div>";
          echo "<div class='row justify-content-md-center'>";
          echo "<h5><small>De ".$heures[0]['heure']."h à ".($heures[count($heures)-1]['heure']+1)."h</small></h5>";
          echo "</div>";
          echo "</div>";

        }


      }
      echo "</div>";
    echo "<div class='row justify-content-md-center mt-2'>";
    echo "<div class='col-2'>";
    echo "<div class='row'>";
    echo "<h3><small>Famille</small></h3>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<h5><small>".$reservation['nom']."</small></h5>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<h5><small>".$reservation['ville']."</small></h5>";
    echo "</div>";
    echo "</div>";
    echo "<div class='col-2'>";
    echo "<div class='row'>";
    echo "<h3><small>Enfants gardés</small></h3>";
    echo "</div>";
    while ($enfant = $reservation['listeEnfants']->fetch()) {
      echo "<div class='row'>";
      echo "<h5><small>".$enfant['prenom']."</small></h5>";
      echo "</div>";
  }
    echo "</div>";
    if ($reservation['note'] != '-1') {
    echo "<div class='col-3'>";
    echo "<div class='row'>";
    echo "<h3><small>Évaluation</small></h3>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<h5><small>".$reservation['note']."/5</small></h5>";
    echo "</div>";
    echo "<div class='row'>";
    echo "<h5><small>".$reservation['evaluation']."</small></h5>";
    echo "</div>";
    echo "</div>";
  }
    echo "</div>";
    echo "</div>";
    echo "<div class='row justify-content-md-center mt-3'>";
    echo "<div class='col-9 border'>";
    echo "</div>";

    echo "</div>";
  }

}?>
</div>
</div>
