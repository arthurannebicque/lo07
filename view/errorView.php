<?php ob_start(); ?>
<div class="container-fluid p-5" style="min-height:650px">
    <div class="row justify-content-md-center mt-5">
    <h1>Oups…</h1>
  </div>
  <div class="row justify-content-md-center">
  <h1><small>Vous avez rencontré une erreur : <?= $errorMessage?></small></h1>
</div>
  <div class="row justify-content-md-center m-5">
  <img src="public/images/robotic.png" width="25%">
</div>
<div class="row justify-content-md-center">
  <button type="button" class="btn btn-outline-primary" value="Retour" onclick="history.go(-1)">Retour</button>
</div>
  </div>




<?php $content = ob_get_clean(); ?>

<?php require('view/templateNav.php'); ?>
