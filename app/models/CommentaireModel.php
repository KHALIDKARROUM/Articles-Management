<?php
class CommentaireModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getCommentairesArticle($idArticle) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Commentaire WHERE IdArticle = :id ORDER BY DateCommentaire DESC");
            $stmt->execute([':id' => $idArticle]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }

    public function ajouterCommentaire($commentaire) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Commentaire (IdArticle, Auteur, Contenu, DateCommentaire) 
                                        VALUES (:idArticle, :auteur, :contenu, NOW())");
            $stmt->execute([
                ':idArticle' => $commentaire['IdArticle'],
                ':auteur' => htmlspecialchars($commentaire['Auteur'], ENT_QUOTES, 'UTF-8'),
                ':contenu' => htmlspecialchars($commentaire['Contenu'], ENT_QUOTES, 'UTF-8')
            ]);
            return true;
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }
}