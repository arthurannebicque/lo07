<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="jquery/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUj1D_k5Ie0F5lt1Cr2ix4zEdqnia6I04&libraries=places"></script>

    <script>
      $(function() {
      // run on change for the selectbox
      $( "#nombre_enfants" ).change(function() {
        updateInputNumber();

      });

      // handle the updating of the duration divs
      function updateInputNumber() {
       // hide all form-duration-divs
       //$('.form-input-children').hide();
       $("#newinput").empty();
       var divKey = $( "#nombre_enfants option:selected" ).val();
       //$('#enfant'+divKey).show();

      var i;
      for ( i=0 ; i < divKey ; i++) {
       var txt = "<h3>Enfant n°"+ (i+1) +"</h3><label>Prenom</label><input type='text' name='enfants["
       + i +"][name]' class ='form-control' placeholder='Prenom' required><div class='form-label-group'>Date de naissance<input type='date' name='enfants["
       + i +"][date]'></div><div class='form-label-group' required><label for='inputRestriction'>Restrictions alimentaires</label><textarea id='inputRestriction' name='enfants["
       + i +"][restrictions]' class='form-control' placeholder='Restrictions' required></textarea></div>";
       $("#newinput").append(txt);
      }
    }
      // run at load, for the currently selected div to show up
      updateInputNumber();

      });
    </script>

  </head>

  <body>
    <form class="form-signin" action="index.php?action=addParent" method="post">
        <input type="hidden" name="type" value=2 />
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">Inscrivez vous en tant que Parent</h1>
        </div>
        <div class="form-label-group">
            <input type="text" id="inputNom" name="nom" class ="form-control" placeholder="Nom" required autofocus>
            <label for="inputNom">Nom</label>
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
            <textarea id="inputPresentation" name="presentation" class="form-control" placeholder="Presentation" required></textarea>
            <label for="inputPresentation">Présentation</label>
        </div>
        <div class="form-label-group">
            <label for="nombre_enfants">Nombre d'enfants</label>
            <select id="nombre_enfants" name="nombre_enfants" class ="form-control" required autofocus>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
        </div>
        <div id=newinput>
        </div>
        <!-- <div id='enfant1' class='form-input-children' style='display:none'>
          <?php inputEnfants(1);?>
        </div>
        <div id='enfant2' class='form-input-children' style='display:none'>
          <?php inputEnfants(2);?>
        </div>
        <div id='enfant3' class='form-input-children' style='display:none'>
          <?php inputEnfants(3);?>
        </div>
        <div id='enfant4' class='form-input-children' style='display:none'>
          <?php inputEnfants(4);?>
        </div>
        <div id='enfant5' class='form-input-children' style='display:none'>
          <?php inputEnfants(5);?>
        </div>
        <div id='enfant6' class='form-input-children' style='display:none'>
          <?php inputEnfants(6);?>
        </div> -->

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
