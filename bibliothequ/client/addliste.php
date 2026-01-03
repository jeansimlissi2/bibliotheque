<?php
session_start();
include '../admin/connexion.php';

if (isset($_SESSION['user_id']) && isset($_POST['id_livre'])) {
    $id_livre = (int)$_POST['id_livre'];
    $id_lecteur = $_SESSION['user_id'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO liste_lecture (id_livre, id_lecteur, date_emprunt) VALUES ($id_livre, $id_lecteur, '$date')";
    $con->query($sql);
}
header("Location: wishlist.php"); // Redirection vers la liste
?>