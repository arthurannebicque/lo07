<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
    <div class="container">

            <div class="col-md-offset-4 col-md-4">
        <form class="form-signin" action="index.php?action=addBabysitter" method="post"enctype="multipart/form-data">
            <input type="hidden" name="type" value=1 />
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Inscrivez vous en tant que Babysitter</h1>
            </div>
            <div class=" form-row">
            <div class="form-label-group col-md-6 ">
                <label for="inputNom">Nom</label>
                <input type="text" id="inputNom" name="nom" class ="form-control" placeholder="Nom" required autofocus>

            </div>
            <div class="form-label-group col-md-6 ">
                <label for="inputPrenom">Prenom</label>
                <input type="text" id="inputPrenom" name="prenom" class ="form-control" placeholder="prenom" required autofocus>

            </div>
            </div>

            <div class="form-label-group col-md-12">
                <label for="inputEmail">Email</label>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>

            </div>
            <div class=" form-row">
            <div class="form-label-group col-md-6">
                <label for="inputPassword">Mot de passe</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

            </div>
            <div class="form-label-group col-md-6">
                <label for="inputPasswordConfirmation">Confirmation </label>
                <input type="password" id="inputPasswordConfirmation" name="passwordConfirmation" class="form-control" placeholder="Password Confirmation" required>

            </div>
        </div>
            <div class=" form-row">
            <div class="form-label-group col-md-6">
                <label for="inputVille">Ville</label>
                <input type="text" id="inputVille" name="ville" class="form-control" placeholder="Ville" required>

            </div>
            <div class="form-label-group col-md-6">
                <label for="inputTelephone">Téléphone</label>
                <input type="text" id="inputTelephone" name="telephone" class ="form-control" placeholder="Telephone" required autofocus>

            </div>
            </div>
            <div class=" form-row">
            <div class="form-label-group col-md-6">
                <label for="inputAge">Age</label>
                <input type="number" id="inputAge" name="age" class ="form-control" placeholder="Age" required autofocus>

            </div>
            <div class="form-label-group col-md-6">
                <label for="inputExperience">Expérience</label>
                <select id="inputExperience" name="experience" class ="form-control"required autofocus>
                    <option selected>moins d' 1 an</option>
                    <option>1 à 3 ans</option>
                    <option>plus de 3 ans</option>
                </select>
            </div>
            </div>
            <div class=" form-row">
            <div class="form-label-group col-md-6">
                <br>
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
            <div class="col-md-6">
                <br>
                <label>Une photo de vous</label>
                <br>
                <br>
                <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
            <input type="file" name="profil" required/>
            </div>
        </div>
            <br>
            <br>
            <div class="form-label-group col-md-12">
                <label for="inputPresentation">Présentation</label>
                <textarea id="inputPresentation" name="presentation" class="form-control" placeholder="Presentation" required></textarea>
<br>
            </div>

            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Inscription</button>
            <p class="mt-5 mb-3 text-muted text-center">Déjà inscrit ? Connectez vous <a href="index.php?action=connexion">ici</a></p>

        </form>
            </div>
    </div>
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
