<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<div class="container">
    <h1><?= htmlspecialchars($category['name']) ?></h1>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text"><?= htmlspecialchars($category['description'] ?? 'Aucune description') ?></p>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= $category['id'] ?>/edit" class="btn btn-warning">Modifier</a>
        <form action="<?= BASE_PATH_SERVER ?>/index.php/category/<?= $category['id'] ?>/delete" method="POST" style="display:inline;">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
        </form>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category" class="btn btn-secondary">Retour</a>
    </div>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>