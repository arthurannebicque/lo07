
<?php ob_start(); ?>
<div class="container-fluid p-5">
    <div class="row justify-content-md-center mt-5">
    <h1>Félicitations ! </h1>
  </div>
  <div class="row justify-content-md-center">
  <h1><small>Vous êtes désormais inscrit sur Sitties</small></h1>
</div>
  <div class="row justify-content-md-center m-5">
  <img src="public/images/check.png" width="25%">
</div>
<div class="row justify-content-md-center">
  <a type="button" class="btn btn-primary btn-lg" href="index.php?action=connexion">Connectez vous !</a>
</div>
  </div>


<?php $content = ob_get_clean(); ?>

<?php require('view/templateNav.php'); ?>
