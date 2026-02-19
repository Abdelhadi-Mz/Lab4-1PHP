<?php
include_once RACINE . '/classes/Etudiant.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class EtudiantService implements IDao {
  private Connexion $connexion;

  public function __construct() {
    $this->connexion = new Connexion();
  }

  public function create($o) {
    $sql = "INSERT INTO Etudiant(nom, prenom, ville, sexe) VALUES (:nom, :prenom, :ville, :sexe)";
    $stmt = $this->connexion->getConnexion()->prepare($sql);
    $stmt->execute([
      ':nom' => $o->getNom(),
      ':prenom' => $o->getPrenom(),
      ':ville' => $o->getVille(),
      ':sexe' => $o->getSexe()
    ]);
  }

  public function delete($o) {
    $sql = "DELETE FROM Etudiant WHERE id = :id";
    $stmt = $this->connexion->getConnexion()->prepare($sql);
    $stmt->execute([':id' => $o->getId()]);
  }

  public function update($o) {
    $sql = "UPDATE Etudiant
            SET nom = :nom, prenom = :prenom, ville = :ville, sexe = :sexe
            WHERE id = :id";
    $stmt = $this->connexion->getConnexion()->prepare($sql);
    $stmt->execute([
      ':nom' => $o->getNom(),
      ':prenom' => $o->getPrenom(),
      ':ville' => $o->getVille(),
      ':sexe' => $o->getSexe(),
      ':id' => $o->getId()
    ]);
  }

  public function findAll() {
    $etds = [];
    $sql = "SELECT * FROM Etudiant ORDER BY id DESC";
    $stmt = $this->connexion->getConnexion()->prepare($sql);
    $stmt->execute();

    while ($e = $stmt->fetch(PDO::FETCH_OBJ)) {
      $etds[] = new Etudiant($e->id, $e->nom, $e->prenom, $e->ville, $e->sexe);
    }
    return $etds;
  }
//test
  public function findById($id) {
    $sql = "SELECT * FROM Etudiant WHERE id = :id";
    $stmt = $this->connexion->getConnexion()->prepare($sql);
    $stmt->execute([':id' => $id]);

    $e = $stmt->fetch(PDO::FETCH_OBJ);
    if (!$e) return null;

    return new Etudiant($e->id, $e->nom, $e->prenom, $e->ville, $e->sexe);
  }


  
  public function findAllApi() {
    $sql = "SELECT * FROM Etudiant ORDER BY id DESC";
    $stmt = $this->connexion->getConnexion()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
