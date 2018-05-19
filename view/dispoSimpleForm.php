<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>
        <form class="form-signin" action="index.php?action=addDispoSimple" method="post">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Dispo Simple</h1>
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

            <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
        </form>
    </body>
