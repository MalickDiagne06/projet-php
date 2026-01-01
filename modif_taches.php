<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$req = $pdo->prepare("SELECT * FROM taches WHERE id = ?");
$req->execute([$id]);
$tache = $req->fetch();

if (isset($_POST['modifier'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $statut = $_POST['statut'];

    $req = $pdo->prepare("UPDATE taches SET titre=?, description=?, statut=? WHERE id=?");
    $req->execute([$titre, $description, $statut, $id]);

    header("Location: taches.php");
}
?>

<form method="post">
    <h3>Modifier la tâche</h3>
    <input type="text" name="titre" value="<?= $tache['titre'] ?>" required><br><br>
    <textarea name="description"><?= $tache['description'] ?></textarea><br><br>
    <select name="statut">
        <option value="en cours">En cours</option>
        <option value="terminée">Terminée</option>
    </select><br><br>
    <button name="modifier">Modifier</button>
</form>
