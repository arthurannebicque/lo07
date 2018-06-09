<?php ob_start(); ?>


<div class="container-fluid">
  <div class="row justify-content-md-center mt-3">
    <h2>Récapitulatif de la réservation</h2>
  </div>
</div>


<?php if ($_SESSION['type'] == 2) {

  ?>
  <div class="container mt-3">
    <div class="row">
      <div class="col-3">
        <div class="card text-center">
          <img class="card-img-top" src="ressources/pictures/<?=$babysitter['photo']?>" alt="Card image cap" style="max-height: 250px;">
          <div class="card-body">
            <h5 class="card-title"><?=$babysitter['prenom']." ".$babysitter['nom']?></h5>
            <p class="card-text "><?=$babysitter['portable']?></p>
          </div>
        </div>
      </div>
      <div class="card col-9 bg-light">
        <div class="p-4">
          <div class="row ">
            <h2>Date :

              <?php
              $slot = $slots->fetchall();
              if (($type[0] == 2)||($type[0] == 1)) {

                echo " <small>".$slot[0]['date']."</small></h2>";
              } elseif ($type[0] == 3) {
                echo " <small>Du ".$dateDebut[0]." au ".$dateFin['date_fin']."</small></h2>";

              }
              ?>
            </div>
            <div class="row mt-2">
              <?php if (($type[0] == 2)||($type[0] == 1)) {
                echo "<h2>Créneau :";
              } elseif ($type[0] == 3) {
                echo "<h2>Créneaux :</h2>";

              }
              ?>


              <?php if (($type[0] == 1)||($type[0] == 2)) {
                $key = count($slot) - 1;
                echo " <small>De ".$slot[0]['heure']. "h à " . ($slot[$key]['heure'] + 1) . "h.</small></h2>";

              } elseif ($type[0] == 3) {

                $listeJour = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                foreach ($creneauResa as $weekday => $heures) {
                  echo "<div class='col-2'>";
                  echo "<div class='row justify-content-md-center'>";
                  echo "<h3><small>".$listeJour[$weekday]."</small></h3>";
                  echo "</div>";
                  echo "<div class='row justify-content-md-center'>";
                  echo "<h3><small>De ".$heures[0]['heure']."h à ".($heures[count($heures)-1]['heure']+1)."h</small></h3>";
                  echo "</div>";
                  echo "</div>";

                }


              }
              echo "</div>";
              ?>
              <div class="row mt-2">
                <h2>Enfants gardés :</h2>
              </div>

              <?php
              while ($enfant = $listeEnfants->fetch()) {
                echo "<div class='row mt-1'>";

                echo "<h3><small>".$enfant['prenom']."</small></h3>";
                echo "</div>";
              }
              ?>

            </div>
          </div>
        </div>
      </div>
      <div class="container mt-3 mb-3">
        <div class="row justify-content-md-center">
          <?php
          if ($dateFin['difference'] <= 0) {
            if ($type['note'] == "-1") {
              echo "<div class='col-3'>";
              echo "<button type='button' class='btn btn-primary btn-block' data-toggle='modal' data-target='#closeReservationModalCenter'>Terminer</button>";
              echo "</div>";
              echo "<div class='col-3'>";
              echo "<a type='button' class='btn btn-outline-secondary btn-block' href='index.php'>Retour</a>";
              echo "</div>";
            } else {
              echo '<div class="col-3">';
              echo '<a type="button" class="btn btn-outline-secondary btn-block" href="index.php">Retour</a>';
              echo '</div>';
            }
          } else {

            echo '<div class="col-3">';
            echo '<a type="button" class="btn btn-outline-secondary btn-block" href="index.php">Retour</a>';
            echo '</div>';

          }

          ?>
        </div>
      </div>
      <div class="modal fade" id="closeReservationModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Évaluez votre Babysitter</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form m-auto justify-content-md-center" action="index.php?action=closeReservation" method="post">

                <?php if ($type[0] == 3 ) {
                
                  echo "<div class='form-group row justify-content-md-center'>";
                  echo "<div class='col-4'>";
                  echo "<label>Nombre d'heures (rappel : ".count($slot)."h)</label>";
                  echo "<input type='hidden' name='heure_debut' value='1'>";
                  echo "</div>";
                  echo "<div class='col-3'>";
                  echo "<input type='number' id='inputHeureFin' name='heure_fin' class ='form-control' placeholder='Heures' value='".count($slot)."' required autofocus>";
                  echo "</div>";
                  echo "</div>";
                }
                elseif (($type[0] == 1)||($type[0] == 2)) {
                  echo "<div class='row justify-content-md-center'>";
                  echo "<label for='inputEvaluation'>Créneau</label>";
                  echo "</div>";
                  echo "<div class='form-group row justify-content-md-center'>";
                  echo "<div class='col-3'>";
                  echo "<input type='number' id='inputHeureDebut' name='heure_debut' class ='form-control' placeholder='Heure Debut' min='0' max='23' value='".$slot[0]['heure']."' required autofocus>";
                  echo "</div>";
                  echo "<label class='col-form-label'>h</label>";
                  echo "<div class='col-3'>";

                  echo "<input type='number' id='inputHeureFin' name='heure_fin' class ='form-control' placeholder='Heure Fin' min='1' max='24' value='".($slot[$key]['heure'] + 1)."' required autofocus>";

                  echo "</div>";
                  echo "<label class='col-form-label'>h</label>";
                  echo "</div>";
                }?>

                <div class="form-group row justify-content-md-center">
                  <label class="col-form-label" for="inputNote">Note</label>
                  <div class="col-3">
                    <input type="number" id="inputNote" name="note" class ="form-control" placeholder="sur 5" min="0" max="5" required autofocus>
                  </div>
                </div>
                <div class="row justify-content-md-center">
                  <label for="inputEvaluation">Évaluation</label>
                </div>
                <div class="form-group row justify-content-md-center">
                  <div class="col-10">
                    <textarea id="inputEvaluation" name="evaluation" class="form-control" placeholder="Laissez un commentaire (60 caractères max)" maxlength="60" required></textarea>
                  </div>
                </div>

                <input type="hidden" name="id_reservation" value=<?= $id_reservation ?>>
                <input type="hidden" name="type" value=<?= $type[0] ?>>

                <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php
    }

    if ($_SESSION['type'] == 1) {
      ?>
      <div class="container mt-3">
        <div class="row">
          <div class="col-3">
            <div class="card text-center">
              <img class="card-img-top" src="public/images/home.png" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title"><?= $famille['nom']; ?></h5>
                <p class="card-text "><?=$famille['ville']?></p>
              </div>
            </div>
          </div>
          <div class="card col-9 bg-light">
            <div class="p-4">
              <div class="row ">
                <h2>Date :

                  <?php
                  $slot = $slots->fetchall();
                  if (($type[0] == 1)||($type[0] == 2)) {

                    echo " <small>".$slot[0]['date']."</small></h2>";
                  } elseif ($type[0] == 3) {
                    echo " <small>Du ".$dateDebut[0]." au ".$dateFin['date_fin']."</small></h2>";

                  }
                  ?>
                </div>
                <div class="row mt-2">
                  <?php if (($type[0] == 1)||($type[0] == 2)) {
                    echo "<h2>Créneau :";
                  } elseif ($type[0] == 3) {
                    echo "<h2>Créneaux :</h2>";

                  }
                  ?>


                  <?php if (($type[0] == 1)||($type[0] == 2)) {
                    $key = count($slot) - 1;
                    echo " <small>De ".$slot[0]['heure']. "h à " . ($slot[$key]['heure'] + 1) . "h.</small></h2>";

                  } elseif ($type[0] == 3) {

                    $listeJour = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
                    foreach ($creneauResa as $weekday => $heures) {
                      echo "<div class='col-2'>";
                      echo "<div class='row justify-content-md-center'>";
                      echo "<h3><small>".$listeJour[$weekday]."</small></h3>";
                      echo "</div>";
                      echo "<div class='row justify-content-md-center'>";
                      echo "<h3><small>De ".$heures[0]['heure']."h à ".($heures[count($heures)-1]['heure']+1)."h</small></h3>";
                      echo "</div>";
                      echo "</div>";

                    }


                  }
                  echo "</div>";
                  ?>
                  <div class="row mt-2">
                    <h2>Enfants gardés :</h2>
                  </div>

                  <?php
                  while ($enfant = $listeEnfants->fetch()) {
                    echo "<div class='row mt-1'>";

                    echo "<h3><small>".$enfant['prenom']."</small></h3>";
                    echo "</div>";
                  }
                  ?>

                </div>
              </div>
            </div>
          </div>


          <div class="container mt-3 mb-3">
            <div class="row justify-content-md-center">
              <div class="col-3">
                <a type="button" class="btn btn-outline-secondary btn-block" href="index.php">Retour</a>
              </div>
            </div>
          </div>
          <?php
        }

        $content = ob_get_clean();
        require('view/templateProfil.php'); ?>
