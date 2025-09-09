<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<div class="container">
    <h1>Ajouter une catégorie</h1>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="<?= BASE_PATH_SERVER ?>/index.php/category/store" method="POST">
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>