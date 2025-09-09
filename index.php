




<?php


// Après les définitions de constantes
define('BASE_PATH_SERVER', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_PATH', __DIR__);
define('APP_PATH', __DIR__ . '/app');
define('CONFIG_PATH', BASE_PATH . '/config');
define('VIEW_PATH', APP_PATH . '/views');




// Chargement des utilitaires EN PREMIER
require APP_PATH . '/utils/utilitaires.php';  // <-- Doit être avant session.php

// Ensuite les autres inclusionss
require APP_PATH . '/autoloader.php';
require CONFIG_PATH . '/database.php';
require APP_PATH . '/middleware/session.php';

$articleModel = new ArticleModel($pdo);
$userModel = new UserModel($pdo);
$categorieModel = new CategorieModel($pdo);
$commentaireModel = new CommentaireModel($pdo);

// Instanciation des contrôleurs
$articleController = new ArticleController($articleModel, $categorieModel);
$userController = new UserController($pdo); 
$categorieController = new CategorieController($categorieModel);
$commentaireController = new CommentaireController($commentaireModel, $articleModel);


// Récupérer la partie pertinente de l'URL et la nettoyer
// parse_url permet obtenir le chemin de l'URL actuelle
$request = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
//exemple: dwd/tp/TP4_MVC/index.php/liste

// Obtenir le chemin de base du script et le nettoyer
$basepath = trim(BASE_PATH_SERVER, '/');
//exemple: dwd/tp/TP4_MVC

// Retirer le chemin de base de la requête s'il est présent
if ($basepath) {
    // preg_quote est utilisé pour échapper les caractères spéciaux du chemin de base afin de les utiliser en sécurité dans une expression régulière.
    $request = preg_replace('/^' . preg_quote($basepath, '/') . '/', '', $request);
    $request = trim($request, '/');
}

// Enlever dynamiquement le nom du script de l'URL si présent
// basename($_SERVER['SCRIPT_NAME']) renvoie le nom du script actuel
$script_name = basename($_SERVER['SCRIPT_NAME']);
// exemple: index.php)

// str_replace supprime le nom du script de la requête
// (par exemple, en transformant index.php/login en login)
$request = str_replace($script_name, '', $request);
$request = trim($request, '/');


// Gestion des routes
switch ($request) {

    case '':
    case 'accueil':
        checkAuthentication();
        $articleController->listeArticles();
        break;
    case 'options':
        $userController->options();
        break;

    case 'login':
        redirectIfAuthenticated();
        $userController->login();
        break;

    case 'logout':
        $userController->logout();
        break;

    // ... (autres routes existantes)

    // Routes utilisateur
    case 'user':
        checkAuthentication();
        if ($_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_PATH_SERVER . '/index.php');
            exit;
        }
        $userController->listeUtilisateurs();
        break;

    case 'user/create':
        checkAuthentication();
        if ($_SESSION['user']['role'] !== 'admin') {
            header('Location: ' . BASE_PATH_SERVER . '/index.php');
            exit;
        }
        $userController->creerUtilisateur();
        break;

    case preg_match('/^user\/edit\/(\d+)$/', $request, $matches):
        checkAuthentication();
        $userController->modifierUtilisateur($matches[1]);
        break;

    case preg_match('/^user\/delete\/(\d+)$/', $request, $matches):
        checkAuthentication();
        $userController->supprimerUtilisateur($matches[1]);
        break;




    case 'article':
        checkAuthentication();
        $articleController->listeArticles();
        break;
    case (preg_match('/^article\/(\d+)/', $request, $matches) ? true : false):
        $articleController->afficherArticle($matches[1]);
        break;
    

    case 'ajouter_article':
        checkAuthentication();
        $articleController->ajouterArticle();
        break;
    case (preg_match('/^modifier_article\/(\d+)/', $request, $matches) ? true : false):
        checkAuthentication();
        $articleController->modifierArticle($matches[1]);
        break;
    case (preg_match('/^supprimer_article\/(\d+)/', $request, $matches) ? true : false):
        checkAuthentication();
        $articleController->supprimerArticle($matches[1]);
        break;

        

            ///commenataire

    case (preg_match('/^commenter\/(\d+)/', $request, $matches) ? true : false):
            checkAuthentication();
            $commentaireController->ajouterCommentaire($matches[1]);
            break;
    

            // Liste des catégories
    case 'category':
        $categorieController->index();
        break;

    // Ajouter une catégorie
    case 'category/create':
        $categorieController->create();
        break;

    // Enregistrer une nouvelle catégorie
    case 'category/store':
        $categorieController->store();
        break;

    // Voir une catégorie
    case (preg_match('/^category\/(\d+)$/', $request, $matches) ? true : false):
        $categorieController->show($matches[1]);
        break;

    // Modifier une catégorie
    case (preg_match('/^category\/(\d+)\/edit$/', $request, $matches) ? true : false):
        $categorieController->edit($matches[1]);
        break;

    // Mettre à jour une catégorie
    case (preg_match('/^category\/(\d+)\/update$/', $request, $matches) ? true : false):
        $categorieController->update($matches[1]);
        break;

    // Supprimer une catégorie
    case (preg_match('/^category\/(\d+)\/delete$/', $request, $matches) ? true : false):
        $categorieController->destroy($matches[1]);
        break;
    default:
        ErrorController::notFound();
        break;
}























