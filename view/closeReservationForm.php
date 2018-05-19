<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    </head>

    <body>
        <form class="form-signin" action="index.php?action=closeReservation" method="post">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal"></h1>
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
                <input type="number" id="inputNote" name="note" class ="form-control" placeholder="Heure Debut" min="0" max="5" required autofocus>
                <label for="inputNote">Note</label>
            </div>
            <div class="form-label-group">
                <label for="inputEvaluation">Évaluation</label>
                <textarea id="inputEvaluation" name="evaluation" class="form-control" placeholder="Évaluation" required></textarea>
            </div>
            <input type="hidden" name="id_reservation" value=<?= $_GET['id'] ?>>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
        </form>
    </body>
