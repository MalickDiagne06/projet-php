<?php
session_start();
include "db.php";

if (isset($_POST['titre'])) {
    $req = $pdo->prepare("INSERT INTO taches VALUES (NULL, ?, ?, 'en cours', ?)");
    $req->execute([
        $_POST['titre'],
        $_POST['description'],
        $_SESSION['user']['id']
    ]);
    header("Location: taches.php");
}
?>

<form method="post">
    <input type="text" name="titre" placeholder="Titre" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <button>Ajouter</button>
</form>
