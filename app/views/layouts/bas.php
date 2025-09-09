<br/>
<hr/>
<?php if (!isset($_SESSION["login"])): ?>
    <a href="<?= BASE_PATH_SERVER ?>/index.php/login">Authentification</a> |
<?php else: ?>
    <a href="<?= BASE_PATH_SERVER ?>/index.php">Accueil</a> |
    <a href="<?= BASE_PATH_SERVER ?>/index.php/article">Articles</a> |
    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user">Utilisateurs</a> |
        <a href="<?= BASE_PATH_SERVER ?>/index.php/category">Catégories</a> |
    <?php endif; ?>
<?php endif; ?>
<br/>
<hr/>
<br/>
<div class="bas">&copy; copyright: Université XYZ 2025<br/>Faculté des Sciences<br/>contact@univ-xyz.ma
</div>
</body>
</html>