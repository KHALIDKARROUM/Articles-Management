<?php include VIEW_PATH . '/layouts/haut.php'; ?>

<form action="<?= BASE_PATH_SERVER ?>/index.php" method="post">
    <label for="background_color">Couleur de l'arrière-plan :</label>
    <input type="color" id="background_color" name="background_color" required><br>

    <label for="language">Langue préférée :</label>
    <select id="language" name="language" required>
        <option value="FR">Français</option>
        <option value="EN">English</option>
        <option value="AR">العربية</option>
    </select><br>

    <input type="submit" name="submit" value="Enregistrer">
</form>
<?php include VIEW_PATH . '/layouts/bas.php'; ?>
