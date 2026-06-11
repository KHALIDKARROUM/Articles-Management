<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">New category</p>
        <h1>Add category</h1>
        <p>Choose a short name and a useful description for people classifying articles.</p>
    </div>
</section>

<?php flashMessage('error', 'danger'); ?>

<form action="<?= BASE_PATH_SERVER ?>/index.php/category/store" method="POST" class="form-panel">
    <div class="form-grid">
        <div class="field field-full">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="field field-full">
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>
    </div>

    <div class="form-actions mt-3">
        <button type="submit" class="button-primary">Save</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category" class="button">Cancel</a>
    </div>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
