<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<h1>Liste des articles scientifiques</h1>
<hr/>
<?php if (isset($_SESSION['message'])): ?>
    <div class="success">
        <p><?= htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="error">
        <p><?= htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') ?></p>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['login'])): ?>
    <a href="<?= BASE_PATH_SERVER ?>/index.php/ajouter_article" class="btn">Ajouter un article</a>
<?php endif; ?>

<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= htmlspecialchars($article['Titre'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($article['Auteur'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= date('d/m/Y', strtotime($article['DatePublication'])) ?></td>
            <td>
                <a href="<?= BASE_PATH_SERVER ?>/index.php/article/<?= $article['IdArticle'] ?>">Voir</a>
                <?php if (isset($_SESSION['login'])): ?>
                    | <a href="<?= BASE_PATH_SERVER ?>/index.php/modifier_article/<?= $article['IdArticle'] ?>">Modifier</a>
                    | <a href="<?= BASE_PATH_SERVER ?>/index.php/supprimer_article/<?= $article['IdArticle'] ?>" 
                         onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>