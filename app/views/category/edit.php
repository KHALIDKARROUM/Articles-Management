<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Edit</p>
        <h1>Edit category</h1>
        <p>Update this category name and description.</p>
    </div>
</section>

<?php flashMessage('error', 'danger'); ?>

<form action="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>/update" method="POST" class="form-panel">
    <div class="form-grid">
        <div class="field field-full">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= e($category['name']) ?>" required>
        </div>

        <div class="field field-full">
            <label for="description">Description</label>
            <textarea id="description" name="description"><?= e($category['description'] ?? '') ?></textarea>
        </div>
    </div>

    <div class="form-actions mt-3">
        <button type="submit" class="button-primary">Update</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category/<?= e($category['id']) ?>" class="button">Cancel</a>
    </div>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
