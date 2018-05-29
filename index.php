<?php

session_start();
require('controller/frontend.php');

if (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['type'])) {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'deconnexion') {
            deconnectMember();
        } elseif ($_GET['action'] == 'disponibilite') {
            if ($_GET['type'] == 'simple')
                require('view/dispoSimpleForm.php');
            if ($_GET['type'] == 'recurrente')
                require('view/dispoRecurrenteForm.php');
        }
        elseif ($_GET['action'] == 'addDispoSimple') {
            if (!empty($_POST['date']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin'])) {
                addDispoSimple($_SESSION['id'], $_POST['date'], $_POST['heure_debut'], $_POST['heure_fin']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'addDispoRecurrente') {
            if (!empty($_POST['weekday']) && !empty($_POST['date_debut']) && !empty($_POST['date_fin'])) {
                addDispoRecurrente($_SESSION['id'], $_POST['weekday'], $_POST['date_debut'], $_POST['date_fin']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'reservation') {
            if ($_GET['type'] == 'ponctuelle')
                getListeEnfants(); //require('view/resaPonctuelleForm.php');
            if ($_GET['type'] == 'reguliere')
                getListeEnfants();
            if ($_GET['type'] == 'langue')
                getResaLangueForm(); //require('view/resaPonctuelleForm.php');
        }
        elseif ($_GET['action'] == 'requestResaPonctuelle') {
            if (!empty($_POST['date']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin']) && !empty($_POST['enfants'])) {
                requestResaPonctuelle($_SESSION['id'], $_POST['date'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['enfants']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'requestResaReguliere') {
            if (!empty($_POST['date_debut']) && !empty($_POST['date_fin']) && !empty($_POST['weekday']) && !empty($_POST['enfants'])) {
                requestResaReguliere($_SESSION['id'], $_POST['date_debut'], $_POST['date_fin'], $_POST['weekday'], $_POST['enfants']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'requestResaLangue') {
            if (!empty($_POST['langue']) && !empty($_POST['enfants'])) {
                requestResaLangue($_SESSION['id'], $_POST['langue'], $_POST['enfants']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'createReservation') {
            if (isset($_GET['id']) && isset($_GET['creneaux']) && isset($_GET['enfants']) && isset($_GET['type'])) {
                createReservation($_SESSION['id'], $_GET['id'], $_GET['creneaux'], $_GET['enfants'], $_GET['type']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'createResaLangue') {
            if (!empty($_POST['id_babysitter']) && !empty($_POST['dispo']) && !empty($_POST['enfants'])) {
                createResaLangue($_SESSION['id'], $_POST['id_babysitter'], $_POST['dispo'], $_POST['enfants']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'showReservation') {
            if (isset($_GET['id'])) {
                showReservation($_GET['id']);
            }
        } elseif ($_GET['action'] == 'closeReservationForm') {
            if (isset($_GET['id'])) {
                require('view/closeReservationForm.php');
            }
        } elseif ($_GET['action'] == 'closeReservation') {
            if (!empty($_POST['id_reservation']) && !empty($_POST['note']) && !empty($_POST['heure_debut']) && !empty($_POST['heure_fin']) && !empty($_POST['evaluation']) && !empty($_POST['type'])) {
                closeReservation($_POST['id_reservation'], $_POST['heure_debut'], $_POST['heure_fin'], $_POST['note'], $_POST['evaluation'], $_POST['type']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'validateApplication') {
            if (isset($_GET['id'])) {
                validateApplication($_GET['id']);
            }
        } elseif ($_GET['action'] == 'declineApplication') {
            if (isset($_GET['id'])) {
                declineApplication($_GET['id']);
            }
        } elseif ($_GET['action'] == 'searchBabysitter') {
            if (isset($_POST['name'])) {
                searchBabysitter($_POST['name']);
            }
        } elseif ($_GET['action'] == 'showRevenuList') {
                showRevenuList();
        } elseif ($_GET['action'] == 'showSearchForm') {
                showSearchForm();
        } elseif ($_GET['action'] == 'showBabysitterDetails') {
            if (isset($_GET['id'])) {
                showBabysitterDetails($_GET['id']);
            }
        } elseif ($_GET['action'] == 'blockBabysitter') {
            if (isset($_GET['id']) && isset($_GET['nom'])) {
                blockBabysitter($_GET['id'], $_GET['nom']);
            }
        } elseif ($_GET['action'] == 'unblockBabysitter') {
            if (isset($_GET['id']) && isset($_GET['nom'])) {
                unblockBabysitter($_GET['id'], $_GET['nom']);
            }
        }
    } else {
        showProfil();
    }
} else {
    if (isset($_GET['action'])) {

        if ($_GET['action'] == 'addBabysitter') {
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation']) && !empty($_POST['email']) && !empty($_POST['type']) && !empty($_POST['ville'])) {
                addBabysitter($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['password'], $_POST['passwordConfirmation'], $_POST['type'], $_POST['ville'], $_POST['telephone'], $_POST['age'], $_POST['experience'], $_POST['langues'], $_POST['presentation']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'addParent') {
            if (!empty($_POST['nom']) && !empty($_POST['password']) && !empty($_POST['passwordConfirmation']) && !empty($_POST['email']) && !empty($_POST['type']) && !empty($_POST['ville']) && !empty($_POST['enfants'])) {
                addParent($_POST['nom'], $_POST['email'], $_POST['password'], $_POST['passwordConfirmation'], $_POST['type'], $_POST['ville'], $_POST['presentation'], $_POST['enfants']);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        } elseif ($_GET['action'] == 'registration') {
            if ($_GET['type'] == 'parent')
                require('view/registrationFormParent.php');
            if ($_GET['type'] == 'babysitter')
                require('view/registrationFormBabysitter.php');
        }

        elseif ($_GET['action'] == 'connexion') {
            require('view/connexionForm.php');
        } elseif ($_GET['action'] == 'connectMember') {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                if (isset($_POST['case'])) {
                    $case = 'on';
                } else {
                    $case = 'off';
                }
                connectMember($_POST['email'], $_POST['password'], $case);
            } else {
                throw new Exception('tous les champs n\'ont pas été remplis');
            }
        }
    } else {
        require('view/homeView.php');
    }
}
