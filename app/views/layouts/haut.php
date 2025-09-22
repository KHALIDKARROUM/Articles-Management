<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="<?= BASE_PATH_SERVER ?>/public/css/style.css"/>
    <script type="text/javascript" src="<?= BASE_PATH_SERVER ?>/public/js/script.js"></script>
    <style>
        body {
            <?php if (isset($_COOKIE['background_color'])): ?>
                background-color: <?php echo $_COOKIE['background_color']; ?>;
            <?php else: ?>
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            <?php endif; ?>
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        /* Layout for top section */
        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            flex-wrap: wrap;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            margin: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .left-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .small-image {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }
        
        .small-image:hover {
            transform: scale(1.05);
        }
        
        .text-content {
            display: flex;
            flex-direction: column;
        }
        
        .large-text {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .small-text {
            font-size: 14px;
            color: #7f8c8d;
            font-style: italic;
            font-weight: 400;
        }
        
        .right-content {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }
        
        .user-info {
            font-size: 14px;
            color: #34495e;
            font-weight: 500;
            padding: 8px 16px;
            background: rgba(52, 73, 94, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(5px);
        }
        
        .user-info a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .user-info a:hover {
            color: #2980b9;
            text-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }
        
        .top-nav {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: center;
            margin: 0 30px;
        }
        
        .nav-buttons {
            display: flex;
            gap: 20px;
            align-items: center;
            flex-wrap: wrap;
            background: rgba(255, 255, 255, 0.5);
            padding: 15px 25px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .nav-button {
            padding: 12px 24px;
            text-decoration: none;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 2px solid rgba(52, 73, 94, 0.1);
            border-radius: 15px;
            color: #2c3e50;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        
        .nav-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }
        
        .nav-button:hover::before {
            left: 100%;
        }
        
        .nav-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .nav-button.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
        }
        
        .login-btn {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            border-color: transparent;
        }
        
        .login-btn:hover {
            background: linear-gradient(135deg, #229954 0%, #27ae60 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
        }
        
        /* Date styling */
        h4 {
            text-align: center;
            color: #2c3e50;
            font-size: 18px;
            font-weight: 500;
            margin: 30px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            backdrop-filter: blur(10px);
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .top {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
                margin: 10px;
            }
            
            .nav-buttons {
                justify-content: center;
                margin: 0;
                padding: 10px 15px;
            }
            
            .nav-button {
                padding: 10px 16px;
                font-size: 13px;
            }
            
            .large-text {
                font-size: 24px;
            }
            
            .right-content {
                align-items: center;
            }
        }
    </style>
</head>
<body>
<div class="top">
    <div class="left-content">
        <img src='<?= BASE_PATH_SERVER ?>/public/images/loogo.jpg' class="small-image image-margin"/>
        <div class="text-content">
            <span class="large-text">Articles Management</span>
            <span class="small-text">Discoveries that matter, ideas that shine</span>
        </div>
    </div>
    
    <!-- Navigation Menu - Centered -->
    <nav class="top-nav">
        <div class="nav-buttons">
            <?php if (!isset($_SESSION["login"])): ?>
                <a href="<?= BASE_PATH_SERVER ?>/index.php/login" class="nav-button login-btn">
                    🔐 Authentification
                </a>
            <?php else: ?>
                <a href="<?= BASE_PATH_SERVER ?>/index.php" class="nav-button <?= ($request == '' || $request == 'accueil') ? 'active' : '' ?>">
                    Accueil
                </a>
                <a href="<?= BASE_PATH_SERVER ?>/index.php/article" class="nav-button <?= ($request == 'article') ? 'active' : '' ?>">
                    Articles
                </a>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <a href="<?= BASE_PATH_SERVER ?>/index.php/user" class="nav-button <?= ($request == 'user') ? 'active' : '' ?>">
                        Utilisateurs
                    </a>
                    <a href="<?= BASE_PATH_SERVER ?>/index.php/category" class="nav-button <?= ($request == 'category') ? 'active' : '' ?>">
                        Catégories
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </nav>
    
    <!-- User info at top right -->
    <div class="right-content">
        <div class="user-info">
            <?php if (isset($_SESSION['user'])): ?>
                Bienvenue <?= $_SESSION['user']['nom'] ?> | 
                <a href="index.php/logout">Déconnexion</a>
            <?php else: ?>
                Non Connecté
            <?php endif; ?>
            ||
            <a href="<?= BASE_PATH_SERVER ?>/index.php/options">Options</a>
        </div>
    </div>
</div>

<h4>
    <?php 
    // Solution de repli si la fonction n'existe pas
    if (function_exists('afficherDate')) {
        echo htmlspecialchars(afficherDate($_COOKIE['language'] ?? 'FR'));
    } else {
        echo htmlspecialchars(date('l j F Y')); // Format similaire en anglais
        error_log("Warning: fonction afficherDate() non trouvée");
    }
    ?>
</h4>

<br />

</body>
</html>