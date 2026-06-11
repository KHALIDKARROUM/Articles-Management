<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Category</p>
        <h1><?= e($category['name']) ?></h1>
        <p><?= e($category['description'] ?? 'No description') ?></p>
    </div>

    <div class="detail-actions">
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category" class="button">Back</a>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>/edit" class="button button-warning">Edit</a>
        <form action="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>/delete" method="POST" class="inline-form">
            <button type="submit" class="button-danger" data-confirm="Delete this category?">Delete</button>
        </form>
    </div>
</section>

<?php flashMessage('message', 'success'); ?>
<?php flashMessage('error', 'danger'); ?>

<section class="surface">
    <div class="surface__header">
        <h2 class="surface__title">Details</h2>
    </div>
    <div class="surface__body">
        <p class="meta">Identifier: #<?= e($category['id']) ?></p>
        <p><?= e($category['description'] ?? 'No description') ?></p>
    </div>
</section>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
