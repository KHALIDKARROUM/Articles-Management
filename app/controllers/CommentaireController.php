<?php
class CommentaireController {
    private $model;
    private $articleModel;

    public function __construct($model, $articleModel) {
        $this->model = $model;
        $this->articleModel = $articleModel;
    }

    public function ajouterCommentaire($idArticle) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'IdArticle' => $idArticle,
                'Auteur' => $_SESSION['login'],
                'Contenu' => $_POST['contenu']
            ];
            $resultat = $this->model->ajouterCommentaire($data);
            if ($resultat === true) {
                $_SESSION['message'] = "Votre commentaire a été ajouté.";
            } else {
                $_SESSION['error'] = $resultat['bdd'];
            }
            header('Location: ' . BASE_PATH_SERVER . '/index.php/article/' . $idArticle);
            exit;
        }
    }
}
