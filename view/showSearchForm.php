<?php ob_start(); ?>
<div class="container-fluid ">
  <div class="row justify-content-md-center mt-3">
    <h2>Rechercher un Babysitter</h2>
  </div>
</div>
<div class="container-fluid mt-3">
  <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=searchBabysitter" method="post">
    <div class="form-group row justify-content-md-center">
      <div class="col-3">
        <input class="form-control" type="text" name="name" placeholder="Nom de famille" required>
      </div>
      <div class="col-2">
        <button class="btn btn-primary form-control" type="submit">Rechercher</button>
      </div>
    </div>
  </form>
</div>
<?php if (isset($babysittersSearch)) { ?>
  <div class="container">
    <table class="table table-hover btn-table mt-3">
      <thead class="thead-light">
        <tr>
          <th>Prénom</th>
          <th>Nom</th>
          <th style="width: 20%"></th>
        </tr>
      </thead>
      <?php
      while ($babysitter = $babysittersSearch->fetch()) { ?>
        <tr>
          <td><?= $babysitter['prenom'] ?></td>
          <td><?= $babysitter['nom'] ?></td>
          <td><a type="button" class="btn btn-primary btn-sm my-0" href="index.php?action=showBabysitterDetails&id=<?= $babysitter['id'] ?>">Voir prestations</a>
            <?php if($babysitter['visible']) echo"<a type='button' class='btn btn-outline-danger btn-sm my-0' href='index.php?action=blockBabysitter&id=". $babysitter['id']."&nom=". $babysitter['nom']."'>Bloquer</a></td>";
            if(!$babysitter['visible']) echo"<a type='button' class='btn btn-outline-success btn-sm my-0' href='index.php?action=unblockBabysitter&id=". $babysitter['id']."&nom=". $babysitter['nom']."'>Débloquer</a></td>"; ?>
          </tr>
        <?php } ?>
      </table>
    </div>
  <?php }
  if (isset($reservations)) { ?>
    <div class="container justify-content-md-center mb-3">
      <div class="bg-light mt-4">
        <div class="card pt-3 px-3 pb-0">
          <div class="row">
            <aside class="col-2 ">
              <div class="row justify-content-md-center">
                <img src="ressources/pictures/<?=$babysitterInfos['photo']?>" height="120px" width="120px">
              </div>
              <div class="row justify-content-md-center">
                <?= $babysitterInfos['ville'] ?>
              </div>
            </aside>
            <div class="col-8 ">
              <div class="row p-1">
                <h3><?= $babysitterInfos['prenom']." ".$babysitterInfos['nom'] ?></h3>
              </div>
              <div class="row border-top p-1">
                <ul class="list-inline list-unstyled">
                  <li class="list-inline-item"><?=$babysitterInfos['age']?> ans,</li>
                  <li class="list-inline-item"><?=$babysitterInfos['experience']?> d'expérience</li>
                </ul>
              </div>
              <div class="row p-1">
                <p><?=$babysitterInfos['presentation']?></p>
              </div>
            </div>
            <div class="col-2">
              <div class="row ">
                <h4>Langues parlées</h4>
              </div>
              <div class="row p-1">
                <ul class="list-unstyled">
                  <?
                  foreach ($babysitterInfos['langues'] as $langue) {
                    echo "<li>{$langue['langue']}</li>";
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container justify-content-md-center mb-3">
      <div class="card pt-3 px-3 pb-0">
        <div class="row justify-content-md-center mt-3">
          <?php if(!empty($reservations)) {echo"<h2>Résumé des prestations</h2>";}
          elseif(empty($reservations)) echo"<h2>Pas encore de prestations</h2>";?>
        </div>
        <?php
        foreach ($reservations as $reservation) {
          echo "<div class='container-fluid mt-3'>";
          echo "<div class='row justify-content-md-center'>";
          echo "<h5>Date :";
          $slot = $reservation['slots']->fetchall();
          if (($reservation['type'] == 1)||($reservation['type'] == 2)) {
            echo " <small>".$slot[0]['date']."</small></h2>";
          } elseif ($reservation['type'] == 3) {
            echo " <small>Du ".$reservation['dateDebut'][0]." au ".$reservation['dateFin'][0]."</small></h5>";
          }
          echo "</div>";
          echo "<div class='row justify-content-md-center mt-2'>";
          if (($reservation['type'] == 1)||($reservation['type'] == 2)) {
            echo "<h5>Créneau :";
          } elseif ($reservation['type'] == 3) {
            echo "<h5>Créneaux :</h5>";
          }
          if (($reservation['type'] == 1)||($reservation['type'] == 2)) {
            $key = count($slot) - 1;
            echo " <small>De ".$slot[0]['heure']. "h à " . ($slot[$key]['heure'] + 1) . "h.</small></h5>";
          } elseif ($reservation['type'] == 3) {
            $listeJour = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
            foreach ($reservation['creneauResa'] as $weekday => $heures) {
              echo "<div class='col-2'>";
              echo "<div class='row justify-content-md-center'>";
              echo "<h5><small>".$listeJour[$weekday]."</small></h5>";
              echo "</div>";
              echo "<div class='row justify-content-md-center'>";
              echo "<h5><small>De ".$heures[0]['heure']."h à ".($heures[count($heures)-1]['heure']+1)."h</small></h5>";
              echo "</div>";
              echo "</div>";
            }
          }
          echo "</div>";
          echo "<div class='row justify-content-md-center mt-2'>";
          echo "<div class='col-2'>";
          echo "<div class='row'>";
          echo "<h3><small>Famille</small></h3>";
          echo "</div>";
          echo "<div class='row'>";
          echo "<h5><small>".$reservation['nom']."</small></h5>";
          echo "</div>";
          echo "<div class='row'>";
          echo "<h5><small>".$reservation['ville']."</small></h5>";
          echo "</div>";
          echo "</div>";
          echo "<div class='col-2'>";
          echo "<div class='row'>";
          echo "<h3><small>Enfants gardés</small></h3>";
          echo "</div>";
          while ($enfant = $reservation['listeEnfants']->fetch()) {
            echo "<div class='row'>";
            echo "<h5><small>".$enfant['prenom']."</small></h5>";
            echo "</div>";
          }
          echo "</div>";
          if ($reservation['note'] != '-1') {
            echo "<div class='col-3'>";
            echo "<div class='row'>";
            echo "<h3><small>Évaluation</small></h3>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<h5><small>".$reservation['note']."/5</small></h5>";
            echo "</div>";
            echo "<div class='row'>";
            echo "<h5><small>".$reservation['evaluation']."</small></h5>";
            echo "</div>";
            echo "</div>";
          }
          echo "</div>";
          echo "</div>";
          echo "<div class='row justify-content-md-center mt-3'>";
          echo "<div class='col-9 border'>";
          echo "</div>";
          echo "</div>";
        }    
      }?>
    </div>
  </div>
  <?php
  $content = ob_get_clean();
  require('view/templateProfil.php'); ?>
