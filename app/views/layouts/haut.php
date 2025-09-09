<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="<?= BASE_PATH_SERVER ?>/public/css/style.css"/>
    <script type="text/javascript" src="<?= BASE_PATH_SERVER ?>/public/js/script.js"></script>
    <style body {
        <?php if (isset($_COOKIE['background_color'])): ?>
            background-color: <?php echo $_COOKIE['background_color']; ?>;
        <?php endif; ?>
        }>
    </style>
    
</head>
<body>
<div class="top">
    <img src='<?= BASE_PATH_SERVER ?>/public/images/loogo.jpg' class="small-image image-margin"/>
    <span class="large-text">Articles Management</span><br/>
    <span class="small-text">Discoveries that matter, ideas that shine</span>
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
<div align="right">
    <?php if (isset($_SESSION['user'])): ?>
        Bienvenue <?= $_SESSION['user']['nom'] ?> | 
        <a href="index.php/logout">Déconnexion</a>
    <?php else: ?>
        Non Connecté
    <?php endif; ?>
    ||
    <a href="<?= BASE_PATH_SERVER ?>/index.php/options">Options</a> &nbsp;&nbsp;
</div>
<br />

