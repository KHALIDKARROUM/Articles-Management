<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<h1><?= htmlspecialchars($article['Titre'], ENT_QUOTES, 'UTF-8') ?></h1>
<p class="meta">Par <?= htmlspecialchars($article['Auteur'], ENT_QUOTES, 'UTF-8') ?> 
    le <?= date('d/m/Y', strtotime($article['DatePublication'])) ?></p>

<div class="article-content">
    <h3>Résumé</h3>
    <p><?= nl2br(htmlspecialchars($article['Resume'], ENT_QUOTES, 'UTF-8')) ?></p>
    
    <h3>Contenu</h3>
    <p><?= nl2br(htmlspecialchars($article['Contenu'], ENT_QUOTES, 'UTF-8')) ?></p>
</div>

<?php if (isset($_SESSION['login'])): ?>
    <hr/>
    <h3>Ajouter un commentaire</h3>
    <form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/commenter/<?= $article['IdArticle'] ?>">
        <textarea name="contenu" required></textarea><br/>
        <input type="submit" value="Commenter"/>
    </form>
<?php endif; ?>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>