<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bibliotheque"; // Assurez-vous que c'est le bon nom de BDD

$con = new mysqli($host, $user, $pass, $dbname);

if ($con->connect_error) {
    die("Échec de la connexion : " . $con->connect_error);
}

// Support des accents
$con->set_charset("utf8mb4");
?>