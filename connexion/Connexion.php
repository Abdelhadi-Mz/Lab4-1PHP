<?php
class Connexion {
  private PDO $connexion;

  public function __construct() {
    $host = 'localhost';
    $dbname = 'school1';
    $login = 'root';
    $password = '';

    try {
      $dsn = "mysql:host=$host;port=3307;dbname=$dbname;charset=utf8mb4";
      $this->connexion = new PDO($dsn, $login, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]);
    } catch (Exception $e) {
      die('Erreur Connexion BD : ' . $e->getMessage());
    }
  }

  public function getConnexion(): PDO {
    return $this->connexion;
  }
}