<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$req = $pdo->prepare("DELETE FROM taches WHERE id = ?");
$req->execute([$id]);

header("Location: taches.php");
?>