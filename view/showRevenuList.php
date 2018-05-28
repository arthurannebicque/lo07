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
              <a href="index.php?action=showRevenuList&revenu=mensuel">Mensuel</a><a href="index.php?action=showRevenuList&revenu=trimestriel"> Trimestriel </a> <a href="index.php?action=showRevenuList&revenu=annuel"> Annuel</a>
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
<h2>Classement des babysitters par revenu :</h2>
</div>
</div>
<div class="container">
<table class="table table-hover btn-table mt-3">
<thead class="thead-light">
<tr>
    <th>Prénom</th>
    <th>Nom</th>
    <th style="width: 20%">Revenu</th>
</tr>
</thead>
<?php
while ($revenuBabysitter = $listeRevenuBabysitter->fetch()) {

    ?>
    <tr>
        <td><?= $revenuBabysitter['prenom'] ?></td>
        <td><?= $revenuBabysitter['nom'] ?></td>
        <td><?= $revenuBabysitter['revenu'] ?>€</td>
    </tr>
<?php } ?>
</table>
</div>
