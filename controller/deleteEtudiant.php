<?php
include_once '../racine.php';
include_once RACINE . '/service/EtudiantService.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) {
  header("location:../index.php");
  exit;
}

$es = new EtudiantService();
$etd = $es->findById($id);
if ($etd) $es->delete($etd);

header("location:../index.php");
