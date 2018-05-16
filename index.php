<?php
session_start();
require('controller/frontend.php');

if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['type'])) {
  if (isset($_GET['action'])) {
    if ($_GET['action'] == 'deconnexion') {
      deconnectMember();
    }
    elseif ($_GET['action'] == 'disponibilite') {
      if ($_GET['type'] == 'simple') require('view/dispoSimpleForm.php');
      if ($_GET['type'] == 'recurrente') require('view/dispoRecurrenteForm.php');
    }
    elseif ($_GET['action'] == 'addDispoSimple') {
      if (!empty($_POST['date']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin'])){
        addDispoSimple($_SESSION['id'], $_POST['date'], $_POST['heure_debut'], $_POST['heure_fin']);
      }
    }
    elseif ($_GET['action'] == 'reservation') {
      if ($_GET['type'] == 'ponctuelle') getListeEnfants(); //require('view/resaPonctuelleForm.php');
      if ($_GET['type'] == 'reguliere') require('view/resaReguliereForm.php');
      if ($_GET['type'] == 'langue') getResaLangueForm(); //require('view/resaPonctuelleForm.php');

    }
    elseif ($_GET['action'] == 'requestResaPonctuelle') {
      if (!empty($_POST['date']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin']) && !empty($_POST['enfants'])){
        requestResaPonctuelle($_SESSION['id'], $_POST['date'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['enfants']);
      }
    }
    elseif ($_GET['action'] == 'requestResaLangue') {
      if (!empty($_POST['langue']) && !empty($_POST['enfants'])){
        requestResaLangue($_SESSION['id'], $_POST['langue'], $_POST['enfants']);
      }
    }
    elseif ($_GET['action'] == 'createResaPonctuelle') {
      if (isset($_GET['id']) && isset($_GET['creneaux']) && isset($_GET['enfants'])){
        createResaPonctuelle($_SESSION['id'], $_GET['id'], $_GET['creneaux'], $_GET['enfants']);
      }
    }
    elseif ($_GET['action'] == 'createResaLangue') {
      if (!empty($_POST['id_babysitter']) && !empty($_POST['dispo']) && !empty($_POST['enfants'])){
        createResaLangue($_SESSION['id'], $_POST['id_babysitter'], $_POST['dispo'], $_POST['enfants']);
      }
    }
    elseif ($_GET['action'] == 'showReservation') {
      if (isset($_GET['id'])){
        showReservation($_GET['id']);
      }
    }
    elseif ($_GET['action'] == 'closeReservationForm') {
      if (isset($_GET['id'])){
        require('view/closeReservationForm.php');
      }
    }
    elseif ($_GET['action'] == 'closeReservation') {
      if (!empty($_POST['id_reservation']) && !empty($_POST['note']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin']) && !empty($_POST['evaluation'])){
        closeReservation($_POST['id_reservation'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['note'], $_POST['evaluation']);
      }
    }
  }
  else {
    showProfil();
  }
}
else {
if (isset($_GET['action'])) {

  if ($_GET['action'] == 'addBabysitter') {
      if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation']) && !empty($_POST['email']) && !empty($_POST['type'])
      && !empty($_POST['ville']) && !empty($_POST['langues'])){
          addBabysitter($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['passwordConfirmation'], $_POST['type'], $_POST['ville'],
          $_POST['telephone'], $_POST['age'], $_POST['experience'], $_POST['langues']);
      }
      else {
          throw new Exception('tous les champs n\'ont pas été remplis');
      }
  }

  elseif ($_GET['action'] == 'addParent') {
      if (!empty($_POST['nom']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation']) && !empty($_POST['email']) && !empty($_POST['type']) && !empty($_POST['ville']) && !empty($_POST['enfants'])){
          addParent($_POST['nom'], $_POST['email'], $_POST['password'], $_POST['passwordConfirmation'], $_POST['type'], $_POST['ville'], $_POST['presentation'], $_POST['enfants']);

      }
      else {
          throw new Exception('tous les champs n\'ont pas été remplis');
      }
  }

  elseif ($_GET['action'] == 'registration') {
      if ($_GET['type'] == 'parent') require('view/registrationFormParent.php');
      if ($_GET['type'] == 'babysitter') require('view/registrationFormBabysitter.php');
  }

  elseif ($_GET['action'] == 'connexion') {
      require('view/connexionForm.php');
  }

  elseif ($_GET['action'] == 'connectMember') {
      if (!empty($_POST['email']) && !empty($_POST['password'])) {
          if(isset($_POST['case'])) {
              $case = 'on';
           }
          else {
              $case = 'off';
          }
          connectMember($_POST['email'], $_POST['password'], $case);
      }
      else {
          throw new Exception('tous les champs n\'ont pas été remplis');
      }
    }
}
else {
  require('view/homeView.php');
}
}
