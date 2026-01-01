<?php
session_start();
include "db.php";

if ($_SESSION['user']['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

$users = $pdo->query("SELECT * FROM users");
?>

<h3>Gestion des utilisateurs</h3>

<a href="ajout_user.php" class="btn btn-success mb-3">➕ Ajouter utilisateur</a>

<table class="table table-bordered">
<tr>
    <th>Nom</th>
    <th>Login</th>
    <th>Rôle</th>
    <th>Actions</th>
</tr>

<?php while($u = $users->fetch()) { ?>
<tr>
    <td><?= $u['nom'] ?></td>
    <td><?= $u['login'] ?></td>
    <td><?= $u['role'] ?></td>
    <td>
        <a href="modif_user.php?id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
        <a href="supprimer_user.php?id=<?= $u['id'] ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Supprimer cet utilisateur ?')">🗑</a>
    </td>
</tr>
<?php } ?>
</table>
