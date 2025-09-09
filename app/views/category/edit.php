<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<div class="container">
    <h1>Modifier la catégorie</h1>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="<?= BASE_PATH_SERVER ?>/index.php/category/<?= $category['id'] ?>" method="POST">
        <input type="hidden" name="_method" value="PUT">
        
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($category['description'] ?? '') ?></textarea>
        </div>

        <
       
        <button type="submit" class="btn btn-primary" >Mettre à jour</button>
        <a href="<?= BASE_PATH ?>/index.php/category/<?= $category['id'] ?>" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
