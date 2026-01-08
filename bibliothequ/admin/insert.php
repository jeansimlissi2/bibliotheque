<?php
session_start();
include 'connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $con->real_escape_string($_POST['titre']);
    $auteur = $con->real_escape_string($_POST['auteur']);
    $maison = $con->real_escape_string($_POST['maison_edition']);
    $description = $con->real_escape_string($_POST['description']);
    $exemplaires = (int)$_POST['nombre_exemplaires'];
    $annee = (int)$_POST['annee'];

    // Gestion Image
    $image_path = "images/default.jpg";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/";
        // Création du dossier s'il n'existe pas
        if (!is_dir($target_dir)) mkdir($target_dir);
        
        $unique_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $unique_name;
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        }
    }

    // Requête conforme aux colonnes du PDF
    $stmt = $con->prepare("INSERT INTO livres (titre, auteur, description, maison_edition, nombre_exemplaires, annee, image_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiis", $titre, $auteur, $description, $maison, $exemplaires, $annee, $image_path);

    if ($stmt->execute()) {
        header("Location: liste.php?msg=Livre ajouté avec succès");
    } else {
        die("Erreur : " . $con->error);
    }
}
?>