<?php ob_start(); ?>
      <div class="container-fluid">
      <div class="row justify-content-md-center mt-3">
          <h2>Réservation Ponctuelle</h2>
      </div>
    </div>
      <div class="container-fluid mt-3" style="min-height:300px">
        <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=requestResaPonctuelle" method="post">


              <div class="form-group row justify-content-md-center">
                <label class="col-form-label">Date</label>
                <div class="col-3">
                <input class="form-control" type="date" name="date" <?php if(isset($date)) echo "value='{$date}'";?>  required>
              </div>
                </div>

            <div class="form-group row justify-content-md-center">
              <div class="col-2">
                <input type="number" id="inputHeureDebut" name="heure_debut" class ="form-control" placeholder="Heure Debut" min="0" max="23" <?php if(isset($heure_debut)) echo "value='{$heure_debut}'";?> required autofocus>
              </div>
              <div class="col-2">
                <input type="number" id="inputHeureFin" name="heure_fin" class ="form-control" placeholder="Heure Fin" min="1" max="24" <?php if(isset($heure_fin)) echo "value='{$heure_fin}'";?> required autofocus>
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
            <div class="container-fluid bg-light border-top mt-5">
              <div class="row justify-content-md-center">
            <h2>Babysitters disponibles :</h2>
          </div>
            <div class="row justify-content-md-center">
            <h3>le <?= $date ?> de <?= $heure_debut ?>h à <?= $heure_fin ?>h.</h3>
          </div>
          </div>
          <div class="container justify-content-md-center">
                <?php
                foreach ($babysitters as $babysitter) {
                  if ($babysitter['distance'] <= 400) {
                    ?>
                    <div class="bg-light border mt-3">
                      <article style="padding:20px;">
                        <a href="index.php?action=createReservation&id=<?= $babysitter['id'] ?>&creneaux=<?= $req ?>&enfants=<?= $req2 ?>&type=1">
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
                          <li class="list-inline-item"><?= $babysitter['age']?> ans,</li>
                          <li class="list-inline-item"><?= $babysitter['experience']?> d'expérience</li>
                        </ul>
                      </div>
                      <div class="row">
                        <p>Bonjour, Je suis actuellement en Terminale Littéraire spécialité musique, je suis disponible tout les weekends, pendant les vacances scolaires et les mercredis après-midi. N'hésitez...</p>
                      </div>
                      </div>
                      <div class="col-3">
                        <div class="row">
                          <div class="col">

                        <?
                        for ($i=1; $i < round($babysitter['average'][0], 1); $i++) {
                          echo "<img src='feeding-bottle.png' height='20px' width='20px'>";
                        }
                        ?>
                      </div>
                      <div class="col">
                        <?=count($babysitter['ratings'])."avis"?>
                      </div>
                    </div>

                    <?php foreach ($babysitter['ratings'] as $rating) {
                      echo "<div class='row'>";

                        echo $rating['note']. "/5 " . $rating['evaluation'] . "<br>";
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
