<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Account</p>
        <h1>Edit user</h1>
        <p>Update account information and access level.</p>
    </div>
</section>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?= e($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/user/edit/<?= e($user['id']) ?>" class="form-panel">
    <div class="form-grid">
        <div class="field">
            <label for="nom">Last name</label>
            <input type="text" id="nom" name="nom" value="<?= e($user['nom']) ?>" required>
        </div>

        <div class="field">
            <label for="prenom">First name</label>
            <input type="text" id="prenom" name="prenom" value="<?= e($user['prenom']) ?>" required>
        </div>

        <div class="field field-full">
            <label for="login">Email</label>
            <input type="email" id="login" name="login" value="<?= e($user['login']) ?>" autocomplete="username" required>
        </div>

        <div class="field">
            <label for="password">New password</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            <p class="field-help">Leave this blank to keep the current password.</p>
        </div>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <div class="field">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrator</option>
                </select>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-actions mt-3">
        <button type="submit" class="button-primary">Update</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user" class="button">Cancel</a>
    </div>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
