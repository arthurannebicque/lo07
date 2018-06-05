<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <script src="jquery/jquery.min.js"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>
        <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="public/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
        <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>

    <body class="form-parent">
    <div class="container mt-5">

        <form class="form w-75 m-auto justify-content-md-center" action="index.php?action=addBabysitter" method="post"enctype="multipart/form-data">
            <input type="hidden" name="type" value=1 />
            <div class="text-center mb-4">
                <h1 class="text-white">Inscrivez vous en tant que Babysitter</h1>
            </div>
            <div class="form-group row justify-content-md-center">
            <div class="col-3">
                <input type="text" id="inputNom" name="nom" class ="form-control" placeholder="Nom" required autofocus>

            </div>
            <div class="col-3">
                <input type="text" id="inputPrenom" name="prenom" class ="form-control" placeholder="Prénom" required autofocus>

            </div>
            </div>

            <div class="form-group row justify-content-md-center">
              <div class="col-6">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
              </div>
            </div>
            <div class="form-group row justify-content-md-center">
                <div class="col-3">
                    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>

                </div>
                <div class="col-3">
                    <input type="password" id="inputPasswordConfirmation" name="passwordConfirmation" class="form-control" placeholder="Confirmation" required>

                </div>
              </div>
            <div class="form-group row justify-content-md-center">
            <div class="col-3">
                <input type="text" id="inputVille" name="ville" class="form-control" placeholder="Ville" required>

            </div>
            <div class="col-3">
                <input type="text" id="inputTelephone" name="telephone" class ="form-control" placeholder="Téléphone" required autofocus>

            </div>
            </div>
            <div class="form-group row justify-content-md-center">
            <div class="col-3">
                <input type="number" id="inputAge" name="age" class ="form-control" placeholder="Age" required autofocus>

            </div>
            <div class="col-3">
                <select id="inputExperience" name="experience" class ="custom-select" placeholder="Expérience" required autofocus>
                    <option  disabled selected>Expérience</option>
                    <option>moins d' 1 an</option>
                    <option>1 à 3 ans</option>
                    <option>plus de 3 ans</option>
                </select>
            </div>
            </div>
            <div class="form-group row justify-content-md-center">
            <div class="col-3">

                <select class="custom-select" id="inputLangues" name="langues[]" multiple size="3">
                  <option disabled selected>Langues parlées</option>
                    <?php
                    $listeLangues = array(
                        "Allemand",
                        "Anglais",
                        "Arabe",
                        "Chinois",
                        "Espagnol",
                        "Italien",
                        "Japonais",
                        "Portugais");

                    foreach ($listeLangues as $langue) {
                        echo "<option>" . $langue . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3 custom-file">
                <label class="custom-file-label" for="customFile">Photo</label>

            <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
            <input class="custom-file-input" type="file" name="profil" required/>
            </div>
        </div>

            <div class="form-group row justify-content-md-center">
              <div class="col-6">
                <textarea id="inputPresentation" name="presentation" class="form-control" placeholder="Présentation" required></textarea>
              </div>
            </div>

            <div class="form-group row justify-content-md-center">
              <div class="col-5">
              <button class="btn btn-lg btn-primary btn-block" type="submit">Inscription</button>
            </div>
          </div>
        </form>
        <div class="col-3 mx-auto">
    <a type="button" class="btn btn-outline-light btn-block" href="index.php">Retour</a>
  </div>
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
