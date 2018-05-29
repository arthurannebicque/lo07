<?php ob_start(); ?>

<div class="container-fluid">
<div class="row justify-content-md-center mt-3">
<h2>Classement des babysitters par revenu :</h2>
</div>
</div>
<div class="container">
<table class="table table-hover btn-table mt-3">
<thead class="thead-light">
<tr>
    <th>Prénom</th>
    <th>Nom</th>
    <th style="width: 20%">Revenu</th>
</tr>
</thead>
<?php
while ($revenuBabysitter = $listeRevenuBabysitter->fetch()) {

    ?>
    <tr>
        <td><?= $revenuBabysitter['prenom'] ?></td>
        <td><?= $revenuBabysitter['nom'] ?></td>
        <td><?= $revenuBabysitter['revenu'] ?>€</td>
    </tr>
<?php } ?>
</table>
</div>
<?php
  $content = ob_get_clean();
  require('view/templateProfil.php'); ?>
