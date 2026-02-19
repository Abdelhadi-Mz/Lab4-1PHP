<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include_once '../racine.php';
  include_once RACINE . '/service/EtudiantService.php';

  $nom = trim($_POST['nom'] ?? '');
  $prenom = trim($_POST['prenom'] ?? '');
  $ville = trim($_POST['ville'] ?? '');
  $sexe = trim($_POST['sexe'] ?? '');

  header('Content-Type: application/json; charset=utf-8');

  if ($nom === '' || $prenom === '' || $ville === '' || $sexe === '') {
    echo json_encode(["success" => false, "message" => "Champs manquants"]);
    exit;
  }

  $es = new EtudiantService();
  $es->create(new Etudiant(null, $nom, $prenom, $ville, $sexe));

  echo json_encode(["success" => true, "message" => "Etudiant inséré"]);
  exit;
}

http_response_code(405);
echo "Method Not Allowed";