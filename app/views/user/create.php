<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Account</p>
        <h1>Create user</h1>
        <p>Add an account with the right role for this person's responsibilities.</p>
    </div>
</section>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error): ?>
            <div><?= e($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/user/create" class="form-panel">
    <div class="form-grid">
        <div class="field">
            <label for="nom">Last name</label>
            <input type="text" id="nom" name="nom" required>
        </div>

        <div class="field">
            <label for="prenom">First name</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>

        <div class="field field-full">
            <label for="login">Email</label>
            <input type="email" id="login" name="login" autocomplete="username" required>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="new-password" required>
        </div>

        <div class="field">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
    </div>

    <div class="form-actions mt-3">
        <button type="submit" class="button-primary">Save</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user" class="button">Cancel</a>
    </div>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
