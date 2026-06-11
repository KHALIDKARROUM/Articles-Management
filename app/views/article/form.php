<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<?php
$isEdit = isset($article) && is_array($article) && !isset($article['bdd']);
$titleValue = $isEdit ? ($article['Titre'] ?? '') : '';
$resumeValue = $isEdit ? ($article['Resume'] ?? '') : '';
$contenuValue = $isEdit ? ($article['Contenu'] ?? '') : '';
$auteurValue = $isEdit ? ($article['Auteur'] ?? '') : ($_SESSION['login'] ?? '');
?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow"><?= $isEdit ? 'Edit' : 'Create' ?></p>
        <h1><?= $isEdit ? 'Edit article' : 'Add article' ?></h1>
        <p>Enter the essential details with a clear abstract and readable content.</p>
    </div>
</section>

<?php if (isset($erreurs['bdd'])): ?>
    <div class="alert alert-danger"><?= e($erreurs['bdd']) ?></div>
<?php endif; ?>

<form method="post" class="form-panel form-panel--wide">
    <div class="form-grid">
        <div class="field field-full">
            <label for="titre">Title</label>
            <input type="text" id="titre" name="Titre" value="<?= e($titleValue) ?>" required>
            <?php if (isset($erreurs['Titre'])): ?>
                <span class="form-error"><?= e($erreurs['Titre']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field field-full">
            <label for="resume">Abstract</label>
            <textarea id="resume" name="Resume" required><?= e($resumeValue) ?></textarea>
            <?php if (isset($erreurs['Resume'])): ?>
                <span class="form-error"><?= e($erreurs['Resume']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field field-full">
            <label for="contenu">Content</label>
            <textarea id="contenu" name="Contenu" required><?= e($contenuValue) ?></textarea>
            <?php if (isset($erreurs['Contenu'])): ?>
                <span class="form-error"><?= e($erreurs['Contenu']) ?></span>
            <?php endif; ?>
        </div>

        <div class="field">
            <label for="auteur">Author</label>
            <input type="text" id="auteur" name="Auteur" value="<?= e($auteurValue) ?>" required>
            <?php if (isset($erreurs['Auteur'])): ?>
                <span class="form-error"><?= e($erreurs['Auteur']) ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-actions mt-3">
        <button type="submit" class="button-primary"><?= $isEdit ? 'Update' : 'Save' ?></button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/article" class="button">Cancel</a>
    </div>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
