<?php 
include __DIR__ . '/../includes/header.php'; 

if(!isset($_GET['id'])) { header("Location: liste.php"); exit; }
$id = (int)$_GET['id'];

// Récupération des infos actuelles
$stmt = $con->prepare("SELECT * FROM livres WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$livre = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $maison = $_POST['maison_edition'];
    $desc = $_POST['description'];
    $stock = (int)$_POST['nombre_exemplaires'];
    $annee = (int)$_POST['annee'];

    // On garde l'ancienne image par défaut
    $image_path = $livre['image_url'];

    // Si une nouvelle image est uploadée
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "images/";
        $unique_name = time() . "_" . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $unique_name)) {
            $image_path = $target_dir . $unique_name;
        }
    }

    // Mise à jour SQL complète
    $stmt_upd = $con->prepare("UPDATE livres SET titre=?, auteur=?, description=?, maison_edition=?, nombre_exemplaires=?, annee=?, image_url=? WHERE id=?");
    $stmt_upd->bind_param("ssssiisi", $titre, $auteur, $desc, $maison, $stock, $annee, $image_path, $id);
    
    if($stmt_upd->execute()) {
        echo "<script>window.location.href='liste.php?msg=Modification réussie';</script>";
    }
}
?>

<main style="display: flex; justify-content: center; padding: 40px;">
    <section class="glass-form" style="width: 100%; max-width: 600px; background: rgba(255,255,255,0.7); backdrop-filter: blur(10px); padding: 30px; border-radius: 20px;">
        <h2 style="color: #003366; margin-bottom: 20px;">Modifier : <?= htmlspecialchars($livre['titre']) ?></h2>
        
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
            <label>Titre</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required style="padding:10px; border-radius:5px; border:1px solid #ccc;">
            
            <label>Auteur</label>
            <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required style="padding:10px; border-radius:5px; border:1px solid #ccc;">
            
            <label>Maison d'édition</label>
            <input type="text" name="maison_edition" value="<?= htmlspecialchars($livre['maison_edition']) ?>" required style="padding:10px; border-radius:5px; border:1px solid #ccc;">

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:10px;">
                <div>
                    <label>Année</label>
                    <input type="number" name="annee" value="<?= $livre['annee'] ?>" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ccc;">
                </div>
                <div>
                    <label>Stock</label>
                    <input type="number" name="nombre_exemplaires" value="<?= $livre['nombre_exemplaires'] ?>" required style="width:100%; padding:10px; border-radius:5px; border:1px solid #ccc;">
                </div>
            </div>

            <label>Description</label>
            <textarea name="description" rows="5" style="padding:10px; border-radius:5px; border:1px solid #ccc;"><?= htmlspecialchars($livre['description']) ?></textarea>
            
            <label>Changer l'image (optionnel)</label>
            <input type="file" name="image">
            <small>Image actuelle : <?= htmlspecialchars($livre['image_url']) ?></small>

            <button type="submit" class="cta-button" style="border:none; cursor:pointer; margin-top:10px;">Mettre à jour</button>
            <a href="liste.php" style="text-align:center; color:#555; margin-top:10px;">Annuler</a>
        </form>
    </section>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>