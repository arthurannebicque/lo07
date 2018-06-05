
<?php ob_start(); ?>
<h1>Félicitations ! </h1>
<p>Vous êtes désormais inscrit sur Sitties</p>
<form action="index.php?action=connexion" method="post">
    <input type="submit" value="Connectez vous">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/templateNav.php'); ?>
