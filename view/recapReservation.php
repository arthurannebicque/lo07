<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">


    </head>

    <body>
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
      <div class="container-fluid">
      <div class="row justify-content-md-center mt-3">
          <h2>Récapitulatif de la réservation</h2>
      </div>
      </div>


<?php
if ($_SESSION['type'] == 2) {
?>

  <div class="container mt-3 border">
    <div class="row">
      <div class="col-3">
        <div class="card text-center">
          <img class="card-img-top" src="feeding-bottle.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><?=$babysitter['prenom']." ".$babysitter['nom']?></h5>
        <p class="card-text "><?=$babysitter['portable']?></p>
      </div>
    </div>
  </div>
  <div class="col-9 border">
    <article class="mt-5 mb-5 bg-light border" style="padding:20px;">
      <div class="row justify-content-md-center">
        <h3>Date</h3>
      </div>
      <div class="row justify-content-md-center">
        <?php if ($type[0] == 1) {
          $slot = $slots->fetchall();
          echo "<h6>".$slot[0]['date']."</h6>";
        } elseif ($type[0] == 3) {
          echo "<h6>Du ".$dateDebut[0]." au ".$dateFin[0]."</h6>";
        }
        ?>
      </div>
      <div class="row justify-content-md-center">
        <?php if ($type[0] == 1) {
          echo "<h3>Créneau</h3>";
        } elseif ($type[0] == 3) {
          echo "<h3>Créneaux</h3>";
        }
        ?>
      </div>
      <div class="row justify-content-md-center">
        <?php if ($type[0] == 1) {
          $key = count($slot) - 1;
          echo "De ".$slot[0]['heure']. "h à " . ($slot[$key]['heure'] + 1) . "h.";
        } elseif ($type[0] == 3) {
          $listeJour = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
          foreach ($creneauResa as $weekday => $heures) {
            echo "<div class='col'>";
            echo "<div class='row justify-content-md-center'>";
            echo $listeJour[$weekday];
            echo "</div>";
            echo "<div class='row justify-content-md-center'>";
            echo "De ".$heures[0]['heure']."h à ".($heures[count($heures)-1]['heure']+1)."h";
            echo "</div>";
            echo "</div>";
          }
        }
        ?>
      </div>
      <div class="row justify-content-md-center">
        <h3>Enfants gardés</h3>
      </div>
      <div class="row justify-content-md-center">
        <?php
        while ($enfant = $listeEnfants->fetch()) {

          echo $enfant['prenom'].", ";
      }
      ?>
      </div>
</article>
</div>



    <?php

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
