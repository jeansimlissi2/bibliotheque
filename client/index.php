<?php 
include __DIR__ . '/../includes/header.php'; 

// REQUÊTE 1 : Les 4 derniers livres ajoutés (Section Nouveautés)
$sql_new = "SELECT * FROM livres ORDER BY id DESC LIMIT 4";
$res_new = $con->query($sql_new);

// REQUÊTE 2 : Tout le catalogue (Section Principale)
// On exclut les 4 derniers pour ne pas faire de doublon visuel immédiat, ou on affiche tout.
// Ici on affiche tout le catalogue classé par Titre.
$sql_all = "SELECT * FROM livres ORDER BY titre ASC";
$res_all = $con->query($sql_all);
?>

<section class="hero">
    <div class="hero-content">
        <h2>Explorez un monde de connaissances.</h2>
        <p>Bibliothèque numérique moderne. Gérez vos lectures, découvrez des classiques et évadez-vous.</p>
        <a href="#catalogue" class="cta-button">Accéder au catalogue</a>
    </div>
    <div class="hero-image">
        <img src="../admin/images/pic2.jpg" alt="Bibliothèque Design"> 
    </div>
</section>

<h3 class="section-title">Nouveautés</h3>
<div class="catalogue-grid">
    <?php while($book = $res_new->fetch_assoc()): ?>
        <div class="book-card">
            <div class="badge-new">Nouveau</div>
            
            <div class="book-cover-container">
                <img src="../admin/<?= htmlspecialchars($book['image_url']) ?>" class="book-cover" alt="Couverture">
            </div>
            <div class="book-info">
                <div>
                    <div class="book-title"><?= htmlspecialchars($book['titre']) ?></div>
                    <div class="book-author"><?= htmlspecialchars($book['auteur']) ?></div>
                </div>
                <a href="detail.php?id=<?= $book['id'] ?>" class="btn-details">Voir le livre</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<h3 class="section-title" id="catalogue">Nos ouvrages</h3>
<div class="catalogue-grid">
    <?php 
    // On remet le pointeur au début si besoin ou on utilise la 2ème requête
    while($book = $res_all->fetch_assoc()): 
    ?>
        <div class="book-card">
            <div class="book-cover-container">
                <img src="../admin/<?= htmlspecialchars($book['image_url']) ?>" class="book-cover" alt="Couverture">
            </div>
            <div class="book-info">
                <div>
                    <div class="book-title"><?= htmlspecialchars($book['titre']) ?></div>
                    <div class="book-author"><?= htmlspecialchars($book['auteur']) ?></div>
                </div>
                <a href="detail.php?id=<?= $book['id'] ?>" class="btn-details">Détails</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<div style="height: 50px;"></div>

<?php include __DIR__ . '/../includes/footer.php'; ?>