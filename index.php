<?php
session_start();
include "db.php";

if (isset($_POST['login'])) {
    $login = $_POST['login'];
    $mdp = $_POST['password'];

    $req = $pdo->prepare("SELECT * FROM users WHERE login=? AND motdepasse=?");
    $req->execute([$login, $mdp]);

    if ($user = $req->fetch()) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        $erreur = "Login ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-4 mx-auto">
        <h3 class="text-center">Connexion</h3>
        <?php if(isset($erreur)) echo "<div class='alert alert-danger'>$erreur</div>"; ?>
        <form method="post">
            <input type="text" name="login" class="form-control mb-2" placeholder="Login" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Mot de passe" required>
            <button class="btn btn-primary w-100">Se connecter</button>
        </form>
    </div>
</div>
</body>
</html>
