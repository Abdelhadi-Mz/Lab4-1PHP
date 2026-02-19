<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include_once '../racine.php';
  include_once RACINE . '/service/EtudiantService.php';

  $es = new EtudiantService();
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($es->findAllApi());
  exit;
}

http_response_code(405);
echo "Method Not Allowed";