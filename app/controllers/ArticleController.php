<?php
class ArticleController {
    private $articleModel;
    private $categorieModel;

    public function __construct($articleModel, $categorieModel) {
        $this->articleModel = $articleModel;
        $this->categorieModel = $categorieModel;
    }

    public function listeArticles() {
        $articles = $this->articleModel->getListeArticles();
        include VIEW_PATH . '/article/liste.php';
    }

    public function afficherArticle($id) {
        $article = $this->articleModel->getArticle($id);
        $categories = $this->categorieModel->getListeCategories();
        include VIEW_PATH . '/article/detail.php';
    }

    public function ajouterArticle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultat = $this->articleModel->ajouterArticle($_POST);
            if ($resultat === true) {
                $_SESSION['message'] = "L'article a été ajouté avec succès.";
                header('Location: ' . BASE_PATH_SERVER . '/index.php/article');
                exit;
            } else {
                $erreurs = $resultat;
            }
        }
        $categories = $this->categorieModel->getListeCategories();
        include VIEW_PATH . '/article/form.php';
    }

    public function modifierArticle($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $resultat = $this->articleModel->modifierArticle($_POST, $id);
            if ($resultat === true) {
                $_SESSION['message'] = "L'article a été modifié avec succès.";
                header('Location: ' . BASE_PATH_SERVER . '/index.php/article/' . $id);
                exit;
            } else {
                $erreurs = $resultat;
            }
        }
        $article = $this->articleModel->getArticle($id);
        $categories = $this->categorieModel->getListeCategories();
        include VIEW_PATH . '/article/form.php';
    }

    public function supprimerArticle($id) {
        $resultat = $this->articleModel->supprimerArticle($id);
        if ($resultat === true) {
            $_SESSION['message'] = "L'article a été supprimé avec succès.";
        } else {
            $_SESSION['error'] = $resultat;
        }
        header('Location: ' . BASE_PATH_SERVER . '/index.php/article');
        exit;
    }
}