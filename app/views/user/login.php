<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="auth-layout">
    <div class="auth-intro">
        <p class="page-header__eyebrow">Sign in</p>
        <h1>Manage scientific articles with more clarity.</h1>
        <p>Sign in to add articles, manage categories, and keep the platform content organized.</p>
    </div>

    <form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/login" class="auth-panel">
        <h2>Sign in</h2>
        <p class="auth-panel__subtitle">Use your institutional email address.</p>

        <?php flashMessage('error', 'danger'); ?>

        <div class="field field-full mb-3">
            <label for="login">Email</label>
            <input type="email" id="login" name="login" autocomplete="username" required>
        </div>

        <div class="field field-full mb-3">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="current-password" required>
        </div>

        <button type="submit" class="button-primary">Sign in</button>
    </form>
</section>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
