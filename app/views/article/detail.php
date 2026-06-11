<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<?php if (!$article || isset($article['bdd'])): ?>
    <section class="empty-state">
        <h1>Article not found</h1>
        <p>This article could not be loaded. It may have been deleted or moved.</p>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/article" class="button button-primary">Back to articles</a>
    </section>
<?php else: ?>
    <section class="page-header">
        <div class="page-header__content">
            <p class="page-header__eyebrow">Article</p>
            <h1><?= e($article['Titre']) ?></h1>
            <div class="article-meta">
                <span>By <?= e($article['Auteur']) ?></span>
                <span><?= e(date('M d, Y', strtotime($article['DatePublication']))) ?></span>
            </div>
        </div>

        <div class="detail-actions">
            <a href="<?= BASE_PATH_SERVER ?>/index.php/article" class="button">Back</a>
            <?php if (isset($_SESSION['login'])): ?>
                <a href="<?= BASE_PATH_SERVER ?>/index.php/modifier_article/<?= e($article['IdArticle']) ?>" class="button button-warning">Edit</a>
            <?php endif; ?>
        </div>
    </section>

    <?php flashMessage('message', 'success'); ?>
    <?php flashMessage('error', 'danger'); ?>

    <article class="article-detail">
        <section class="article-section">
            <h2>Abstract</h2>
            <p><?= nl2br(e($article['Resume'])) ?></p>
        </section>

        <section class="article-section">
            <h2>Content</h2>
            <p><?= nl2br(e($article['Contenu'])) ?></p>
        </section>
    </article>

    <?php if (isset($_SESSION['login'])): ?>
        <section class="surface comment-form">
            <div class="surface__header">
                <h2 class="surface__title">Add a comment</h2>
            </div>
            <div class="surface__body">
                <form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/commenter/<?= e($article['IdArticle']) ?>">
                    <div class="field field-full">
                        <label for="contenu">Comment</label>
                        <textarea id="contenu" name="contenu" required></textarea>
                    </div>
                    <div class="form-actions mt-3">
                        <button type="submit" class="button-primary">Post comment</button>
                    </div>
                </form>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
