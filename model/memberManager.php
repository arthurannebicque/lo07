<?php

namespace LO07\Sittie2\Model;


class MemberManager {

  protected function dbConnect(){
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

  public function createEnfant($id_parent, $prenom, $date, $restrictions) {
      $db = $this->dbConnect();

      $req = $db->prepare('INSERT INTO enfants(id_parent, prenom, date_naissance, restrictions) VALUES(?, ?, ?, ?)');
      $affectedEnfant = $req->execute(array($id_parent, $prenom, $date, $restrictions));

      return $affectedEnfant;

  }

  public function getEnfants($id){
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
}
