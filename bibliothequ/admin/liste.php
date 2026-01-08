<?php include __DIR__ . '/../includes/header.php'; ?>

<main class="admin-container" style="padding: 40px 5%;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 class="section-title">Gestion du Catalogue</h2>
        <a href="form_ajout.php" class="cta-button" style="background: #28a745;">+ Ajouter un livre</a>
    </div>

    <?php if(isset($_GET['msg'])): ?>
        <p style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            <?= htmlspecialchars($_GET['msg']) ?>
        </p>
    <?php endif; ?>

    <div class="table-wrapper" style="background: rgba(255,255,255,0.8); padding: 20px; border-radius: 15px;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #003366; color: white; text-align: left;">
                    <th style="padding: 10px;">Couverture</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Éditeur</th>
                    <th>Stock</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $con->query("SELECT * FROM livres ORDER BY id DESC");
                while($row = $res->fetch_assoc()): ?>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;">
                        <img src="<?= htmlspecialchars($row['image_url']) ?>" width="50" style="border-radius: 4px;">
                    </td>
                    <td><strong><?= htmlspecialchars($row['titre']) ?></strong></td>
                    <td><?= htmlspecialchars($row['auteur']) ?></td>
                    <td><?= htmlspecialchars($row['maison_edition']) ?></td>
                    <td><?= $row['nombre_exemplaires'] ?></td>
                    <td style="text-align: center;">
                        <a href="edite.php?id=<?= $row['id'] ?>" style="color: #007bff; margin-right: 10px; font-weight: bold;">Modifier</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" style="color: #dc3545; font-weight: bold;" onclick="return confirm('Supprimer définitivement ?')">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>