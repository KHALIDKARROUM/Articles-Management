<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<?php $userCount = is_array($utilisateurs) ? count($utilisateurs) : 0; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Administration</p>
        <h1>Users</h1>
        <p>Manage accounts and roles for people who can access article management.</p>
    </div>

    <div class="page-actions">
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user/create" class="button button-primary">New user</a>
    </div>
</section>

<?php flashMessage('message', 'success'); ?>
<?php flashMessage('error', 'danger'); ?>

<?php if (!$utilisateurs): ?>
    <section class="empty-state">
        <h2>No users found</h2>
        <p>Create an account so a team member can contribute to the platform.</p>
        <a href="<?= BASE_PATH_SERVER ?>/index.php/user/create" class="button button-primary">Create user</a>
    </section>
<?php else: ?>
    <section class="surface">
        <div class="surface__header">
            <h2 class="surface__title"><?= $userCount ?> user<?= $userCount > 1 ? 's' : '' ?></h2>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utilisateurs as $user): ?>
                        <tr>
                            <td class="table-muted">#<?= e($user['id']) ?></td>
                            <td>
                                <span class="table-title"><?= e($user['prenom']) ?> <?= e($user['nom']) ?></span>
                            </td>
                            <td><?= e($user['login']) ?></td>
                            <td>
                                <span class="badge <?= $user['role'] === 'admin' ? 'badge-warning' : 'badge-success' ?>">
                                    <?= e($user['role']) ?>
                                </span>
                            </td>
                            <td class="table-muted"><?= e(date('M d, Y', strtotime($user['created_at']))) ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="<?= BASE_PATH_SERVER ?>/index.php/user/edit/<?= e($user['id']) ?>" class="button button-sm button-warning">Edit</a>
                                    <?php if (isset($_SESSION['user']['id']) && $user['id'] != $_SESSION['user']['id']): ?>
                                        <form action="<?= BASE_PATH_SERVER ?>/index.php/user/delete/<?= e($user['id']) ?>" method="POST" class="inline-form">
                                            <button type="submit" class="button-sm button-danger" data-confirm="Delete this user?">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
<?php endif; ?>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
