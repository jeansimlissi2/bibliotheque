<?php
session_start();
session_destroy();
header("Location: preview.php"); // Retour à l'accueil public
exit();
?>