<?php
session_start();
include "db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['ajouter'])) {

    $nom = $_POST['nom'];
    $login = $_POST['login'];
    $mdp = sha1($_POST['motdepasse']);
    $role = $_POST['role'];

    $req = $pdo->prepare("INSERT INTO users (nom, login, motdepasse, role) VALUES (?, ?, ?, ?)");
    $req->execute([$nom, $login, $mdp, $role]);

    header("Location: utilisateurs.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center">➕ Ajouter un utilisateur</h3>

    <form method="post" class="card p-4 shadow">
        <input type="text" name="nom" class="form-control mb-2" placeholder="Nom complet" required>

        <input type="text" name="login" class="form-control mb-2" placeholder="Login" required>

        <input type="password" name="motdepasse" class="form-control mb-2" placeholder="Mot de passe" required>

        <select name="role" class="form-control mb-3">
            <option value="user">Utilisateur</option>
            <option value="admin">Administrateur</option>
        </select>

        <button name="ajouter" class="btn btn-success w-100">
            Ajouter l'utilisateur
        </button>
    </form>
</div>

</body>
</html>
