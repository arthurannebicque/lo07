<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="public/jquery/jquery.min.js"></script>
         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>
        <link href="public/bootstrap/css/bootstrap.css" rel="stylesheet">
        <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->
        <link href="public/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
        <link href="public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script>
            $(function () {
                // run on change for the selectbox
                $("#nombre_enfants").change(function () {
                    updateInputNumber();

                });

                // handle the updating of the duration divs
                function updateInputNumber() {
                    // hide all form-duration-divs
                    //$('.form-input-children').hide();
                    $("#newinput").empty();
                    var divKey = $("#nombre_enfants option:selected").val();
                    //$('#enfant'+divKey).show();

                    var i;
                    for (i = 0; i < divKey; i++) {
                        var txt = "<div class='col-3 m-1 p-2 card '><h5><small>Enfant " + (i + 1)
                        + "</small></h5><div class='form-group row justify-content-md-center'><div class='col'><input type='text' name='enfants["
                                + i + "][name]' class ='form-control form-control-sm' placeholder='Prénom' required></div></div><div class='form-group row justify-content-md-center'><label class='col-form-label'>Naissance:</label><input class='form-control form-control-sm w-50' type='date' name='enfants["
                                + i + "][date]'></div><div class='form-label-group' required><textarea id='inputRestriction' name='enfants["
                                + i + "][restrictions]' class='form-control form-control-sm' placeholder='Restrictions alimentaires' required></textarea></div></div>";
                        $("#newinput").append(txt);
                    }
                }
                // run at load, for the currently selected div to show up
                updateInputNumber();

            });
        </script>

    </head>

    <body class="form-parent">


        <form class="form w-75 mx-auto mt-4 justify-content-md-center" action="index.php?action=addParent" method="post">
            <input type="hidden" name="type" value=2 />
            <div class="text-center mb-4">
                <h1 class="text-white">Inscrivez vous en tant que Parent</h1>
            </div>
            <div class="form-group row justify-content-md-center">
                <div class="col-3">
                    <input type="text" id="inputNom" name="nom" class ="form-control" placeholder="Nom" required autofocus>

                </div>
                <div class="col-3">
                    <input type="text" id="inputVille" name="ville" class="form-control" placeholder="Ville" required>

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
            <div class="col-6">
                <textarea id="inputPresentation" name="presentation" class="form-control" placeholder="Présentation" required></textarea>

            </div>
          </div>
          <div class="form-group row justify-content-md-center">
            <div class="col-4">
              <div class="row">
                <label class="col-form-label text-white">Nombre d'enfants</label>

                <select id="nombre_enfants" name="nombre_enfants" class ="custom-select w-50" required autofocus>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>
          </div>
          </div>
          <div class="form-group row justify-content-md-center" id=newinput>

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
