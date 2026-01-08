<?php include __DIR__ . '/../includes/header.php'; 
$query = isset($_GET['q']) ? $con->real_escape_string($_GET['q']) : '';
?>

<main style="padding: 40px 5%;">
    <h2 class="section-title">Résultats pour "<?= htmlspecialchars($query); ?>"</h2>
    
    <div class="books-grid" style="display: flex; flex-wrap: wrap; gap: 20px; overflow: visible;">
    <?php
    if ($query) {
        $sql = "SELECT * FROM livres WHERE titre LIKE '%$query%' OR auteur LIKE '%$query%'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while($book = $result->fetch_assoc()) {
                ?>
                <div class="book-card" style="width: 200px; height: auto;">
                    <img src="../admin/<?= htmlspecialchars($book['image_url']) ?>" class="book-cover">
                    <div class="book-info">
                        <div class="book-title"><?= htmlspecialchars($book['titre']) ?></div>
                        <div style="font-size: 0.9em; color: #555;"><?= htmlspecialchars($book['auteur']) ?></div>
                        <a href="detail.php?id=<?= $book['id'] ?>" class="btn-details" style="margin-top: 10px;">Voir</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Aucun livre trouvé correspondant à votre recherche.</p>";
        }
    } else {
        echo "<p>Veuillez entrer un terme de recherche.</p>";
    }
    ?>
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>