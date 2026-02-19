<?php
include_once 'racine.php';
include_once RACINE . '/service/EtudiantService.php';

$es = new EtudiantService();
$etudiants = $es->findAll(); // must return an array of Etudiant objects
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion Etudiant</title>
  <style>
    body{font-family: Arial, sans-serif; margin:20px;}
    h2{margin-top:0;}
    form{padding:12px; border:1px solid #ddd; border-radius:8px; width:420px; max-width:100%;}
    input, select{width:100%; padding:8px; margin:6px 0; box-sizing:border-box;}
    table{border-collapse: collapse; width: 100%; margin-top:18px;}
    th, td{border:1px solid #ddd; padding:10px;}
    th{background:#f5f5f5; text-align:left;}
    .btn{padding:8px 12px; cursor:pointer; margin-right:6px;}
    .danger{color:#b00020; text-decoration:none; font-weight:600;}
    .danger:hover{ text-decoration:underline; }
    .actions{white-space:nowrap;}
  </style>
</head>

<body>
  <h2>Ajouter un étudiant</h2>

  <form action="controller/addEtudiant.php" method="post">
    <label>Nom</label>
    <input type="text" name="nom" required>

    <label>Prénom</label>
    <input type="text" name="prenom" required>

    <label>Ville</label>
    <input type="text" name="ville" required>

    <label>Sexe</label>
    <select name="sexe" required>
      <option value="M">M</option>
      <option value="F">F</option>
    </select>

    <button class="btn" type="submit">Ajouter</button>
    <button class="btn" type="reset">Vider</button>
  </form>

  <h2>Liste des étudiants</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Ville</th>
        <th>Sexe</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      <?php if (!empty($etudiants)): ?>
        <?php foreach ($etudiants as $e): ?>
          <tr>
            <td><?= htmlspecialchars($e->getId()) ?></td>
            <td><?= htmlspecialchars($e->getNom()) ?></td>
            <td><?= htmlspecialchars($e->getPrenom()) ?></td>
            <td><?= htmlspecialchars($e->getVille()) ?></td>
            <td><?= htmlspecialchars($e->getSexe()) ?></td>
            <td class="actions">
              <a class="danger"
                 href="controller/deleteEtudiant.php?id=<?= urlencode($e->getId()) ?>"
                 onclick="return confirm('Supprimer cet étudiant ?');">
                Supprimer
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="6">Aucun étudiant trouvé.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>
