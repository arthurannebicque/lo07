<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="public/bootstrap/css/sb-admin-2.css" rel="stylesheet">
        <script src="jquery/jquery.min.js"></script>
        <script>
        $( document ).ready(function() {
          $( "input#dispo").closest('form').hide();
          $( "#dispo-div" ).on('click', function(event) {
            //console.log('ici')
            var id = $(event.target).closest('a').attr('id');
            console.log("You clicked on:", id);
            $( "#form-dispo" +id ).slideToggle( "slow" );

          });
        })

        </script>



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
        <div id="dispo-div">
            <?php

            foreach ($babysitters as $babysitter) {
                if ($babysitter['distance'] <= 3000 && !empty($babysitter[7])) {
                  echo "<div class='container bg-light border-top mt-5' value='{$babysitter['id']}'>";
                  ?>
                  <div class="bg-light  mt-3">
                    <article style="padding:20px;">
                      <a id="<?=$babysitter['id']?>" value='{$babysitter['id']}'>
                        <div class="row">
                      <aside class="col-2">
                        <div class="row justify-content-md-center">

                        <img src="ressources/pictures/<?=$babysitter['photo']?>" height="120px" width="120px">
                      </div>
                        <div class="row justify-content-md-center">
                        <?= round($babysitter['distance']) ?>km
                      </div>
                        <div class="row justify-content-md-center">
                        <?= $babysitter['ville'] ?>
                      </div>
                      </aside>
                      <div class="col-7">
                      <div class="row">
                      <h3><?= $babysitter['prenom']." ".$babysitter['nom'] ?></h3>
                    </div>
                    <div class="row border-top">
                      <ul class="list-inline list-unstyled">
                        <li class="list-inline-item"><?=$babysitter['age']?> ans,</li>
                        <li class="list-inline-item">1 an d'expérience</li>
                      </ul>
                    </div>
                    <div class="row">
                      <p><?=$babysitter['presentation']?></p>
                    </div>
                    </div>
                    <div class="col-3 border">
                      <div class="row">
                        <div class="col">
                      <?= round($babysitter['average'][0], 1)?>/5
                    </div>
                    <div class="col">
                      <?=count($babysitter['ratings'])."avis"?>
                    </div>
                  </div>

                  <?php foreach ($babysitter['ratings'] as $rating) {
                    echo "<div class='row'>";
                    echo "<div class='col-1'>";
                    echo $rating['note']. "/5 ";
                    echo "</div>";
                    echo "<div class='col'>";
                    echo  "Tres bien tres bien tres bien tres bien tres bien tres bienf"; //60 caracteres max
                      echo "</div>";
                      echo "</div>";
                  }

                  ?>
                </div>
              </div>
                </a>
                </article>
                </div>
                <?php
                    echo "<form class='form-signin' id='form-dispo{$babysitter['id']}' action='index.php?action=createResaLangue' method='post'>";
                    echo "<table class='table table-hover'>";
                    echo "<tbody>";
                    foreach ($babysitter[7] as $dispo) {

                      echo "<tr>";
                      echo "<td>".$dispo['date']."</td>";
                      echo "<td>".$dispo['heure']."</td>";
                      echo "<td><input type='checkbox' name='dispo[]' value=" . $dispo['id_dispo'] . "></td>";
                      echo "<tr>";

                        //echo $dispo['date'] . " " . $dispo['heure'] . " <input type='checkbox' name='dispo[]' value=" . $dispo['id_dispo'] . "><br>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    echo "<input id='dispo' type='hidden' name='id_babysitter' value=" . $babysitter['id'] . ">";

                    foreach ($selectedEnfants as $selectedEnfant) {
                        echo "<input type='hidden' name='enfants[]' value=" . $selectedEnfant . ">";
                    }
                    echo "<div class='form-group row justify-content-md-center'>";
                      echo "<div class='col-2'>";
                    echo "<button class='btn btn-lg btn-primary' type='submit'>Choisir</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "</div>";

                }
            }
            echo "</div>>";
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
