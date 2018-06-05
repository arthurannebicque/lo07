<?php

namespace LO07\Sittie2\Model;

class SlotManager {

    protected function dbConnect() {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=sitties;charset=utf8', 'root', 'root', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            return $db;
        } catch (Exception $e) {
            echo 'Echec de connexion : ' . $e->getMessage();
        }
    }

    public function createDispo($id_babysitter, $creneau, $statut) {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO disponibilites(id_babysitter, creneau, statut) VALUES(?, ?, ?)');
        $affectedSlot = $req->execute(array($id_babysitter, $creneau, $statut));

        return $affectedSlot;
    }

    public function getDispos($id_babysitter) {
        $db = $this->dbConnect();
        $slots = $db->prepare('SELECT id_dispo, DATE_FORMAT(creneau, "%d/%m/%Y") AS date, DATE_FORMAT(creneau, "%Hh%i") AS heure, statut, id_reservation FROM disponibilites WHERE id_babysitter = ? ORDER BY creneau');
        $slots->execute(array($id_babysitter));

        return $slots;
    }

    public function getFreeDispos($id_babysitter) {
        $db = $this->dbConnect();
        $slots = $db->prepare('SELECT id_dispo, DATE_FORMAT(creneau, "%d/%m/%Y") AS date, DATE_FORMAT(creneau, "%Hh%i") AS heure, statut, id_reservation FROM disponibilites WHERE id_babysitter = ? AND statut = "disponible" ORDER BY creneau');
        $slots->execute(array($id_babysitter));

        return $slots;
    }

    public function getDisposResa($id_reservation) {
        $db = $this->dbConnect();
        $slots = $db->prepare('SELECT DATE_FORMAT(creneau, "%d/%m/%Y") AS date, HOUR(creneau) AS heure FROM disponibilites WHERE id_reservation = ? ORDER BY creneau');
        $slots->execute(array($id_reservation));

        return $slots;
    }

    public function updateDisposResa($id_reservation, $statut) {
        $db = $this->dbConnect();
        $slots = $db->prepare('UPDATE disponibilites SET statut = :statut WHERE id_reservation = :id_reservation');
        $slots->execute(array(
            'statut' => $statut,
            'id_reservation' => $id_reservation,
        ));

        return $slots;
    }

    public function bookDispo($id_babysitter, $creneau, $statut, $id_reservation) {
        $db = $this->dbConnect();
        $slots = $db->prepare('UPDATE disponibilites SET statut = :statut, id_reservation = :id_reservation WHERE id_babysitter = :id_babysitter AND creneau = :creneau');
        $slots->execute(array(
            'statut' => $statut,
            'id_reservation' => $id_reservation,
            'id_babysitter' => $id_babysitter,
            'creneau' => $creneau
        ));

        return $slots;
    }

    public function bookDispoID($id_dispo, $statut, $id_reservation) {
        $db = $this->dbConnect();
        $slots = $db->prepare('UPDATE disponibilites SET statut = :statut, id_reservation = :id_reservation WHERE id_dispo = :id_dispo');
        $slots->execute(array(
            'statut' => $statut,
            'id_reservation' => $id_reservation,
            'id_dispo' => $id_dispo
        ));

        return $slots;
    }

    public function findDispos($creneaux, $count) {
        try {
            $db = $this->dbConnect();
            $query = "SELECT babysitters.id AS id, babysitters.nom AS nom, babysitters.prenom AS prenom, babysitters.ville AS ville, babysitters.age AS age, babysitters.experience AS experience, babysitters.presentation AS presentation, babysitters.photo FROM babysitters, disponibilites  WHERE babysitters.id = disponibilites.id_babysitter AND disponibilites.statut = 'disponible' AND babysitters.visible = 1 AND disponibilites.creneau IN ('$creneaux') GROUP BY babysitters.id HAVING COUNT(*) = '$count'";
            //$babysitters = $db->prepare("SELECT babysitters.id AS id, babysitters.nom AS nom, babysitters.prenom AS prenom FROM babysitters, disponibilites  WHERE babysitters.id = disponibilites.id_babysitter AND disponibilites.creneau IN (?) GROUP BY babysitters.id HAVING COUNT(*) = ?");
            //$babysitters->execute(array($creneaux, $count));
            //$babysitters->execute(array('creneaux' => $creneaux, 'count' => $count));
            $babysitters = $db->query($query);

            return $babysitters;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function createReservation($id_parent, $id_babysitter, $type) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO reservations(id_parent, id_babysitter, type) VALUES(?, ?, ?)');
        $req->execute(array($id_parent, $id_babysitter, $type));
        $newReservationId = $db->lastInsertId();

        return $newReservationId;
    }

    public function getReservations($id) {
        $db = $this->dbConnect();
        $reservations = $db->prepare('SELECT DATEDIFF(creneau, CURDATE()) AS diff, babysitters.nom, babysitters.prenom, DATE_FORMAT(disponibilites.creneau, "%d/%m/%Y") AS date, DATE_FORMAT(disponibilites.creneau, "%Hh%i") AS heure_debut, reservations.id As id, reservations.note AS note FROM babysitters, reservations, disponibilites WHERE reservations.id_parent = ? AND babysitters.id = reservations.id_babysitter AND disponibilites.id_reservation = reservations.id GROUP BY reservations.id ORDER BY disponibilites.creneau');
        $reservations->execute(array($id));

        return $reservations;
    }

    public function registerEnfantReservation($id_enfant, $newReservationId) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO reservation_enfant(id_reservation, id_enfant) VALUES(?, ?)');
        $req->execute(array($newReservationId, $id_enfant));
        return $req;
    }

    public function getReservationDetails($id_reservation) {
        $db = $this->dbConnect();
        $slots = $db->prepare('SELECT DATE_FORMAT(creneau, "%d/%m/%Y") AS date, HOUR(creneau) AS heure, parents.nom AS nom,  FROM disponibilites, parents, reservations WHERE reservations.id = ? AND disponibilites.id_reservation = reservations.id AND parents.id_parent = reservations.id_parent ORDER BY creneau');
        $slots->execute(array($id_reservation));

        return $slots;
    }

    public function getReservationName($id_reservation) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT parents.nom AS nom, parents.ville AS ville FROM parents, reservations WHERE reservations.id = ? AND parents.id_parent = reservations.id_parent');
        $req->execute(array($id_reservation));
        $famille = $req->fetch();
        return $famille;
    }

    public function getReservationWeekdays($id_reservation) {
      $db = $this->dbConnect();
      $weekdays = $db->prepare('SELECT WEEKDAY(creneau) AS weekday FROM disponibilites WHERE id_reservation = ? GROUP BY weekday');
      $weekdays->execute(array($id_reservation));

      return $weekdays;

    }

    public function getReservationDate($id_reservation, $ordre){
      $db = $this->dbConnect();
      $req = $db->prepare("SELECT DATE_FORMAT(creneau, '%d/%m/%Y') AS date_fin, DATEDIFF(creneau, CURDATE()) AS difference FROM disponibilites WHERE id_reservation = ? ORDER BY creneau {$ordre} LIMIT 1");
      $req->execute(array($id_reservation));
      $date = $req->fetch();
      return $date;
    }

    public function getReservationHours($id_reservation, $weekday){
      $db = $this->dbConnect();
      $hours = $db->prepare('SELECT HOUR(creneau) AS heure FROM disponibilites WHERE id_reservation = ? AND WEEKDAY(creneau) = ? GROUP BY heure');
      $hours->execute(array($id_reservation, $weekday));

      return $hours;
    }

    public function updateReservation($id_reservation, $note, $evaluation, $revenu) {
        $db = $this->dbConnect();
        $slots = $db->prepare('UPDATE reservations SET note = :note, evaluation = :evaluation, revenu = :revenu WHERE id = :id_reservation');
        $slots->execute(array(
            'note' => $note,
            'evaluation' => $evaluation,
            'revenu' => $revenu,
            'id_reservation' => $id_reservation
        ));

        return $slots;
    }

    public function getReservationType($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT type, note FROM reservations WHERE id = ?');
        $req->execute(array($id));
        $type = $req->fetch();
        return $type;
    }

    public function getRevenuMensuelGlobal() {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT SUM(revenu) FROM reservations WHERE id IN (SELECT reservations.id FROM reservations, disponibilites WHERE disponibilites.id_reservation = reservations.id AND MONTH(disponibilites.creneau) = MONTH(NOW()) AND reservations.revenu > 0 GROUP BY reservations.id)');
        $req->execute();
        $revenuMensuelGlobal = $req->fetch();
        return $revenuMensuelGlobal;
    }

    public function getRevenuAnnuelGlobal() {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT SUM(revenu) FROM reservations WHERE id IN (SELECT reservations.id FROM reservations, disponibilites WHERE disponibilites.id_reservation = reservations.id AND YEAR(disponibilites.creneau) = YEAR(NOW()) AND reservations.revenu > 0 GROUP BY reservations.id)');
        $req->execute();
        $revenuAnnuelGlobal = $req->fetch();
        return $revenuAnnuelGlobal;
    }

    public function getRevenuTrimestrielGlobal() {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT SUM(revenu) FROM reservations WHERE id IN (SELECT reservations.id FROM reservations, disponibilites WHERE disponibilites.id_reservation = reservations.id AND MONTH(disponibilites.creneau) IN (MONTH(NOW()), MONTH(NOW())-1, MONTH(NOW())-2) AND reservations.revenu > 0 GROUP BY reservations.id)');
        $req->execute();
        $revenuTrimestrielGlobal = $req->fetch();
        return $revenuTrimestrielGlobal;
    }

}
