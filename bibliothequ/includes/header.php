<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// 1. CHEMINS FICHIERS (Pour les inclusions PHP)
// Fonctionne sur Windows (\) et Linux (/)
$project_root = realpath(__DIR__ . '/../');

if (file_exists($project_root . '/admin/connexion.php')) {
    include_once $project_root . '/admin/connexion.php';
}

// 2. CHEMINS URL (Pour le CSS, les images et les liens HTML)
// Détection automatique du dossier racine du site Web
$server_root = realpath($_SERVER['DOCUMENT_ROOT']);
$web_path = str_replace('\\', '/', str_replace($server_root, '', $project_root));
$base_url = $web_path . '/'; 

// Si jamais la détection échoue (cas rares de config serveur), on force un slash
if ($base_url == '/') $base_url = '/bibliotheque/'; // Ajustez ici si nécessaire en dernier recours
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ven's_Theque</title>
    
    <link rel="stylesheet" href="<?php echo $base_url; ?>client/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header>
    <div class="brand">
        <a href="<?php echo $base_url; ?>client/index.php"><h1>Ven's<span>Theque</span></h1></a>
    </div>
    <nav class="main-nav">
        <ul>
            <li>
                <form action="<?php echo $base_url; ?>client/results.php" method="GET" style="display:flex; align-items:center;">
                    <input type="text" name="q" placeholder="Rechercher..." class="search-input">
                    <button type="submit" style="background:none; border:none; cursor:pointer; color:#003366; margin-left:-30px;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </li>

            <li><a href="<?php echo $base_url; ?>client/index.php">Accueil</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                
                <li>
                    <a href="<?php echo $base_url; ?>client/wishlist.php" class="btn-login" style="background: transparent; border-color: #28a745; color: #28a745 !important; padding: 5px 15px;">
                        <i class="fas fa-book-reader"></i> Ma Liste
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo $base_url; ?>admin/liste.php" style="color:#d63031; font-weight:bold; border: 1px solid #d63031; padding: 5px 15px; border-radius: 20px;">
                        <i class="fas fa-cogs"></i> Gestion
                    </a>
                </li>
                
                <li>
                    <span style="font-size:0.9rem; margin-right:5px; color:#555;">
                        <i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['prenom']); ?>
                    </span>
                </li>

                <li>
                    <a href="<?php echo $base_url; ?>client/logout.php" class="btn-register" style="background:#dc3545; padding: 5px 15px;">
                        Quitter
                    </a>
                </li>

            <?php else: ?>
                <li><a href="<?php echo $base_url; ?>client/login.php" class="btn-login">Connexion</a></li>
                <li><a href="<?php echo $base_url; ?>client/register.php" class="btn-register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>