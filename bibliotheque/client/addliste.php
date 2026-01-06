<?php
session_start();
include '../admin/connexion.php';

if (isset($_SESSION['user_id']) && isset($_POST['id_livre'])) {
    $id_livre = (int)$_POST['id_livre'];
    $id_lecteur = $_SESSION['user_id'];
    $date = date('Y-m-d');

    $stmt = $con->prepare("INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprunt) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $id_livre, $id_lecteur, $date);
    $stmt->execute();
}
header("Location: wishlist.php"); // Redirection vers la liste
?>