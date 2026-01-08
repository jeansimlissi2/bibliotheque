<?php
session_start();
include __DIR__ . '/connexion.php'; // Inclusion directe car pas de HTML

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $con->prepare("DELETE FROM livres WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: liste.php");
exit;
?>