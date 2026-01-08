<?php
session_start();
include __DIR__ . '/../admin/connexion.php';

// Sécurité : Redirection si non connecté
if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit(); 
}

$id_lecteur = $_SESSION['user_id'];

// --- ACTION 1 : RENDRE UN LIVRE ---
if (isset($_GET['return'])) {
    $id_livre_retour = (int)$_GET['return'];
    $date_jour = date('Y-m-d');
    $stmt = $con->prepare("UPDATE liste_lecture SET date_retour = ? WHERE id_livre = ? AND id_lecteur = ? AND date_retour IS NULL");
    $stmt->bind_param("sii", $date_jour, $id_livre_retour, $id_lecteur);
    if($stmt->execute()) {
        header("Location: wishlist.php?msg=returned");
        exit;
    }
}

// --- ACTION 2 : ANNULER/SUPPRIMER ---
if (isset($_GET['del'])) {
    $id_del = (int)$_GET['del'];
    $stmt = $con->prepare("DELETE FROM liste_lecture WHERE id_livre = ? AND id_lecteur = ? AND date_retour IS NULL");
    $stmt->bind_param("ii", $id_del, $id_lecteur);
    $stmt->execute();
    header("Location: wishlist.php");
    exit;
}
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<main style="padding: 40px 5%; text-align: center;">

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'returned'): ?>
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 30px; border: 1px solid #c3e6cb; display: inline-block;">
            <i class="fas fa-check-circle"></i> Livre rendu avec succès !
        </div>
        <br>
    <?php endif; ?>

    <h2 class="section-title" style="text-align: left; width: 85%; margin: 0 auto 20px auto;">Lectures en cours</h2>
    
    <div class="table-wrapper" style="background: rgba(255,255,255,0.8); border-radius: 15px; padding: 20px; margin: 0 auto 50px auto; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 85%; text-align: left;">
        <?php
        $sql_cours = "SELECT livres.id, livres.titre, livres.auteur, livres.image_url, liste_lecture.date_emprunt 
                      FROM livres 
                      JOIN liste_lecture ON livres.id = liste_lecture.id_livre 
                      WHERE liste_lecture.id_lecteur = $id_lecteur 
                      AND liste_lecture.date_retour IS NULL
                      ORDER BY liste_lecture.date_emprunt DESC";
        
        $result_cours = $con->query($sql_cours);

        if ($result_cours->num_rows > 0): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #28a745;">
                        <th style="padding:10px;">Livre</th>
                        <th>Détails</th>
                        <th>Emprunté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result_cours->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;">
                            <img src="../admin/<?= htmlspecialchars($row['image_url']) ?>" width="60" style="border-radius:4px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        </td>
                        <td style="padding-right: 20px;">
                            <strong style="font-size: 1.1rem;"><?= htmlspecialchars($row['titre']) ?></strong><br>
                            <span style="color:#666;"><?= htmlspecialchars($row['auteur']) ?></span>
                        </td>
                        <td style="padding-right: 20px;">
                            <span style="background: #fff3cd; color: #856404; padding: 5px 10px; border-radius: 15px; font-size: 0.9rem;">
                                <?= date("d/m/Y", strtotime($row['date_emprunt'])) ?>
                            </span>
                        </td>
                        <td style="display: flex; gap: 10px; align-items: center; padding-top: 20px;">
                            <a href="wishlist.php?return=<?= $row['id'] ?>" class="cta-button" style="background: #28a745; font-size: 0.9rem; padding: 8px 15px;">
                                <i class="fas fa-check"></i> Rendre
                            </a>
                            <a href="wishlist.php?del=<?= $row['id'] ?>" style="color: #d63031; text-decoration: none; font-size: 0.85rem;" onclick="return confirm('Supprimer définitivement de la liste ?')">
                                <i class="fas fa-trash"></i> Annuler
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align:center; padding: 20px; color: #666;">Aucun livre en cours de lecture.</p>
            <div style="text-align:center;"><a href="index.php" class="cta-button" style="background:#003366;">Emprunter un livre</a></div>
        <?php endif; ?>
    </div>


    <h2 class="section-title" style="border-left-color: #003366; text-align: left; width: 85%; margin: 0 auto 20px auto;">Historique</h2>
    
    <div class="table-wrapper" style="background: rgba(255,255,255,0.6); border-radius: 15px; padding: 20px; margin: 0 auto; width: 85%; text-align: left;">
        <?php
        $sql_hist = "SELECT livres.id, livres.titre, livres.auteur, livres.image_url, 
                            liste_lecture.date_emprunt, liste_lecture.date_retour 
                     FROM livres 
                     JOIN liste_lecture ON livres.id = liste_lecture.id_livre 
                     WHERE liste_lecture.id_lecteur = $id_lecteur 
                     AND liste_lecture.date_retour IS NOT NULL
                     ORDER BY liste_lecture.date_retour DESC";
        
        $result_hist = $con->query($sql_hist);

        if ($result_hist->num_rows > 0): ?>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; border-bottom: 2px solid #003366; color: #555;">
                        <th style="padding:10px;">Livre</th>
                        <th>Infos</th>
                        <th>Emprunt</th>
                        <th>Retour</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $result_hist->fetch_assoc()): ?>
                    <tr style="border-bottom: 1px solid #eee; background: rgba(0,0,0,0.02);">
                        <td style="padding: 10px;">
                            <img src="../admin/<?= htmlspecialchars($row['image_url']) ?>" width="40" style="border-radius:4px; filter: grayscale(80%); opacity: 0.7;">
                        </td>
                        <td style="padding-right: 20px;">
                            <strong style="color: #555;"><?= htmlspecialchars($row['titre']) ?></strong><br>
                            <small><?= htmlspecialchars($row['auteur']) ?></small>
                        </td>
                        <td style="color: #666; font-size: 0.9rem; padding-right: 20px;">
                            <?= date("d/m/Y", strtotime($row['date_emprunt'])) ?>
                        </td>
                        <td style="color: #003366; font-weight: bold; font-size: 0.9rem; padding-right: 20px;">
                            <?= date("d/m/Y", strtotime($row['date_retour'])) ?>
                        </td>
                        <td>
                            <span style="background: #dfe6e9; color: #636e72; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: bold;">
                                RENDU
                            </span>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align:center; padding: 20px; color: #888; font-style: italic;">Votre historique est vide.</p>
        <?php endif; ?>
    </div>

</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>