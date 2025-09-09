<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<div class="container mt-4">
    <h1>Créer un utilisateur</h1>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

 <form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/user/create">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="login">Email</label>
            <input type="email" class="form-control" id="login" name="login" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group mb-3">
            <label for="role">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>

        <button type="submit" class="">Enregistrer</button>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>