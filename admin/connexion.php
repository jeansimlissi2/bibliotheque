<?php

$host = getenv('MYSQL_HOST') ?: 'o84o4skkk8000c0kkcsos4oc';
$user = getenv('MYSQL_USER') ?: 'mysql';
$pass = getenv('MYSQL_PASSWORD') ?: 'rFzwnPxDKQa9dbTjuhbGt94mqJwOaJ5erpUjU8pjqqoil58bjtdPb6Lq1XMYPino';
$dbname = getenv('MYSQL_DATABASE') ?: 'default';
$port = (int)(getenv('MYSQL_PORT') ?: 3306);

$con = new mysqli($host, $user, $pass, $dbname, $port);

if ($con->connect_error) {
    error_log("Database connection failed: " . $con->connect_error);
    die("Erreur de connexion à la base de données. Veuillez réessayer plus tard.");
}

// Support des accents
$con->set_charset("utf8mb4");
?>