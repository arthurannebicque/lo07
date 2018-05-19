<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>
        <form class="form-signin" action="index.php?action=requestResaPonctuelle" method="post">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Réservation Ponctuelle</h1>
            </div>
            <div class="form-label-group">
                Date
                <input type="date" name="date" required>
            </div>
            <div class="form-label-group">
                <input type="number" id="inputHeureDebut" name="heure_debut" class ="form-control" placeholder="Heure Debut" min="0" max="23" required autofocus>
                <label for="inputHeureDebut">Heure Debut</label>
            </div>
            <div class="form-label-group">
                <input type="number" id="inputHeureFin" name="heure_fin" class ="form-control" placeholder="Heure Fin" min="1" max="24" required autofocus>
                <label for="inputHeureFin">Heure Fin</label>
            </div>
            <div class="form-label-group">
                <label>Enfants à garder :</label>
                <select name="enfants[]" multiple>
                    <?php
                    while ($enfant = $listeEnfants->fetch()) {
                        echo "<option value=" . $enfant['id'] . ">" . $enfant['prenom'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
        </form>
        <?php
        if (!empty($listBabysitters)) {

            $req = htmlspecialchars(serialize($req), ENT_QUOTES);
            $req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
            ?>
            <h2>Babysitters disponibles :</h2>
            <h3>le <?= $date ?> de <?= $heure_debut ?>h à <?= $heure_fin ?>h.</h3>

            <table>
                <tr>
                    <th>id</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th></th>

                </tr>
                <?php
                while ($babysitter = $listBabysitters->fetch()) {
                    ?>
                    <tr>
                        <td><?= $babysitter['id'] ?></td>
                        <td><?= $babysitter['nom'] ?></td>
                        <td><?= $babysitter['prenom'] ?></td>
                        <td><a type="button" class="btn btn-primary" href="index.php?action=createReservation&id=<?= $babysitter['id'] ?>&creneaux=<?= $req ?>&enfants=<?= $req2 ?>&type=1">Choisir</a></td>


                    </tr>
                <?php } ?>
            </table>
        <?php } ?>

        <a type="button" class="btn btn-primary" href="index.php">Retour</a>

    </body>
