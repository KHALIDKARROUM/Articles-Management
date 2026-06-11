<?php
class ArticleModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function validate($data) {
        $errors = [];

        if (empty($data['Titre'])) {
            $errors['Titre'] = 'The title is required.';
        }

        if (empty($data['Resume'])) {
            $errors['Resume'] = 'The abstract is required.';
        }

        if (empty($data['Contenu'])) {
            $errors['Contenu'] = 'The content is required.';
        }

        if (empty($data['Auteur'])) {
            $errors['Auteur'] = "The author is required.";
        }

        return $errors;
    }

    public function getListeArticles() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM Article");
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }

    public function getArticle($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Article WHERE IdArticle = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }

    public function ajouterArticle($article) {
        try {
            $errors = $this->validate($article);
            if (!empty($errors)) return $errors;

            $stmt = $this->pdo->prepare("INSERT INTO Article (Titre, Resume, Contenu, Auteur, DatePublication) 
                                        VALUES (:titre, :resume, :contenu, :auteur, NOW())");
            $stmt->execute([
                ':titre' => htmlspecialchars($article['Titre'], ENT_QUOTES, 'UTF-8'),
                ':resume' => htmlspecialchars($article['Resume'], ENT_QUOTES, 'UTF-8'),
                ':contenu' => htmlspecialchars($article['Contenu'], ENT_QUOTES, 'UTF-8'),
                ':auteur' => htmlspecialchars($article['Auteur'], ENT_QUOTES, 'UTF-8')
            ]);
            return true;
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }

    public function modifierArticle($article, $id) {
        try {
            $errors = $this->validate($article);
            if (!empty($errors)) return $errors;

            $stmt = $this->pdo->prepare("UPDATE Article SET 
                Titre = :titre, Resume = :resume, Contenu = :contenu, Auteur = :auteur 
                WHERE IdArticle = :id");
            $stmt->execute([
                ':titre' => htmlspecialchars($article['Titre'], ENT_QUOTES, 'UTF-8'),
                ':resume' => htmlspecialchars($article['Resume'], ENT_QUOTES, 'UTF-8'),
                ':contenu' => htmlspecialchars($article['Contenu'], ENT_QUOTES, 'UTF-8'),
                ':auteur' => htmlspecialchars($article['Auteur'], ENT_QUOTES, 'UTF-8'),
                ':id' => $id
            ]);
            return true;
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }

    public function supprimerArticle($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Article WHERE IdArticle = :id");
            $stmt->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }
}
