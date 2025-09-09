<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<h1><?= isset($article) ? 'Modifier' : 'Ajouter' ?> un article</h1>
<hr />
<?php if (isset($erreurs['bdd'])): ?>
    <div class="error">
        <p><?= htmlspecialchars($erreurs['bdd'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <?php unset($erreurs['bdd']); ?>
<?php endif; ?>

<form method="post">
    <div class="form-group">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="Titre" value="<?= isset($articles['Titre']) ? htmlspecialchars($articles['Titre'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
        <?php if (isset($erreurs['Titre'])): ?>
            <span class="error"><?= $erreurs['Titre'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="resume">Résumé:</label>
        <textarea id="resume" name="Resume" required><?= isset($articles['Resume']) ? htmlspecialchars($articles['Resume'], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
        <?php if (isset($erreurs['Resume'])): ?>
            <span class="error"><?= $erreurs['Resume'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="contenu">Contenu:</label>
        <textarea id="contenu" name="Contenu" required><?= isset($articles['Contenu']) ? htmlspecialchars($articles['Contenu'], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
        <?php if (isset($erreurs['Contenu'])): ?>
            <span class="error"><?= $erreurs['Contenu'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="auteur">Auteur:</label>
        <input type="text" id="auteur" name="Auteur" value="<?= isset($articles['Auteur']) ? htmlspecialchars($articles['Auteur'], ENT_QUOTES, 'UTF-8') : (isset($_SESSION['login']) ? $_SESSION['login'] : '') ?>" required>
        <?php if (isset($erreurs['Auteur'])): ?>
            <span class="error"><?= $erreurs['Auteur'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="categories">Catégories:</label>
        <select id="categories" name="categories[]" multiple>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie['id'] ?>"><?= htmlspecialchars($categorie['name'], ENT_QUOTES, 'UTF-8') ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit"><?= isset($article) ? 'Modifier' : 'Ajouter' ?></button>
    <a href="<?= BASE_PATH_SERVER ?>/index.php/article" class="btn-cancel">Annuler</a>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
