<?php
// Ligne ABSOLUMENT REQUISE en tout premier


// Maintenant les constantes sont disponibles
include VIEW_PATH . '/layouts/haut.php';
?>

<div class="container mt-5 text-center">
    <h1 class="display-1 text-danger">404</h1>
    <h2>Page non trouvée</h2>
    <p class="lead">La page que vous cherchez n'existe pas ou a été déplacée.</p>
    <a href="<?= BASE_PATH_SERVER ?>/index.php" class="btn btn-primary">
        <i class="fas fa-home"></i> Retour à l'accueil
    </a>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>

