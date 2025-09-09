<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<div class="container mt-4">
    <h1>Modifier l'utilisateur</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/user/edit/<?= $user['id'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" 
                           value="<?= htmlspecialchars($user['nom']) ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" 
                           value="<?= htmlspecialchars($user['prenom']) ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="login">Email</label>
            <input type="email" class="form-control" id="login" name="login" 
                   value="<?= htmlspecialchars($user['login']) ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <div class="form-group mb-3">
                <label for="role">Rôle</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                </select>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>

