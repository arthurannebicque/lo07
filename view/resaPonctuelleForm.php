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
      <div class="container-fluid">
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
          <h2>Réservation Ponctuelle</h2>
      </div>
      <div class="container-fluid mt-3">
        <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=requestResaPonctuelle" method="post">


              <div class="form-group row justify-content-md-center">
                <label class="col-form-label">Date</label>
                <div class="col-3">
                <input class="form-control" type="date" name="date" required>
              </div>
                </div>

            <div class="form-group row justify-content-md-center">
              <label class="col-form-label" for="inputHeureDebut">Heure Debut</label>
              <div class="col-3">
                <input type="number" id="inputHeureDebut" name="heure_debut" class ="form-control" placeholder="Heure Debut" min="0" max="23" required autofocus>
              </div>
              <label class="col-form-label" for="inputHeureFin">Heure Fin</label>
              <div class="col-3">
                <input type="number" id="inputHeureFin" name="heure_fin" class ="form-control" placeholder="Heure Fin" min="1" max="24" required autofocus>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
                <label class="col-form-label">Enfants à garder :</label>
                <div class="col-3">
                <select class="custom-select" name="enfants[]" size=2 multiple>
                    <?php
                    while ($enfant = $listeEnfants->fetch()) {
                        echo "<option value=" . $enfant['id'] . ">" . $enfant['prenom'] . "</option>";
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
              <div class="col-5">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
          </div>
          </div>
        </form>
      </div>
        <?php
        if (!empty($listBabysitters)) {

            $req = htmlspecialchars(serialize($req), ENT_QUOTES);
            $req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
            ?>
            <h2>Babysitters disponibles :</h2>
            <h3>le <?= $date ?> de <?= $heure_debut ?>h à <?= $heure_fin ?>h.</h3>

            <table>
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Distance</th>
                    <th>Moyenne</th>
                    <th></th>

                </tr>
                <?php
                foreach ($babysitters as $babysitter) {
                  if ($babysitter['distance'] <= 400) {
                    ?>
                    <tr>
                        <td><?= $babysitter['id'] ?></td>
                        <td><?= $babysitter['nom'] ?></td>
                        <td><?= $babysitter['prenom'] ?></td>
                        <td><?= round($babysitter['distance']) ?>km</td>
                        <td><?= round($babysitter['average'][0], 1) ?>/5</td>
                        <td><a type="button" class="btn btn-primary" href="index.php?action=createReservation&id=<?= $babysitter['id'] ?>&creneaux=<?= $req ?>&enfants=<?= $req2 ?>&type=1">Choisir</a></td>

                    </tr>
                    <?php foreach ($babysitter['ratings'] as $rating) {
                      echo "<tr>";
                      echo "<td>";
                        echo $rating['note']. "/5 " . $rating['evaluation'] . "<br>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                  <?php }
                 } ?>
            </table>
        <?php } ?>

        <a type="button" class="btn btn-primary" href="index.php">Retour</a>
      </div>
    </body>
