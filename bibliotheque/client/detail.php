<?php 
include __DIR__ . '/../includes/header.php'; 

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $con->prepare("SELECT * FROM livres WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$livre = $stmt->get_result()->fetch_assoc();

if (!$livre):
    echo "<p>Livre introuvable.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit;
endif;
?>

<main class="detail-container" style="max-width: 1000px; margin: 40px auto; padding: 20px;">
    <div class="detail-grid" style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px; background: rgba(255,255,255,0.7); padding: 30px; border-radius: 20px; backdrop-filter: blur(10px);">
        <div class="detail-image">
            <img src="../admin/<?php echo htmlspecialchars($livre['image_url']); ?>" style="width: 100%; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        </div>
        <div class="detail-text">
            <h1 style="color: #002244;"><?php echo htmlspecialchars($livre['titre']); ?></h1>
            <p style="font-size: 1.2rem; color: #555;">Par <strong><?php echo htmlspecialchars($livre['auteur']); ?></strong></p>
            <hr style="margin: 20px 0; border: 0; border-top: 1px solid #ddd;">
            <h3>Résumé</h3>
            <p style="line-height: 1.8; color: #333;"><?php echo nl2br(htmlspecialchars($livre['description'])); ?></p>
            <p style="margin-top: 20px;"><strong>Éditeur :</strong> <?php echo htmlspecialchars($livre['maison_edition']); ?> (<?php echo $livre['annee']; ?>)</p>
            
            <div style="margin-top: 30px;">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <form action="addliste.php" method="POST">
                        <input type="hidden" name="id_livre" value="<?php echo $id; ?>">
                        <button type="submit" class="cta-button" style="border:none; cursor:pointer;">Ajouter à ma liste de lecture</button>
                    </form>
                <?php else: ?>
                    <p style="background: #fff3cd; padding: 15px; border-radius: 8px; border: 1px solid #ffeeba;">
                        <a href="login.php">Connectez-vous</a> pour ajouter ce livre à votre liste.
                    </p>
                <?php endif; ?>
            </div>
            <a href="index.php" style="display:inline-block; margin-top: 20px; color: #003366;">← Retour à la bibliothèque</a>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>