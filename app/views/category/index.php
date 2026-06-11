<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<?php
$hasCategoryError = isset($categories['bdd']);
$categoryCount = (!$hasCategoryError && is_array($categories)) ? count($categories) : 0;
?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Classification</p>
        <h1>Categories</h1>
        <p>Organize research topics so the catalog is easier to browse and maintain.</p>
    </div>

    <div class="page-actions">
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/create" class="button button-primary">Add category</a>
    </div>
</section>

<?php flashMessage('message', 'success'); ?>
<?php flashMessage('error', 'danger'); ?>

<?php if ($hasCategoryError): ?>
    <div class="alert alert-danger"><?= e($categories['bdd']) ?></div>
<?php elseif ($categoryCount === 0): ?>
    <section class="empty-state">
        <h2>No categories yet</h2>
        <p>Create a category to start structuring scientific articles.</p>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/create" class="button button-primary">Create category</a>
    </section>
<?php else: ?>
    <section class="surface">
        <div class="surface__header">
            <h2 class="surface__title"><?= $categoryCount ?> categor<?= $categoryCount > 1 ? 'ies' : 'y' ?></h2>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td class="table-muted">#<?= e($category['id']) ?></td>
                            <td>
                                <a class="table-title" href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>">
                                    <?= e($category['name']) ?>
                                </a>
                            </td>
                            <td><?= e($category['description'] ?? 'No description') ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>" class="button button-sm">View</a>
                                    <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>/edit" class="button button-sm button-warning">Edit</a>
                                    <form action="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>/delete" method="POST" class="inline-form">
                                        <button type="submit" class="button-sm button-danger" data-confirm="Delete this category?">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
<?php endif; ?>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
