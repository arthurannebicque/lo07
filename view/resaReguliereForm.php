<?php ob_start(); ?>
      <div class="container-fluid">
      <div class="row justify-content-md-center mt-3">
          <h2>Réservation Réguliere</h2>
      </div>
    </div>
      <div class="container-fluid mt-3">
        <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=requestResaReguliere" method="post">
            <div class="form-group row justify-content-md-center">
              <label class="col-form-label" for="inputDateDebut">Date Debut</label>
              <div class="col-3">
                <input type="date" id="inputDateDebut" name="date_debut" class ="form-control" <?php if(isset($date_debut)) echo "value='{$date_debut}'";?>  placeholder="Date Debut" required>
              </div>

              <label class="col-form-label" for="inputDateFin">Date Fin</label>
              <div class="col-3">
                <input type="date" id="inputDateFin" name="date_fin" class ="form-control" <?php if(isset($date_fin)) echo "value='{$date_fin}'";?> placeholder="Date Fin" required>
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
                        echo "<td><input name='weekday[{$i}][{$type}]' value='time_type_{$type}' type='checkbox' class='customCheck'></td>\n";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                ?>
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

            $req = htmlspecialchars(serialize($creneau), ENT_QUOTES);
            $req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
            ?>
            <div class="container-fluid bg-light border-top mt-5">
              <div class="row justify-content-md-center">
            <h2>Babysitters disponibles :</h2>
          </div>
          <div class="row justify-content-md-center">
            <h3>du <?= $dateDebut->format('d/m/Y') ?> au <?= $dateFin->format('d/m/Y') ?></h3>
          </div>
          <div class="row justify-content-md-center">
            sur le(s) créneaux :
          </div>
          <div class="row justify-content-md-center">

            <?php
            $listeJourEntier = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            foreach ($weekday as $day => $time_type) {
              echo "<div class='col'>";
              echo "<div class='row justify-content-md-center'>";

              echo $listeJourEntier[$day-1];
              echo "</div>";

              foreach ($time_type as $key => $time) {
                echo "<div class='row justify-content-md-center'>";
                echo $listeType[$key];
                echo "</div>";
              }
              echo "</div>";
            }

            ?>
            </div>
          </div>
          <div class="container justify-content-md-center">

            <?php
            foreach ($babysitters as $babysitter) {
              if ($babysitter['distance'] <= 3000) {
                ?>
                <div class="bg-light border mt-3">
                  <article style="padding:20px;">
                    <a href="index.php?action=createReservation&id=<?= $babysitter['id'] ?>&creneaux=<?= $req ?>&enfants=<?= $req2 ?>&type=1">
                      <div class="row">
                    <aside class="col-2">
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
                    <p>Bonjour, Je suis actuellement en Terminale Littéraire spécialité musique, je suis disponible tout les weekends, pendant les vacances scolaires et les mercredis après-midi. N'hésitez...je suis disponible tout les weekends,je suis disponible tout les weekends</p>
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
              <?php }
             } ?>
             </div>
    <?php } ?>
    <div class="container mt-5 mb-3">
      <div class="row justify-content-md-center">
        <div class="col-3">
    <a type="button" class="btn btn-outline-secondary btn-block" href="index.php">Retour</a>
    </div>
    </div>
    </div>
    <?php
      $content = ob_get_clean();
      require('view/templateProfil.php'); ?>
