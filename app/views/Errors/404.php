<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="empty-state">
    <p class="page-header__eyebrow">Error 404</p>
    <h1>Page not found</h1>
    <p>The page you requested does not exist or has been moved.</p>
    <a href="<?= BASE_PATH_SERVER ?>/index.php" class="button button-primary">Back home</a>
</section>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
