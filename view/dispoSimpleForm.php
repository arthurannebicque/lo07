<?php ob_start(); ?>
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
        <input type="number" id="inputHeureDebut" name="heure_debut" class ="form-control" placeholder="Debut" min="0" max="23" required autofocus>
      </div>
      <label class='col-form-label'>h</label>
      <div class="col-2">
        <input type="number" id="inputHeureFin" name="heure_fin" class ="form-control" placeholder="Fin" min="1" max="24" required autofocus>
      </div>
      <label class='col-form-label'>h</label>
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
<?php
$content = ob_get_clean();
require('view/templateProfil.php'); ?>
