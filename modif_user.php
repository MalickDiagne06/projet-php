<?php
session_start();
include "db.php";

if ($_SESSION['user']['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$req = $pdo->prepare("SELECT * FROM users WHERE id=?");
$req->execute([$id]);
$user = $req->fetch();

if (isset($_POST['modifier'])) {
    $nom = $_POST['nom'];
    $login = $_POST['login'];
    $role = $_POST['role'];

    $req = $pdo->prepare("UPDATE users SET nom=?, login=?, role=? WHERE id=?");
    $req->execute([$nom, $login, $role, $id]);

    header("Location: utilisateurs.php");
}
?>

<h3>Modifier utilisateur</h3>

<form method="post">
    <input type="text" name="nom" value="<?= $user['nom'] ?>" required><br><br>
    <input type="text" name="login" value="<?= $user['login'] ?>" required><br><br>

    <select name="role">
        <option value="admin">Admin</option>
        <option value="user">Utilisateur</option>
    </select><br><br>

    <button name="modifier">Modifier</button>
</form>
