<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
   <section>    

     <h2>Ajouter un livre</h2>
    <form action="insert.php" method="POST" enctype="multipart/form-data">
    
    <label for="auteur">Auteur</label> <br>
    <input type="text" id="auteur" name="auteur" required> <br>

    <label for="titre">Titre</label> <br>
    <input type="text" id="titre" name="titre" required> <br>

    <label for="description">Description</label> <br>
    <textarea id="description" name="description" required></textarea> <br>

    <label for="nombre_exemplaires">Nombre d'Exemplaires</label> <br>
    <input type="number" id="nombre_exemplaires" name="nombre_exemplaires" required> <br><br>

    <label for="annee">Année de Publication</label> <br>
    <input type="number" id="annee" name="annee" required> <br><br>

    <label>Maison d'édition</label>
    <input type="text" name="maison_edition" required><br>

    <label for="image">Image URL</label> <br>
    <input type="file" id="image" name="image" required> <br><br>

    <button type="submit">Enregistrer</button>
</form>

   </section>
   
</body>

</html>

