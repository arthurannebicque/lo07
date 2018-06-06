<?php

require_once ('model/MemberManager.php');
require_once ('model/SlotManager.php');

function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)
{
   //Test1: fichier correctement uploadé
     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
   //Test2: taille limite
     if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
   //Test3: extension
     $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
     if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
   //Déplacement
     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination.".".$ext);
}

function addBabysitter($nom, $prenom, $email, $password, $passwordConfirmation, $type, $ville, $telephone, $age, $experience, $langues, $presentation) {

    $memberManager = new \LO07\Sittie2\Model\MemberManager();

    //Verification de l'email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        $emailUsed = $memberManager->verifyEmail($email);
    } else {
        throw new Exception('l\'email n\'est pas valide');
    }
    //Verification et hachage du password
    if ($password == $passwordConfirmation) {
        $pass_hache = password_hash($password, PASSWORD_DEFAULT);
    } else {
        throw new Exception('les mots de passe ne sont identiques');
    }

    if ($emailUsed['exist_email'] == '0') {
        $affectedCredentials = $memberManager->createCredentials($email, $pass_hache, $type);
        $uploadPhoto = upload('profil',"ressources/pictures/{$affectedCredentials['id_user']}",1048576, array('png','jpg','jpeg') );
        if ($uploadPhoto === FALSE) {
          $deletedBabysitter = $memberManager->declineApplication($affectedCredentials['id_user']);
          throw new Exception('la photo n\'est pas valide');
        }
        $ext = substr(strrchr($_FILES['profil']['name'],'.'),1);
        $photoName = $affectedCredentials['id_user'].".".$ext;
        $affectedBabysitter = $memberManager->createBabysitter($affectedCredentials['id_user'], $nom, $prenom, $ville, $telephone, $age, $experience, $photoName, $presentation);
        foreach ($langues as $langue) {
            $langueUsed = $memberManager->getLangueId($langue);
            if ($langueUsed === false) {
                $affectedLangue = $memberManager->createLangue($langue);
                $affectedBabysitterLangue = $memberManager->createBabysitterLangue($affectedCredentials['id_user'], $affectedLangue);
            } else {
                $affectedBabysitterLangue = $memberManager->createBabysitterLangue($affectedCredentials['id_user'], $langueUsed['id']);
            }
        }
    } else {
        throw new Exception('Cet email est déjà utilisé');
    }

    if ($affectedBabysitter === false) {
        $deletedBabysitter = $memberManager->declineApplication($affectedCredentials['id_user']);
        throw new Exception("impossible d'ajouter le membre !");
    } else {
        header('Location: index.php?action=registrationComplete');
    }
}

function addParent($nom, $email, $password, $passwordConfirmation, $type, $ville, $presentation, $enfants) {

    $memberManager = new \LO07\Sittie2\Model\MemberManager();

    //Verification de l'email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
        $emailUsed = $memberManager->verifyEmail($email);
    } else {
        throw new Exception('l\'email n\'est pas valide');
    }
    //Verification et hachage du password
    if ($password == $passwordConfirmation) {
        $pass_hache = password_hash($password, PASSWORD_DEFAULT);
    } else {
        throw new Exception('les mots de passe ne sont identiques');
    }

    if ($emailUsed['exist_email'] == '0') {
        $affectedCredentials = $memberManager->createCredentials($email, $pass_hache, $type);
        $affectedParent = $memberManager->createParent($affectedCredentials['id_user'], $nom, $ville, $presentation);
        foreach ($enfants as $enfant) {
            $affectedEnfant = $memberManager->createEnfant($affectedCredentials['id_user'], $enfant['name'], $enfant['date'], $enfant['restrictions']);
        }
    } else {
        throw new Exception('Cet email est déjà utilisé');
    }


    if ($affectedParent === false) {
        throw new Exception("impossible d'ajouter le membre !");
    } else {
        header('Location: index.php?index.php');
    }
}

function connectMember($email, $password, $cookie) {

    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $memberCredentials = $memberManager->getCredentials($email);

    $isPasswordCorrect = password_verify($password, $memberCredentials['password']);

    if ($memberCredentials === false) {
        throw new Exception('mauvais identifiant ou mot de passe');
    } else {
        if ($isPasswordCorrect) {
            $_SESSION['id'] = $memberCredentials['id_user'];
            $_SESSION['email'] = $email;
            $_SESSION['type'] = $memberCredentials['type'];
            if ($cookie == "on") {
                setcookie('email', $email, time() + 31 * 24 * 3600, null, null, false, true);
                setcookie('pass_hash', $memberCredentials['password'], time() + 31 * 24 * 3600, null, null, false, true);
            }
            header('Location: index.php');
        } else {
            throw new Exception('mauvais identifiant ou mot de passe');
        }
    }
}

function cookieConnect($email, $pass_hash) {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $cookieCredentials = $memberManager->verifyCookieCredentials($email, $pass_hash);

    if($cookieCredentials['exist_member'] == '1') {
        $memberCredentials = $memberManager->getCredentials($email);
        $_SESSION['id'] = $memberCredentials['id_user'];
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $memberCredentials['type'];
    }
    header('Location: index.php');
}

function deconnectMember() {
    $_SESSION = array();
    session_destroy();

    // Suppression des cookies de connexion automatique
    setcookie('email', '');
    setcookie('pass_hash', '');

    header('Location: index.php');
}

function validateApplication($id) {
  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $affectedBabysitter = $memberManager->validateApplication($id);
  header('Location: index.php');
}

function declineApplication($id) {
  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $affectedBabysitter = $memberManager->declineApplication($id);
  header('Location: index.php');
}

function showProfil() {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $slotManager = new \LO07\Sittie2\Model\SlotManager();

    if ($_SESSION['type'] == 1) {
        $babysitter = $memberManager->getBabysitterInfosID($_SESSION['id']);
        $slots = $slotManager->getDispos($_SESSION['id']);
    } elseif ($_SESSION['type'] == 2) {
        $reservations = $slotManager->getReservations($_SESSION['id']);
        $reservation = $reservations->fetchall();

        for ($i = 0; $i < count($reservation); $i++) {
          $dateFin = $slotManager->getReservationDate($reservation[$i]['id'], "DESC");
          $reservation[$i]['fin'] = $dateFin;
        }
    } elseif ($_SESSION['type'] == 3) {
      $listBabysitters = $memberManager->getBabysittersApplication();
      $babysitters = $listBabysitters->fetchall();
      for ($i = 0; $i < count($babysitters); $i++) {
        $listeLangues = $memberManager->getLanguesBabysitter($babysitters[$i]['id']);
        $babysitters[$i]['langues'] = $listeLangues->fetchall();
      }

      $applicationCount = $memberManager->getBabysittersCount(0);
      $babysitterCount = $memberManager->getBabysittersCount(1);
      $listeRevenuBabysitter = $memberManager->getListRevenuBabysitter();
      $revenuMensuelGlobal = $slotManager->getRevenuMensuelGlobal();
      $revenuAnnuelGlobal = $slotManager->getRevenuAnnuelGlobal();
      $revenuTrimestrielGlobal = $slotManager->getRevenuTrimestrielGlobal();
    }
    require('view/profilPage.php');
}

function addDispoSimple($id, $date, $heure_debut, $heure_fin) {

    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $statut = 'disponible';

    if ($heure_debut < $heure_fin) {
        for ($i = 0; $i < ($heure_fin - $heure_debut); $i++) {
            $heure = $heure_debut + $i;
            if ($heure_debut + $i < 10)
                $heure = '0' . ($heure_debut + $i);
            $creneau = $date . ' ' . ($heure) . ':00:00<br>';
            $affectedSlot = $slotManager->createDispo($id, $creneau, $statut);
        }
    }
    else {
        throw new Exception("l'heure de fin n'est pas valide");
    }

    header('Location: index.php');
}

function addDispoRecurrente($id, $weekday, $date_debut, $date_fin) {

    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $statut = 'disponible';
    $time_type = array(0 => array('06', '07'), 1 => array('08', '09', '10', '11'), 2 => array('12', '13'), 3 => array('14', '15', '16'),
        4 => array('17', '18', '19'), 5 => array('20', '21', '22'), 6 => '23');

    if ($date_debut < $date_fin) {
        $date_debut = new DateTime($date_debut);
        $date_fin = new DateTime($date_fin . " 00:00:01");
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($date_debut, $interval, $date_fin);
        foreach ($period as $dt) {
            if (isset($weekday[$dt->format('N')])) {
                foreach ($weekday[$dt->format('N')] as $key => $value) {
                    for ($i = 0; $i < 7; $i++) {
                        if ($key == $i) {
                            foreach ($time_type[$i] as $time) {
                                $slot = new DateTime($dt->format('Y-m-d') . " " . $time . ":00:00");
                                $creneau = $slot->format('Y-m-d H:i:s');
                                $affectedSlot = $slotManager->createDispo($id, $creneau, $statut);
                            }
                        }
                    }
                }
            }
        }
    } else {
        throw new Exception("la date de fin n'est pas valide");
    }
    header('Location: index.php');
}

function debug($req) {
    while ($res = $req->fetch()) {
        echo ("<pre>");
        var_dump($res);
        echo ("<br>");
        echo ("</pre>");
    }
}

function requestResaPonctuelle($id, $date, $heure_debut, $heure_fin, $enfants) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $memberManager = new \LO07\Sittie2\Model\MemberManager();

    $req = array();
    if ($heure_debut < $heure_fin) {
        for ($i = 0; $i < ($heure_fin - $heure_debut); $i++) {
            $heure = $heure_debut + $i;
            if ($heure_debut + $i < 10)
                $heure = '0' . ($heure_debut + $i);
            $creneau = $date . ' ' . ($heure) . ':00:00';
            $req[] = $creneau;
        }
        $count = count($req);
        $creneaux = join("','", $req);
        $villeParent = $memberManager->getVilleParent($_SESSION['id']);

        $listBabysitters = $slotManager->findDispos($creneaux, $count);
        $babysitters = $listBabysitters->fetchall();
        for ($i = 0; $i < count($babysitters); $i++) {
          $distance = getDistance($villeParent[0], $babysitters[$i]['ville']);
          $babysitters[$i]['distance'] = $distance;
          $listeRatings = $memberManager->getListeRatings($babysitters[$i]['id']);
          $babysitters[$i]['ratings'] = $listeRatings->fetchall();
          $noteMoyenne = $memberManager->getNoteMoyenne($babysitters[$i]['id']);
          $babysitters[$i]['average'] = $noteMoyenne;
        }
        $selectedEnfants = $enfants;
        $listeEnfants = $memberManager->getEnfants($_SESSION['id']);
        require('view/resaPonctuelleForm.php');
    }
}

function requestResaReguliere($id, $date_debut, $date_fin, $weekday, $enfants) {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $time_type = array(0 => array('06', '07'), 1 => array('08', '09', '10', '11'), 2 => array('12', '13'), 3 => array('14', '15', '16'),
        4 => array('17', '18', '19'), 5 => array('20', '21', '22'), 6 => '23');

    if ($date_debut < $date_fin) {
        $dateDebut = new DateTime($date_debut);
        $dateFin = new DateTime($date_fin . " 00:00:01");
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($dateDebut, $interval, $dateFin);
        foreach ($period as $dt) {
            if (isset($weekday[$dt->format('N')])) {
                foreach ($weekday[$dt->format('N')] as $key => $value) {
                    for ($i = 0; $i < 7; $i++) {
                        if ($key == $i) {
                            foreach ($time_type[$i] as $time) {
                                $slot = new DateTime($dt->format('Y-m-d') . " " . $time . ":00:00");
                                $creneau[] = $slot->format('Y-m-d H:i:s');
                            }
                        }
                    }
                }
            }
        }
    } else {
      throw new Exception('La date de fin n\'est pas valide');
    }
    $count = count($creneau);
    $creneaux = join("','", $creneau);
    $villeParent = $memberManager->getVilleParent($_SESSION['id']);
    $listBabysitters = $slotManager->findDispos($creneaux, $count);
    $babysitters = $listBabysitters->fetchall();
    for ($i = 0; $i < count($babysitters); $i++) {
      $distance = getDistance($villeParent[0], $babysitters[$i]['ville']);
      $babysitters[$i]['distance'] = $distance;
      $listeRatings = $memberManager->getListeRatings($babysitters[$i]['id']);
      $babysitters[$i]['ratings'] = $listeRatings->fetchall();
      $noteMoyenne = $memberManager->getNoteMoyenne($babysitters[$i]['id']);
      $babysitters[$i]['average'] = $noteMoyenne;
    }
    $selectedEnfants = $enfants;
    $listeEnfants = $memberManager->getEnfants($_SESSION['id']);
    require('view/resaReguliereForm.php');
}

function requestResaLangue($id, $id_langue, $enfants) {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $slotManager = new \LO07\Sittie2\Model\SlotManager();

    $listBabysitters = $memberManager->findBabysitter($id_langue);
    $selectedLangue = $memberManager->getLangue($id_langue);
    $villeParent = $memberManager->getVilleParent($_SESSION['id']);
    $babysitters = $listBabysitters->fetchall();
    for ($i = 0; $i < count($babysitters); $i++) {
        $distance = getDistance($villeParent[0], $babysitters[$i]['ville']);
        $babysitters[$i]['distance'] = $distance;
        $listeDispos = $slotManager->getFreeDispos($babysitters[$i]['id']);
        $babysitters[$i][] = $listeDispos->fetchall();
        $listeRatings = $memberManager->getListeRatings($babysitters[$i]['id']);
        $babysitters[$i]['ratings'] = $listeRatings->fetchall();
        $noteMoyenne = $memberManager->getNoteMoyenne($babysitters[$i]['id']);
        $babysitters[$i]['average'] = $noteMoyenne;
    }
    $selectedEnfants = $enfants;
    $listeEnfants = $memberManager->getEnfants($_SESSION['id']);
    $listeLangues = $memberManager->getLangues();
    require('view/resaLangueForm.php');
}

function createReservation($id_parent, $id_babysitter, $creneaux, $selectedEnfants, $type) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $newReservationId = $slotManager->createReservation($id_parent, $id_babysitter, $type);
    $listCreneaux = unserialize($creneaux);
    $statut = 'reservé';
    foreach ($listCreneaux as $creneau) {
        $affectedSlot = $slotManager->bookDispo($id_babysitter, $creneau, $statut, $newReservationId);
    }
    $selectedEnfants = unserialize($selectedEnfants);
    foreach ($selectedEnfants as $enfant) {
        $affectedEnfantReservation = $slotManager->registerEnfantReservation($enfant, $newReservationId);
    }
    $slots = $slotManager->getDisposResa($newReservationId);
    $babysitter = $memberManager->getBabysitterInfos($newReservationId);
    $listeEnfants = $memberManager->getEnfantsResa($newReservationId);
    $dateDebut = $slotManager->getReservationDate($newReservationId, "ASC");
    $dateFin = $slotManager->getReservationDate($newReservationId, "DESC");
    $type = $slotManager->getReservationType($newReservationId);
    $weekdays = $slotManager->getReservationWeekdays($newReservationId);
    while ($weekday = $weekdays->fetch()) {
      $hours = $slotManager->getReservationHours($newReservationId, $weekday['weekday']);
      $creneauResa[$weekday[0]] = $hours->fetchall();
    }

    require('view/recapReservation.php');
}

function createResaLangue($id_parent, $id_babysitter, $id_dispos, $enfants) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $type = 2;
    $newReservationId = $slotManager->createReservation($id_parent, $id_babysitter, $type);
    $statut = 'reservé';
    foreach ($id_dispos as $id_dispo) {
        $affectedSlot = $slotManager->bookDispoID($id_dispo, $statut, $newReservationId);
    }
    foreach ($enfants as $enfant) {
        $affectedEnfantReservation = $slotManager->registerEnfantReservation($enfant, $newReservationId);
    }
    $slots = $slotManager->getDisposResa($newReservationId);
    $babysitter = $memberManager->getBabysitterInfos($newReservationId);
    $listeEnfants = $memberManager->getEnfantsResa($newReservationId);
    require('view/recapReservation.php');
}

function getListeEnfants() {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $listeEnfants = $memberManager->getEnfants($_SESSION['id']);

    if ($_GET['type'] == 'ponctuelle') {
        require('view/resaPonctuelleForm.php');
    } elseif ($_GET['type'] == 'reguliere') {
        require('view/resaReguliereForm.php');
    }
}

function getResaLangueForm() {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $listeEnfants = $memberManager->getEnfants($_SESSION['id']);
    $listeLangues = $memberManager->getLangues();

    require('view/resaLangueForm.php');
}

function showReservation($id_reservation) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $memberManager = new \LO07\Sittie2\Model\MemberManager();

    $babysitter = $memberManager->getBabysitterInfos($id_reservation);
    $famille = $slotManager->getReservationName($id_reservation);
    $slots = $slotManager->getDisposResa($id_reservation);
    $listeEnfants = $memberManager->getEnfantsResa($id_reservation);
    $dateDebut = $slotManager->getReservationDate($id_reservation, 'ASC');
    $dateFin = $slotManager->getReservationDate($id_reservation, "DESC");
    $type = $slotManager->getReservationType($id_reservation);
    $weekdays = $slotManager->getReservationWeekdays($id_reservation);
    while ($weekday = $weekdays->fetch()) {
      $hours = $slotManager->getReservationHours($id_reservation, $weekday['weekday']);
      $creneauResa[$weekday[0]] = $hours->fetchall();
    }

    require('view/recapReservation.php');
}

function closeReservation($id_reservation, $heure_debut, $heure_fin, $note, $evaluation, $type) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $memberManager = new \LO07\Sittie2\Model\MemberManager();

    $statut = "expiré";

    $listeEnfants = $memberManager->getEnfantsResa($id_reservation);
    $enfant = $listeEnfants->fetchall();
    $nombreEnfants = count($enfant);
    if ($type[0] == 1) {
        $duree = $heure_fin - $heure_debut;
        $revenu = $duree * (7 + 4 * ($nombreEnfants - 1));
    }
    if ($type[0] == 2) {
        $duree = $heure_fin - $heure_debut;
        $revenu = $duree * (15 + 15 * ($nombreEnfants - 1));
    }
    if ($type[0] == 3) {
        $duree = $heure_fin;
        $revenu = $duree * (10 + 5 * ($nombreEnfants - 1));
    }
    $affectedDispo = $slotManager->updateDisposResa($id_reservation, $statut);
    $affectedResa = $slotManager->updateReservation($id_reservation, $note, $evaluation, $revenu);

    header('Location: index.php?index.php');
}

function getDistance($origin, $destination) {
  $origin = urlencode($origin);
  $destination = urlencode($destination);
  $url="https://maps.googleapis.com/maps/api/distancematrix/json?origins={$origin}&destinations={$destination}&key=AIzaSyCSysIBEGGSED6I8XqB0CM-ywiIczcwIgE";
  $resp_json = file_get_contents($url);
  $resp = json_decode($resp_json, true);
  if($resp['status']=='OK'){
    $distance = isset($resp['rows'][0]['elements'][0]['distance']['value']) ? $resp['rows'][0]['elements'][0]['distance']['value'] : "";
  } else {
    throw new Exception('Impossible de rentrer cette adresse');
  }

  return $distance/1000;
}

function searchBabysitter($name) {
  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $slotManager = new \LO07\Sittie2\Model\SlotManager();

  $babysittersSearch = $memberManager->searchBabysitterName($name);
  $applicationCount = $memberManager->getBabysittersCount(0);
  $babysitterCount = $memberManager->getBabysittersCount(1);
  $revenuMensuelGlobal = $slotManager->getRevenuMensuelGlobal();
  $revenuAnnuelGlobal = $slotManager->getRevenuAnnuelGlobal();
  $revenuTrimestrielGlobal = $slotManager->getRevenuTrimestrielGlobal();


  require('view/showSearchForm.php');
}

  function showBabysitterDetails($id){

    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $slotManager = new \LO07\Sittie2\Model\SlotManager();

    $applicationCount = $memberManager->getBabysittersCount(0);
    $babysitterCount = $memberManager->getBabysittersCount(1);
    $revenuMensuelGlobal = $slotManager->getRevenuMensuelGlobal();
    $revenuAnnuelGlobal = $slotManager->getRevenuAnnuelGlobal();
    $revenuTrimestrielGlobal = $slotManager->getRevenuTrimestrielGlobal();
    $babysitterInfos = $memberManager->getBabysitterInfosID($id);
    $listeLangues = $memberManager->getLanguesBabysitter($id);
    $babysitterInfos['langues'] = $listeLangues->fetchall();
    $listeReservations = $memberManager->getBabysitterReservations($id);
    $reservations = $listeReservations->fetchall();
    for ($i = 0; $i < count($reservations); $i++) {
      $reservations[$i]['dateDebut'] = $slotManager->getReservationDate($reservations[$i]['id'], 'ASC');
      $reservations[$i]['dateFin'] = $slotManager->getReservationDate($reservations[$i]['id'], "DESC");
      $reservations[$i]['slots'] = $slotManager->getDisposResa($reservations[$i]['id']);
      $reservations[$i]['listeEnfants'] = $memberManager->getEnfantsResa($reservations[$i]['id']);
      $weekdays = $slotManager->getReservationWeekdays($reservations[$i]['id']);
      while ($weekday = $weekdays->fetch()) {
        $hours = $slotManager->getReservationHours($reservations[$i]['id'], $weekday['weekday']);
        $reservations[$i]['creneauResa'][$weekday[0]] = $hours->fetchall();
      }
    }
    require('view/showSearchForm.php');

  }

function showRevenuList() {
  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $slotManager = new \LO07\Sittie2\Model\SlotManager();

  $applicationCount = $memberManager->getBabysittersCount(0);
  $babysitterCount = $memberManager->getBabysittersCount(1);
  $listeRevenuBabysitter = $memberManager->getListRevenuBabysitter();
  $revenuMensuelGlobal = $slotManager->getRevenuMensuelGlobal();
  $revenuAnnuelGlobal = $slotManager->getRevenuAnnuelGlobal();
  $revenuTrimestrielGlobal = $slotManager->getRevenuTrimestrielGlobal();

  require('view/showRevenuList.php');
}

function showSearchForm() {

  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $slotManager = new \LO07\Sittie2\Model\SlotManager();

  $applicationCount = $memberManager->getBabysittersCount(0);
  $babysitterCount = $memberManager->getBabysittersCount(1);
  $revenuMensuelGlobal = $slotManager->getRevenuMensuelGlobal();
  $revenuAnnuelGlobal = $slotManager->getRevenuAnnuelGlobal();
  $revenuTrimestrielGlobal = $slotManager->getRevenuTrimestrielGlobal();

  require('view/showSearchForm.php');

}

function blockBabysitter($id, $nom) {
  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $visible = 0;
  $affectedBabysitter = $memberManager->updateBabysitterVisibility($id, $visible);
  searchBabysitter($nom);

}
function unblockBabysitter($id, $nom) {
  $memberManager = new \LO07\Sittie2\Model\MemberManager();
  $visible = 1;
  $affectedBabysitter = $memberManager->updateBabysitterVisibility($id, $visible);
  searchBabysitter($nom);

}
