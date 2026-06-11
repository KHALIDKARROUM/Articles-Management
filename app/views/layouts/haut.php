<?php
$currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
$basePath = trim(BASE_PATH_SERVER, '/');

if ($basePath && strpos($currentPath, $basePath) === 0) {
    $currentPath = trim(substr($currentPath, strlen($basePath)), '/');
}

$currentPath = preg_replace('/^index\.php\/?/', '', $currentPath);
$currentPath = trim($currentPath, '/');
$isLoggedIn = isset($_SESSION['user']);
$userRole = $_SESSION['user']['role'] ?? null;
$language = 'EN';
$dateLabel = function_exists('afficherDate') ? afficherDate($language) : date('l j F Y');

if (!function_exists('e')) {
    function e($value) {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('navIsActive')) {
    function navIsActive($currentPath, array $targets) {
        foreach ($targets as $target) {
            if ($target === '' && ($currentPath === '' || $currentPath === 'accueil')) {
                return true;
            }

            if ($target !== '' && ($currentPath === $target || strpos($currentPath, $target . '/') === 0)) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('flashMessage')) {
    function flashMessage($key, $variant = 'info') {
        if (!isset($_SESSION[$key])) {
            return;
        }

        echo '<div class="alert alert-' . e($variant) . '">' . e($_SESSION[$key]) . '</div>';
        unset($_SESSION[$key]);
    }
}
?>
<!DOCTYPE html>
<html lang="<?= e(strtolower($language)) ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles Management</title>
    <script>
        (function () {
            var savedTheme = localStorage.getItem("theme");
            var prefersDark = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
            document.documentElement.dataset.theme = savedTheme || (prefersDark ? "dark" : "light");
        })();
    </script>
    <link rel="stylesheet" type="text/css" href="<?= BASE_PATH_SERVER ?>/public/css/style.css">
    <script type="text/javascript" src="<?= BASE_PATH_SERVER ?>/public/js/script.js" defer></script>
</head>
<body class="<?= $isLoggedIn ? 'is-authenticated' : 'is-guest' ?>">
    <header class="app-header">
        <div class="app-header__inner">
            <a class="brand" href="<?= BASE_PATH_SERVER ?>/index.php" aria-label="Articles Management">
                <img src="<?= BASE_PATH_SERVER ?>/public/images/loogo.jpg" alt="" class="brand__logo">
                <span class="brand__text">
                    <strong>Articles Management</strong>
                    <small>Scientific publishing workspace</small>
                </span>
            </a>

            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="primary-nav">
                Menu
            </button>

            <nav class="primary-nav" id="primary-nav" aria-label="Primary navigation">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= BASE_PATH_SERVER ?>/index.php" class="<?= navIsActive($currentPath, ['']) ? 'active' : '' ?>">Home</a>
                    <a href="<?= BASE_PATH_SERVER ?>/index.php/article" class="<?= navIsActive($currentPath, ['article', 'ajouter_article', 'modifier_article']) ? 'active' : '' ?>">Articles</a>
                    <?php if ($userRole === 'admin'): ?>
                        <a href="<?= BASE_PATH_SERVER ?>/index.php/category" class="<?= navIsActive($currentPath, ['category']) ? 'active' : '' ?>">Categories</a>
                        <a href="<?= BASE_PATH_SERVER ?>/index.php/user" class="<?= navIsActive($currentPath, ['user']) ? 'active' : '' ?>">Users</a>
                    <?php endif; ?>
                    <a href="<?= BASE_PATH_SERVER ?>/index.php/options" class="<?= navIsActive($currentPath, ['options']) ? 'active' : '' ?>">Preferences</a>
                <?php else: ?>
                    <a href="<?= BASE_PATH_SERVER ?>/index.php/login" class="<?= navIsActive($currentPath, ['login']) ? 'active' : '' ?>">Sign in</a>
                <?php endif; ?>
            </nav>

            <div class="header-actions">
                <button type="button" class="theme-toggle" data-theme-toggle aria-pressed="false">
                    <span data-theme-toggle-label>Dark</span>
                </button>

                <div class="account-panel">
                    <?php if ($isLoggedIn): ?>
                        <span class="account-panel__name"><?= e($_SESSION['user']['prenom'] ?? '') ?> <?= e($_SESSION['user']['nom'] ?? '') ?></span>
                        <span class="account-panel__role"><?= e($userRole ?? 'user') ?></span>
                        <a href="<?= BASE_PATH_SERVER ?>/index.php/logout" class="account-panel__link">Log out</a>
                    <?php else: ?>
                        <span class="account-panel__name">Guest</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <main class="app-main">
        <div class="date-strip" aria-label="Today"><?= e($dateLabel) ?></div>
