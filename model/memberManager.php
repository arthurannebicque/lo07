<?php

namespace LO07\Sittie2\Model;

class MemberManager {

    protected function dbConnect() {
        try {
            $db = new \PDO('mysql:host=localhost;dbname=sitties;charset=utf8', 'root', 'root');
            return $db;
        } catch (Exception $e) {
            echo 'Echec de connexion : ' . $e->getMessage();
        }
    }

    public function verifyEmail($email) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS exist_email FROM authentifiants WHERE LOWER(email)= :email');
        $req->execute(array('email' => strtolower($email)));
        $emailUsed = $req->fetch();

        return $emailUsed;
    }

    public function createCredentials($email, $password, $type) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO authentifiants(email, password, type) VALUES(?, ?, ?)');
        $req->execute(array($email, $password, $type));
        $req2 = $db->prepare('SELECT id_user FROM authentifiants WHERE LOWER(email)= :email');
        $req2->execute(array('email' => strtolower($email)));
        $affectedCredentials = $req2->fetch();

        return $affectedCredentials;
    }

    public function createBabysitter($id, $nom, $prenom, $ville, $telephone, $age, $experience) {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO babysitters(id, nom, prenom, ville, portable, age, experience) VALUES(?, ?, ?, ?, ?, ?, ?)');
        $affectedBabysitter = $req->execute(array($id, $nom, $prenom, $ville, $telephone, $age, $experience));

        return $affectedBabysitter;
    }

    public function createParent($id, $nom, $ville, $presentation) {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO parents(id_parent, nom, ville, presentation) VALUES(?, ?, ?, ?)');
        $affectedParent = $req->execute(array($id, $nom, $ville, $presentation));

        return $affectedParent;
    }

    public function getCredentials($email) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_user, password, type FROM authentifiants WHERE email = :email');
        $req->execute(array('email' => $email));
        $credentials = $req->fetch();

        return $credentials;
    }

    public function validateApplication($id) {
        $db = $this->dbConnect();
        $affectedBabysitter = $db->prepare('UPDATE babysitters SET candidature_valide = 1, visible = 1 WHERE id = :id');
        $affectedBabysitter->execute(array(
            'id' => $id,
        ));

        return $affectedBabysitter;
    }

    public function declineApplication($id) {
        $db = $this->dbConnect();
        $affectedBabysitter = $db->prepare('DELETE FROM authentifiants WHERE id_user = :id');
        $affectedBabysitter->execute(array(
            'id' => $id,
        ));

        return $affectedBabysitter;
    }

    public function createEnfant($id_parent, $prenom, $date, $restrictions) {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO enfants(id_parent, prenom, date_naissance, restrictions) VALUES(?, ?, ?, ?)');
        $affectedEnfant = $req->execute(array($id_parent, $prenom, $date, $restrictions));

        return $affectedEnfant;
    }

    public function getEnfants($id) {
        $db = $this->dbConnect();
        $listeEnfants = $db->prepare('SELECT * FROM enfants WHERE id_parent = ?');
        $listeEnfants->execute(array($id));

        return $listeEnfants;
    }

    public function getEnfantsResa($newReservationId) {
        $db = $this->dbConnect();
        $listeEnfants = $db->prepare('SELECT enfants.prenom, enfants.restrictions FROM enfants, reservation_enfant WHERE enfants.id = reservation_enfant.id_enfant AND reservation_enfant.id_reservation = ?');
        $listeEnfants->execute(array($newReservationId));

        return $listeEnfants;
    }

    public function getBabysitterInfos($id_reservation) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT nom, prenom, portable FROM babysitters, reservations WHERE reservations.id = ? AND babysitters.id = reservations.id_babysitter');
        $req->execute(array($id_reservation));
        $babysitter = $req->fetch();
        return $babysitter;
    }

    public function getBabysitterInfosID($id) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM babysitters WHERE id = ?');
        $req->execute(array($id));
        $babysitter = $req->fetch();
        return $babysitter;
    }

    public function getBabysittersApplication() {
        $db = $this->dbConnect();
        $babysitters = $db->prepare('SELECT * FROM babysitters WHERE candidature_valide = 0');
        $babysitters->execute();

        return $babysitters;
    }

    public function getBabysittersCount($value) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) FROM babysitters WHERE candidature_valide = ?');
        $req->execute(array($value));
        $babysitterCount = $req->fetch();

        return $babysitterCount;
    }

    public function getLangueId($langue) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id FROM langues WHERE langue = ?');
        $req->execute(array($langue));
        $langueID = $req->fetch();

        return $langueID;
    }

    public function createLangue($langue) {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO langues(langue) VALUES(?)');
        $req->execute(array($langue));
        $langueID = $db->lastInsertId();

        return $langueID;
    }

    public function createBabysitterLangue($id_babysitter, $id_langue) {
        $db = $this->dbConnect();

        $req = $db->prepare('INSERT INTO babysitter_langue(id_babysitter, id_langue) VALUES(?,?)');
        $affectedBabysitterLangue = $req->execute(array($id_babysitter, $id_langue));

        return $affectedBabysitterLangue;
    }

    public function getLangue($id_langue) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT langue FROM langues WHERE id = ?');
        $req->execute(array($id_langue));
        $langue = $req->fetch();
        return $langue;
    }

    public function getLangues() {
        $db = $this->dbConnect();
        $listeLangues = $db->prepare('SELECT langues.id, langues.langue FROM langues, babysitter_langue WHERE EXISTS (SELECT * FROM babysitter_langue WHERE babysitter_langue.id_langue = langues.id) GROUP BY langues.id');
        $listeLangues->execute();

        return $listeLangues;
    }

    public function findBabysitter($id_langue) {
        $db = $this->dbConnect();

        $babysitters = $db->prepare('SELECT babysitters.id, babysitters.nom, babysitters.prenom, babysitters.ville FROM babysitters, babysitter_langue WHERE babysitter_langue.id_langue = ? AND babysitters.id = babysitter_langue.id_babysitter AND babysitters.visible = 1');
        $babysitters->execute(array($id_langue));

        return $babysitters;
    }

    public function getListRevenuBabysitter() {
        $db = $this->dbConnect();
        $listeRevenuBabysitter = $db->prepare('SELECT babysitters.prenom, babysitters.nom, SUM(reservations.revenu) AS revenu FROM babysitters, reservations WHERE babysitters.id = reservations.id_babysitter AND reservations.revenu > 0 GROUP BY babysitters.id ORDER BY revenu DESC');
        $listeRevenuBabysitter->execute();

        return $listeRevenuBabysitter;

    }

    public function getVilleParent($id) {
      $db = $this->dbConnect();
      $req = $db->prepare('SELECT ville FROM parents WHERE id_parent = ?');
      $req->execute(array($id));
      $ville = $req->fetch();
      return $ville;
    }

    public function getListeRatings($id) {
      $db = $this->dbConnect();
      $ratings = $db->prepare('SELECT note, evaluation FROM reservations WHERE id_babysitter = ? AND note != -1');
      $ratings->execute(array($id));

      return $ratings;
    }

    public function getNoteMoyenne($id) {
      $db = $this->dbConnect();
      $req = $db->prepare('SELECT AVG(note) AS average FROM reservations WHERE id_babysitter = ? AND note != -1');
      $req->execute(array($id));
      $average = $req->fetch();
      return $average;
    }

}
