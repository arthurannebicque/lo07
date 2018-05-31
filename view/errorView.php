<?php ob_start(); ?>
<h1>Oups…</h1>
<p>Vous avez rencontré une erreur : <?= $errorMessage?></p>
<form>
    <input type="button" class="btn btn-primary" value="Retour" onclick="history.go(-1)">
</form>
<?php $content = ob_get_clean(); ?>

<?php require('view/templateNav.php'); ?>
