<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(405);
  echo json_encode(["success" => false, "message" => "Method Not Allowed"]);
  exit;
}

include_once '../racine.php';
include_once RACINE . '/service/EtudiantService.php';
include_once RACINE . '/classes/Etudiant.php'; // adjust path if needed

// Read JSON body
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// If JSON invalid
if (!is_array($data)) {
  http_response_code(400);
  echo json_encode(["success" => false, "message" => "JSON invalide", "raw" => $raw]);
  exit;
}

$nom    = trim($data['nom'] ?? '');
$prenom = trim($data['prenom'] ?? '');
$ville  = trim($data['ville'] ?? '');
$sexe   = trim($data['sexe'] ?? '');

if ($nom === '' || $prenom === '' || $ville === '' || $sexe === '') {
  http_response_code(422);
  echo json_encode([
    "success" => false,
    "message" => "Champs manquants",
    "received" => $data
  ]);
  exit;
}

try {
  $es = new EtudiantService();
  $es->create(new Etudiant(null, $nom, $prenom, $ville, $sexe));

  echo json_encode(["success" => true, "message" => "Etudiant inséré"]);
} catch (Exception $ex) {
  http_response_code(500);
  echo json_encode(["success" => false, "message" => "Erreur serveur", "error" => $ex->getMessage()]);
}
