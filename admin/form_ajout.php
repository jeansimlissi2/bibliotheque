<?php include __DIR__ . '/../includes/header.php'; ?>

<main style="display: flex; justify-content: center; padding: 40px;">
    <section class="glass-form" style="width: 100%; max-width: 600px; background: rgba(255,255,255,0.6); backdrop-filter: blur(10px); padding: 30px; border-radius: 20px; border: 1px solid white;">
        <h2 style="color: #003366; margin-bottom: 20px; border-left: 5px solid #28a745; padding-left: 10px;">Ajouter un nouveau livre</h2>
        
        <form action="insert.php" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
            
            <input type="text" name="titre" placeholder="Titre du livre" required style="padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
            <input type="text" name="auteur" placeholder="Auteur" required style="padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
            <input type="text" name="maison_edition" placeholder="Maison d'édition" required style="padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <input type="number" name="annee" placeholder="Année" required style="padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
                <input type="number" name="nombre_exemplaires" placeholder="Nombre d'exemplaires" required style="padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
            </div>

            <textarea name="description" placeholder="Résumé du livre..." rows="4" required style="padding: 12px; border-radius: 8px; border: 1px solid #ccc;"></textarea>
            
            <label>Image de couverture :</label>
            <input type="file" name="image" required style="background: white; padding: 10px; border-radius: 8px;">

            <button type="submit" class="cta-button" style="border:none; cursor:pointer; margin-top: 10px;">Enregistrer le livre</button>
        </form>
    </section>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>