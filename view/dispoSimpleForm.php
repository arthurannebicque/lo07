<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">

        <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">
        <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
          <span>Disponibilité</span>
        </div>
        <div class="row justify-content-md-center">
          <a class="huge" href="index.php?action=disponibilite&type=simple">Simple</a>
        </div>
      </div>

      </div>
    </div>
        <div class="col-lg-4 col-md-6">
          <div class="panel panel-green">
            <div class="panel panel-heading">
              <div class="row justify-content-md-center">
                <span class="invisible">Dispo<span>
                </div>
              <div class="row justify-content-md-center">
                  <a class="huge" href="index.php">Accueil</a>
                </div>

              </div>
    </div>
  </div>
      <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
          <div class="panel panel-heading">
        <div class="row justify-content-md-center">
          <span>Disponibilité</span>
        </div>
        <div class="row justify-content-md-center">
          <a class="huge" href="index.php?action=disponibilite&type=recurrente">Récurrente</a>
        </div>
      </div>

    </div>
      </div>
        </div>
  </div>
  <div class="container-fluid">
  <div class="row justify-content-md-center mt-3">
      <h2>Disponibilité Simple</h2>
  </div>
</div>
<div class="container-fluid mt-3">
        <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=addDispoSimple" method="post">

          <div class="form-group row justify-content-md-center">
            <label class="col-form-label">Date</label>
            <div class="col-3">
            <input class="form-control" type="date" name="date" required>
          </div>
            </div>

            <div class="form-group row justify-content-md-center">
              <div class="col-2">
                <input type="number" id="inputHeureDebut" name="heure_debut" class ="form-control" placeholder="Heure Debut" min="0" max="23" required autofocus>
              </div>
              <div class="col-2">
                <input type="number" id="inputHeureFin" name="heure_fin" class ="form-control" placeholder="Heure Fin" min="1" max="24" required autofocus>
              </div>
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
    </body>
