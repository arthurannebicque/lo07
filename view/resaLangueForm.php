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
          <h2>Réservation par langue</h2>
      </div>
    </div>
    <div class="container-fluid mt-3">
        <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=requestResaLangue" method="post">

          <div class="form-group row justify-content-md-center">
                <label class="col-form-label" for="inputLangues">Langue recherchée</label>
                <div class="col-3">
                <select id="inputLangues" name="langue" class="custom-select">
                    <?php
                    while ($langue = $listeLangues->fetch()) {
                        echo "<option value=" . $langue['id'] . ">" . $langue['langue'] . "</option>";
                    }
                    ?>
                </select>
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

//$req = htmlspecialchars(serialize($req), ENT_QUOTES);
//$req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
            ?>
            <div class="container-fluid bg-light border-top mt-5">
              <div class="row justify-content-md-center">
            <h2>Babysitters parlant <?= $selectedLangue['langue']; ?></h2>
          </div>
          <div class="row justify-content-md-center">
        <h3>Dans un rayon de 30km:</h3>
      </div>
        </div>
            <?php
            foreach ($babysitters as $babysitter) {
                if ($babysitter['distance'] <= 3000 && !empty($babysitter[4])) {

                    echo $babysitter['id'] . " " . $babysitter['prenom'] . " " . $babysitter['nom'] . " à ".$babysitter['distance']."km";
                    echo "<a type='button' class='btn btn-primary' href=''>Voir disponibilités</a>";
                    echo "<form class='form-signin' action='index.php?action=createResaLangue' method='post'>";

                    foreach ($babysitter[4] as $dispo) {
                        echo $dispo['date'] . " " . $dispo['heure'] . " <input type='checkbox' name='dispo[]' value=" . $dispo['id_dispo'] . "><br>";
                    }

                    echo "<input type='hidden' name='id_babysitter' value=" . $babysitter['id'] . ">";

                    foreach ($selectedEnfants as $selectedEnfant) {
                        echo "<input type='hidden' name='enfants[]' value=" . $selectedEnfant . ">";
                    }
                    echo "
   <button class='btn btn-lg btn-primary btn-block' type='submit'>Choisir</button>";
                    echo "</form>";

                }
            }
            echo "<br>";
        }
        ?>
        <div class="container mt-5 mb-3">
          <div class="row justify-content-md-center">
            <div class="col-3">
        <a type="button" class="btn btn-outline-secondary btn-block" href="index.php">Retour</a>
      </div>
      </div>
      </div>
    </body>
</html>
