<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="jquery/jquery.min.js"></script>

        <script>

            $("#voir_dispo").click(function (e) {
                e.preventDefault();
                alert("works");
                $("#dispo_form").slideToggle("slow");

            });
        </script>
    </head>

    <body>
        <form class="form-signin" action="index.php?action=requestResaLangue" method="post">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Réservation par langue</h1>
            </div>
            <div class="form-label-group">
                <label for="inputLangues">Langue recherchée</label>
                <select id="inputLangues" name="langue" class ="form-control">
                    <?php
                    while ($langue = $listeLangues->fetch()) {
                        echo "<option value=" . $langue['id'] . ">" . $langue['langue'] . "</option>";
                    }
                    ?>
                </select>
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

//$req = htmlspecialchars(serialize($req), ENT_QUOTES);
//$req2 = htmlspecialchars(serialize($selectedEnfants), ENT_QUOTES);
            ?>
            <h2>Babysitters parlant <?= $selectedLangue['langue']; ?> dans un rayon de 30km:</h2>

            <?php
            foreach ($babysitters as $babysitter) {
                if ($babysitter['distance'] <= 30 && !empty($babysitter[4])) {

                    echo $babysitter['id'] . " " . $babysitter['prenom'] . " " . $babysitter['nom'] . " à ".$babysitter['distance']."km";
                    echo "<a type='button' class='btn btn-primary' id='voir_dispo' href=''>Voir disponibilités</a>";
                    echo "<form class='form-signin' id=dispo_form action='index.php?action=createResaLangue' method='post'>";

                    foreach ($babysitter[4] as $dispo) {
                        echo $dispo['date'] . " " . $dispo['heure'] . " <input type='checkbox' name='dispo[]' value=" . $dispo['id_dispo'] . "><br>";
                    }

                    echo "<input type='hidden' name='id_babysitter' value=" . $babysitter['id'] . ">";

                    foreach ($selectedEnfants as $selectedEnfant) {
                        echo "<input type='hidden' name='enfants[]' value=" . $selectedEnfant . ">";
                    }
                    echo "
   <button class='btn btn-lg btn-primary btn-block' type='submit'>Choisir</button>";
                    echo "</form>";
                }
            }
            echo "<br>";
        }
        ?>
        <br>
        <a type="button" class="btn btn-primary" href="index.php">Retour</a>

    </body>
</html>
