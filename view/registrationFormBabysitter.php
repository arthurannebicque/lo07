<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>

    </head>

    <body>
        <form class="form-signin" action="index.php?action=addBabysitter" method="post">
            <input type="hidden" name="type" value=1 />
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Inscrivez vous en tant que Babysitter</h1>
            </div>
            <div class="form-label-group">
                <input type="text" id="inputNom" name="nom" class ="form-control" placeholder="Nom" required autofocus>
                <label for="inputNom">Nom</label>
            </div>
            <div class="form-label-group">
                <input type="text" id="inputPrenom" name="prenom" class ="form-control" placeholder="prenom" required autofocus>
                <label for="inputPrenom">Prenom</label>
            </div>
            <div class="form-label-group">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <label for="inputEmail">Email</label>
            </div>
            <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Mot de passe</label>
            </div>
            <div class="form-label-group">

                <input type="password" id="inputPasswordConfirmation" name="passwordConfirmation" class="form-control" placeholder="Password Confirmation" required>
                <label for="inputPasswordConfirmation">Confirmation de mot de passe</label>
            </div>
            <div class="form-label-group">

                <input type="text" id="inputVille" name="ville" class="form-control" placeholder="Ville" required>
                <label for="inputVille">Ville</label>
            </div>
            <div class="form-label-group">
                <input type="text" id="inputTelephone" name="telephone" class ="form-control" placeholder="Telephone" required autofocus>
                <label for="inputTelephone">Téléphone</label>
            </div>

            <div class="form-label-group">
                <input type="number" id="inputAge" name="age" class ="form-control" placeholder="Age" required autofocus>
                <label for="inputAge">Age</label>
            </div>
            <div class="form-label-group">
                <label for="inputExperience">Expérience</label>
                <select id="inputExperience" name="experience" class ="form-control"required autofocus>
                    <option selected> -1 an</option>
                    <option> 1 à 3 ans</option>
                    <option> +3 ans</option>
                </select>
            </div>
            <div class="form-label-group">
                <label for="inputLangues">Langues parlées (autre que français)</label>
                <select id="inputLangues" name="langues[]" multiple class ="form-control">
                    <?php
                    $listeLangues = array("Afrikaans", "Albanais",
                        "Allemand",
                        "Anglais",
                        "Arabe",
                        "Arménien",
                        "Bengali",
                        "Bulgare",
                        "Catalan",
                        "Chinois",
                        "Coréen",
                        "Croate",
                        "Danois",
                        "Espagnol",
                        "Estonien",
                        "Filipino",
                        "Finnois",
                        "Géorgien",
                        "Grec",
                        "Hébreu",
                        "Hindi",
                        "Hongrois",
                        "Indonésien",
                        "Islandais",
                        "Italien",
                        "Japonais",
                        "Khmer",
                        "Letton",
                        "Lituanien",
                        "Malgache",
                        "Mongol",
                        "Néerlandais",
                        "Norvégien",
                        "Occitan",
                        "Persan",
                        "Polonais",
                        "Portugais",
                        "Quechua",
                        "Roumain",
                        "Russe",
                        "Samoan",
                        "Serbe",
                        "Slovaque",
                        "Slovène",
                        "Suédois",
                        "Tamoul",
                        "Tchèque",
                        "Turc",
                        "Ukrainien",
                        "Vietnamien");

                    foreach ($listeLangues as $langue) {
                        echo "<option>" . $langue . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Inscription</button>
            <p class="mt-5 mb-3 text-muted text-center">Déjà inscrit ? Connectez vous <a href="index.php?action=connexion">ici</a></p>

        </form>
        <script>
            function init() {
                var input = document.getElementById('inputVille');
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {country: "fr"}
                };
                var autocomplete = new google.maps.places.Autocomplete(input, options);
            }

            google.maps.event.addDomListener(window, 'load', init);
        </script>
    </body>
