<?php include VIEW_PATH . '/layouts/haut.php'; 
?>

<div class="container mt-4">
    <h1>Gestion des Utilisateurs</h1>
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <a href="<?= BASE_PATH_SERVER ?>/index.php/user/create" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Nouvel utilisateur
    </a>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Date création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['prenom']) ?></td>
                        <td><?= htmlspecialchars($user['login']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($user['role'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                        <td>
                            <a href="<?= BASE_PATH_SERVER ?>/index.php/user/edit/<?= $user['id'] ?>" 
                               class="btn btn-sm btn-warning">
                               <i class="fas fa-edit"></i>
                            </a>
                            
                            <?php if ( isset($_SESSION['user']['id']) && $user['id'] != $_SESSION['user']['id']): ?>
                                <form action="<?= BASE_PATH_SERVER ?>/index.php/user/delete/<?= $user['id'] ?>" 
                                      method="POST" class="d-inline">
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Confirmer la suppression ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
