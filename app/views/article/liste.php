<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<?php
$hasArticleError = isset($articles['bdd']);
$articleCount = (!$hasArticleError && is_array($articles)) ? count($articles) : 0;
?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Library</p>
        <h1>Scientific articles</h1>
        <p>Browse, publish, and maintain research articles from a clear workspace built for quick review.</p>
    </div>

    <?php if (isset($_SESSION['login'])): ?>
        <div class="page-actions">
            <a href="<?= BASE_PATH_SERVER ?>/index.php/ajouter_article" class="button button-primary">Add article</a>
        </div>
    <?php endif; ?>
</section>

<?php flashMessage('message', 'success'); ?>
<?php flashMessage('error', 'danger'); ?>

<?php if ($hasArticleError): ?>
    <div class="alert alert-danger"><?= e($articles['bdd']) ?></div>
<?php elseif ($articleCount === 0): ?>
    <section class="empty-state">
        <h2>No articles yet</h2>
        <p>Add the first scientific article to start building the library.</p>
        <?php if (isset($_SESSION['login'])): ?>
            <a href="<?= BASE_PATH_SERVER ?>/index.php/ajouter_article" class="button button-primary">Create article</a>
        <?php endif; ?>
    </section>
<?php else: ?>
    <div class="stats-grid">
        <div class="stat-card">
            <span>Total articles</span>
            <strong><?= $articleCount ?></strong>
        </div>
        <div class="stat-card">
            <span>Last update</span>
            <strong><?= e(date('M d')) ?></strong>
        </div>
        <div class="stat-card">
            <span>Workspace</span>
            <strong>Active</strong>
        </div>
    </div>

    <section class="surface">
        <div class="surface__header">
            <h2 class="surface__title">Article catalog</h2>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <a class="table-title" href="<?= BASE_PATH_SERVER ?>/index.php/article/<?= e($article['IdArticle']) ?>">
                                    <?= e($article['Titre']) ?>
                                </a>
                            </td>
                            <td><?= e($article['Auteur']) ?></td>
                            <td class="table-muted"><?= e(date('M d, Y', strtotime($article['DatePublication']))) ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= BASE_PATH_SERVER ?>/index.php/article/<?= e($article['IdArticle']) ?>" class="button button-sm">View</a>
                                    <?php if (isset($_SESSION['login'])): ?>
                                        <a href="<?= BASE_PATH_SERVER ?>/index.php/modifier_article/<?= e($article['IdArticle']) ?>" class="button button-sm button-warning">Edit</a>
                                        <a href="<?= BASE_PATH_SERVER ?>/index.php/supprimer_article/<?= e($article['IdArticle']) ?>" class="button button-sm button-danger" data-confirm="Delete this article?">Delete</a>
                                    <?php endif; ?>
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
