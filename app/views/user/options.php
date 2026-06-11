<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<section class="page-header">
    <div class="page-header__content">
        <p class="page-header__eyebrow">Preferences</p>
        <h1>Display settings</h1>
        <p>Customize simple display preferences for your session.</p>
    </div>
</section>

<?php flashMessage('message', 'success'); ?>
<?php flashMessage('error', 'danger'); ?>

<form action="<?= BASE_PATH_SERVER ?>/index.php/options" method="post" class="preference-panel">
    <div class="form-grid">
        <div class="field field-full">
            <label for="background_color">Accent color</label>
            <input type="color" id="background_color" name="background_color" value="<?= e($_COOKIE['background_color'] ?? '#2457c5') ?>">
            <p class="field-help">This preference is stored in your browser.</p>
        </div>

        <input type="hidden" name="language" value="EN">
    </div>

    <div class="form-actions mt-3">
        <button type="submit" name="submit" value="1" class="button-primary">Save</button>
    </div>
</form>

<?php include VIEW_PATH . '/layouts/bas.php'; ?>
