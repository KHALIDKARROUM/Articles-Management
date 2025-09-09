<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<div class="container">
    <h1>Liste des Catégories</h1>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <a href="<?= BASE_PATH_SERVER ?>/index.php/category/create" class="btn btn-primary mb-3">Ajouter une catégorie</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= htmlspecialchars($category['name']) ?></td>
                    <td><?= htmlspecialchars($category['description'] ?? 'N/A') ?></td>
                    <td>
                        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= $category['id'] ?>" class="btn btn-sm btn-info">Voir</a>
                        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= $category['id'] ?>/edit" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="<?= BASE_PATH_SERVER ?>/index.php/category/<?= $category['id'] ?>/delete" method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>