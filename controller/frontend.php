<?php

require_once ('model/MemberManager.php');
require_once ('model/SlotManager.php');

function addBabysitter($nom, $prenom, $email, $password, $passwordConfirmation, $type, $ville, $telephone, $age, $experience, $langues) {

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
        $affectedBabysitter = $memberManager->createBabysitter($affectedCredentials['id_user'], $nom, $prenom, $ville, $telephone, $age, $experience);
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
        throw new Exception("impossible d'ajouter le membre !");
    } else {
        header('Location: index.php?action=registrationComplete&email=' . $email);
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
    } elseif ($_SESSION['type'] == 3) {
      $babysitters = $memberManager->getBabysittersApplication();
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
        $listBabysitters = $slotManager->findDispos($creneaux, $count);
        var_dump($enfants);
        echo "<br>";
        var_dump($listBabysitters);
        $selectedEnfants = $enfants;
        $memberManager = new \LO07\Sittie2\Model\MemberManager();
        $listeEnfants = $memberManager->getEnfants($_SESSION['id']);
        require('view/resaPonctuelleForm.php');
    }
}

function requestResaReguliere($id, $date_debut, $date_fin, $weekday, $enfants) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
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
                                $creneau[] = $slot->format('Y-m-d H:i:s');
                            }
                        }
                    }
                }
            }
        }
    }
    $count = count($creneau);
    $creneaux = join("','", $creneau);
    $listBabysitters = $slotManager->findDispos($creneaux, $count);
    $selectedEnfants = $enfants;
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $listeEnfants = $memberManager->getEnfants($_SESSION['id']);
    require('view/resaReguliereForm.php');
}

function requestResaLangue($id, $id_langue, $enfants) {
    $memberManager = new \LO07\Sittie2\Model\MemberManager();
    $slotManager = new \LO07\Sittie2\Model\SlotManager();

    $listBabysitters = $memberManager->findBabysitter($id_langue);
    $selectedLangue = $memberManager->getLangue($id_langue);
    $babysitters = $listBabysitters->fetchall();
    //foreach ($babysitters as $babysitter ) {
    for ($i = 0; $i < count($babysitters); $i++) {
        $listeDispos = $slotManager->getFreeDispos($babysitters[$i]['id']);
        $babysitters[$i][] = $listeDispos->fetchall();
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
        echo $id_babysitter . " " . $creneau . " " . $statut . "<br>";
        $affectedSlot = $slotManager->bookDispo($id_babysitter, $creneau, $statut, $newReservationId);
    }
    $selectedEnfants = unserialize($selectedEnfants);
    foreach ($selectedEnfants as $enfant) {
        $affectedEnfantReservation = $slotManager->registerEnfantReservation($enfant, $newReservationId);
    }
    //if ($type == 1) $slots = $slotManager->getDisposResa($newReservationId);
    //if ($type == 3) $slots = $slotManager->getDisposResa($newReservationId);
    $slots = $slotManager->getDisposResa($newReservationId);
    $babysitter = $memberManager->getBabysitterInfos($newReservationId);
    $listeEnfants = $memberManager->getEnfantsResa($newReservationId);

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

    require('view/recapReservation.php');
}

function closeReservation($id_reservation, $heure_debut, $heure_fin, $note, $evaluation) {
    $slotManager = new \LO07\Sittie2\Model\SlotManager();
    $memberManager = new \LO07\Sittie2\Model\MemberManager();

    $statut = "expiré";
    $type = $slotManager->getReservationType($id_reservation);
    $duree = $heure_fin - $heure_debut;
    $listeEnfants = $memberManager->getEnfantsResa($id_reservation);
    $enfant = $listeEnfants->fetchall();
    $nombreEnfants = count($enfant);
    if ($type[0] == 1) {
        $revenu = $duree * (7 + 4 * ($nombreEnfants - 1));
    }
    if ($type[0] == 2) {
        $revenu = $duree * (15 + 15 * ($nombreEnfants - 1));
    }
    if ($type[0] == 3) {
        $slots = $slotManager->getDisposResa($id_reservation);
        $slot = $slots->fetchall();
        $duree = count($slot);
        $revenu = $duree * (10 + 5 * ($nombreEnfants - 1));
    }
    $affectedDispo = $slotManager->updateDisposResa($id_reservation, $statut);
    $affectedResa = $slotManager->updateReservation($id_reservation, $note, $evaluation, $revenu);

    header('Location: index.php?index.php');
}
