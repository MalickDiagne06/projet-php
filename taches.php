<?php
session_start();
include "db.php";

$user = $_SESSION['user'];

if ($user['role'] == 'admin') {
    $req = $pdo->query("SELECT * FROM taches");
} else {
    $req = $pdo->prepare("SELECT * FROM taches WHERE user_id=?");
    $req->execute([$user['id']]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Liste des tâches</h3>
    <a href="ajouter_tache.php" class="btn btn-primary">Ajouter</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Titre</th>
            <th>Description</th>
            <th>Statut</th>
        </tr>

        <?php while($t = $req->fetch()) { ?>
        <tr>
            <td><?= $t['titre'] ?></td>
            <td><?= $t['description'] ?></td>
            <td><?= $t['statut'] ?></td>
        </tr>
        <td>
            <a href="modif_taches.php?id=<?= $t['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
            <a href="supprimer_taches.php?id=<?= $t['id'] ?>" 
                class="btn btn-danger btn-sm"
                onclick="return confirm('Supprimer cette tâche ?')">🗑</a>
            </td>

        <?php } ?>
    </table>
</div>
</body>
</html>
