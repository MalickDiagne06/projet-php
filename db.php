<?php
$host = "localhost";
$dbname = "gestion_tache";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    die("Erreur connexion : " . $e->getMessage());
}
?>
