<?php 
include __DIR__ . '/../includes/header.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $con->real_escape_string($_POST['nom']);
    $prenom = $con->real_escape_string($_POST['prenom']);
    $email = $con->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Utilisation d'une requête préparée
    $stmt = $con->prepare("INSERT INTO lecteurs (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $prenom, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php?msg=registered");
        exit();
    } else {
        $error = "Erreur lors de l'inscription : " . $con->error;
    }
}
?>

<main style="display: flex; justify-content: center; align-items: center; min-height: 80vh; padding: 20px;">
    <section style="width: 100%; max-width: 500px; background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(10px); padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid rgba(255, 255, 255, 0.3);">
        <h2 class="section-title" style="border-left: 5px solid #28a745; margin-bottom: 25px;">Inscription</h2>
        
        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nom</label>
                    <input type="text" name="nom" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; background: rgba(255,255,255,0.8);">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 5px; font-weight: 600;">Prénom</label>
                    <input type="text" name="prenom" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; background: rgba(255,255,255,0.8);">
                </div>
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; background: rgba(255,255,255,0.8);">
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Mot de passe</label>
                <input type="password" name="password" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; background: rgba(255,255,255,0.8);">
            </div>
            <button type="submit" class="cta-button" style="border: none; cursor: pointer; width: 100%; background: #28a745; margin-top: 10px;">Créer mon compte</button>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            Déjà membre ? <a href="login.php" style="color: #003366; font-weight: bold;">Se connecter</a>
        </p>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>