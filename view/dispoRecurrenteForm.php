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
                echo "<td><input name='weekday[{$i}][{$type}]' value='time_type_{$type}' type='checkbox'></td>\n";
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
</body>
</html>
