<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>
        <form action="index.php?action=requestResaReguliere" method="post">
            <div class="form-label-group">
                <input type="date" id="inputDateDebut" name="date_debut" class ="form-control" placeholder="Date Debut" required>
                <label for="inputDateDebut">Date Debut</label>
            </div>
            <div class="form-label-group">
                <input type="date" id="inputDateFin" name="date_fin" class ="form-control" placeholder="Date Fin" required>
                <label for="inputDateFin">Date Fin</label>
            </div>
            <div>
                <?php
                $listeJour = array('LUN', 'MAR', 'MER', 'JEU', 'VEN', 'SAM', 'DIM');
                $listeType = array('Avant l\'école/crèche (6h-8h)', 'Matin (8h-12h)', 'Midi (12h-14h)', 'Après-Midi (14h-17h)', 'Après l\'école/crèche (17-20h)', 'Soirée (20h-23h)', 'Nuit (23h et +)');
                echo "<table>";
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
                        echo "<td><input name='weekday[{$i}][{$type}]' value='time_type_{$type}' type='checkbox'></td>\n";
                    }
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                ?>
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

            $req = htmlspecialchars(serialize($creneau), ENT_QUOTES);
            $req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
            ?>
            <h2>Babysitters disponibles :</h2>
            <h3>du <?= $date_debut->format('d/m/Y') ?> au <?= $date_fin->format('d/m/Y') ?></h3>
            sur le(s) créneaux :
            <?php
            foreach ($creneau as $slot) {
                $slot = new DateTime($slot);
                echo $slot->format('H:i:s');
                echo "<br>";
            }
            ?>h.</h3>

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
                    <td><a type="button" class="btn btn-primary" href="index.php?action=createReservation&id=<?= $babysitter['id'] ?>&creneaux=<?= $req ?>&enfants=<?= $req2 ?>&type=3">Choisir</a></td>


                </tr>
            <?php } ?>
        </table>
    <?php } ?>

    <a type="button" class="btn btn-primary" href="index.php">Retour</a>

</body>
