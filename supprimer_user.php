<?php
session_start();
include "db.php";

if ($_SESSION['user']['role'] != 'admin') {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

$req = $pdo->prepare("DELETE FROM users WHERE id=?");
$req->execute([$id]);

header("Location: utilisateurs.php");
?>