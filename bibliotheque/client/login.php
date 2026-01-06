<?php 
include __DIR__ . '/../includes/header.php'; 

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $con->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // Utilisation d'une requête préparée pour la sécurité
    $stmt = $con->prepare("SELECT id, nom, prenom, password FROM lecteurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['nom'] = $row['nom'];
            $_SESSION['prenom'] = $row['prenom'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Mot de passe incorrect.";
        }
    } else {
        $error = "Email inconnu.";
    }
}
?>

<main style="display: flex; justify-content: center; align-items: center; min-height: 80vh;">
    <section style="width: 100%; max-width: 450px; background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(10px); padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid rgba(255, 255, 255, 0.3);">
        <h2 class="section-title" style="border-left: 5px solid #003366; margin-bottom: 25px;">Connexion</h2>
        
        <?php if($error): ?>
            <p style="color: #d93025; background: rgba(217, 48, 37, 0.1); padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
                <?php echo $error; ?>
            </p>
        <?php endif; ?>

        <form method="POST" style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; background: rgba(255,255,255,0.8);">
            </div>
            <div>
                <label style="display: block; margin-bottom: 5px; font-weight: 600;">Mot de passe</label>
                <input type="password" name="password" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc; background: rgba(255,255,255,0.8);">
            </div>
            <button type="submit" class="cta-button" style="border: none; cursor: pointer; width: 100%; margin-top: 10px;">Se connecter</button>
        </form>
        
        <p style="text-align: center; margin-top: 20px;">
            Pas encore inscrit ? <a href="register.php" style="color: #003366; font-weight: bold;">Créer un compte</a>
        </p>
    </section>
</main>

<?php include __DIR__ . '/../includes/footer.php'; ?>