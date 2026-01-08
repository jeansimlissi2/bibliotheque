<?php 
// Page d'accueil publique (Landing Page)
$base_url = "/bibliotheque/";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue | VenTheque</title>
    <link rel="stylesheet" href="index.css">
    <style>
        /* Surcharge pour la page Preview uniquement */
        body {
            /* Centrage parfait flexbox */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px; /* Marge de sécurité pour petits écrans */
        }

        .preview-container {
            /* Design "Carte Bijou" */
            background: rgba(255, 255, 255, 0.7); /* Un peu plus lumineux */
            backdrop-filter: blur(25px); /* Flou intense */
            -webkit-backdrop-filter: blur(25px);
            
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 35px; /* Arrondis prononcés */
            
            /* Ombre portée plus diffuse pour l'effet lévitation */
            box-shadow: 0 30px 60px -10px rgba(0, 34, 68, 0.25),
                        inset 0 0 20px rgba(255, 255, 255, 0.5); 
            
            max-width: 700px; /* Largeur réduite pour plus d'élégance */
            width: 100%;
            padding: 50px; /* Padding ajusté */
            text-align: center;
            
            /* Animation d'entrée */
            animation: floatUp 1s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        @keyframes floatUp {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Titre Principal */
        .brand-title {
            font-size: 3rem; /* Légèrement réduit pour l'équilibre */
            margin-bottom: 5px;
            color: #002244;
            font-weight: 900;
            letter-spacing: -1px;
            text-shadow: 0 2px 15px rgba(255,255,255,0.8);
        }
        .brand-title span { color: #28a745; }

        .subtitle {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 35px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.9rem;
        }

        /* Mise en forme du texte */
        .content-text {
            text-align: left;
            line-height: 1.7;
            color: #2c3e50;
            margin-bottom: 35px;
        }
        .content-text p {
            margin-bottom: 15px;
            font-size: 1rem;
        }
        
        /* Boite de mise en avant verte - Plus subtile */
        .highlight-box {
            background: linear-gradient(to right, rgba(40, 167, 69, 0.05), transparent);
            border-left: 3px solid #28a745;
            padding: 15px 20px;
            border-radius: 0 10px 10px 0;
            margin: 25px 0;
            font-size: 0.95rem;
            color: #003300;
        }

        /* Boutons */
        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-primary {
            background: #28a745;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            box-shadow: 0 8px 20px rgba(40,167,69,0.3);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(40,167,69,0.4);
            background: #218838;
        }

        .cta-secondary {
            background: transparent;
            color: #003366;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            border: 2px solid #003366;
            transition: all 0.2s;
        }
        .cta-secondary:hover {
            background: #003366;
            color: white;
            transform: translateY(-2px);
        }
        
        /* Ajustements Responsive */
        @media (max-width: 768px) {
            .preview-container { padding: 30px 20px; }
            .brand-title { font-size: 2.2rem; }
            .content-text { text-align: center; }
            .highlight-box { text-align: left; }
        }
    </style>
</head>
<body>

    <div class="preview-container">
        <h1 class="brand-title">Ven's<span>Theque</span></h1>
        <div class="subtitle">Bibliothèque Numérique</div>
        
        <div class="content-text">
            <p>
                <strong>Ven's_Theque</strong> est une bibliothèque moderne dédiée aux passionnés. 
                Romans, essais, sciences, histoire... notre collection de milliers de livres n'attend que vous.
            </p>
            
            <div class="highlight-box">
                <p style="margin:0;">
                    <strong>Pour accéder au catalogue complet et emprunter des livres, 
                    l'inscription est requise.</strong><br>
                    C'est gratuit, rapide, et cela vous ouvre les portes d'un univers infini.
                </p>
            </div>

            <p>
                Lecteur occasionnel ou bibliophile averti, connectez-vous dès maintenant 
                pour commencer l'aventure.
            </p>
        </div>

        <div class="actions">
            <a href="register.php" class="cta-primary">
                Créer un compte
            </a>
            <a href="login.php" class="cta-secondary">
                Se connecter
            </a>
        </div>
    </div>

</body>
</html>