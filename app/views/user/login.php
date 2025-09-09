<?php
include VIEW_PATH . '/layouts/haut.php';
?>


<!-- Le reste de votre code HTML... -->

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Connexion</h1>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <!-- Ajoutez l'action au formulaire -->
             <form method="post" action="<?= BASE_PATH_SERVER ?>/index.php/login">
   
                <div class="form-group mb-3">
                    <label for="login">Email</label>
                    <input type="email" class="form-control" id="login" name="login" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            </form>
        </div>
    </div>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>