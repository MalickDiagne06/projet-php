<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">

            <h3 class="text-center mb-4">
                Bienvenue <strong><?= $user['nom'] ?></strong>
            </h3>

            <p class="text-center">
                Rôle : 
                <span class="badge bg-info text-dark">
                    <?= strtoupper($user['role']) ?>
                </span>
            </p>

            <div class="d-grid gap-2 col-6 mx-auto mt-4">

                <a href="taches.php" class="btn btn-success">
                    📋 Gérer mes tâches
                </a>

                <?php if ($user['role'] == 'admin') { ?>
                    <a href="utilisateurs.php" class="btn btn-warning">
                        👥 Gestion des utilisateurs
                    </a>
                <?php } ?>

                <a href="logout.php" class="btn btn-danger">
                    🚪 Déconnexion
                </a>

            </div>
        </div>
    </div>
</div>

</body>
</html>
