<?php
// Fonction d'autoload personnalisée pour charger automatiquement les classes PHP
function autoloadClass($class, $baseDir)
{
    // Transforme le nom de la classe en chemin de fichier en remplaçant les \ par des / et en ajoutant l'extension .php
    $file = $baseDir . '/' . str_replace('\\', '/', $class) . '.php';

    // Vérifie si le fichier existe à l'emplacement attendu
    if (file_exists($file)) {
        require $file; // Inclut le fichier
        return true;   // Indique que l'autoload a réussi
    }

    // Si le fichier n'existe pas, parcourt récursivement tous les fichiers dans le répertoire de base
    $dirIterator = new RecursiveDirectoryIterator($baseDir);
    //transforme une structure arborescente en une suite linéaire de fichiers/dossiers(l’aplatit)
    $iterator = new RecursiveIteratorIterator($dirIterator);

    // Boucle sur tous les fichiers trouvés dans les sous-répertoires
    foreach ($iterator as $file) {
        // Ignore les répertoires
        if ($file->isDir()) {
            continue;
        }

        // Vérifie si le nom du fichier correspond à la classe recherchée
        if (basename($file) === $class . '.php') {
            require $file->getPathname(); // Inclut le fichier trouvé
            return true; // Autoload réussi
        }
    }

    return false; // Aucun fichier correspondant trouvé
}

// Enregistre la fonction d'autoload avec spl_autoload_register, en fixant le répertoire de base à APP_PATH
spl_autoload_register(function ($class) {
    autoloadClass($class, APP_PATH);
});
