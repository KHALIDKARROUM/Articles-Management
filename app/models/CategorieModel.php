<?php
class CategorieModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getListeCategories() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM Categorie ORDER BY name");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }

    public function getCategoryById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM Categorie WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Category fetch error: " . $e->getMessage());
            return false;
        }
    }

    public function addCategory($name, $description = '') {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO Categorie (name, description) VALUES (:name, :description)");
            return $stmt->execute([
                ':name' => htmlspecialchars($name),
                ':description' => htmlspecialchars($description ?? '')
            ]);
        } catch (PDOException $e) {
            error_log("Category creation error: " . $e->getMessage());
            return false;
        }
    }

    public function updateCategory($id, $name, $description = '') {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE Categorie
                SET name = :name, description = :description
                WHERE id = :id
            ");

            return $stmt->execute([
                ':id' => $id,
                ':name' => htmlspecialchars($name),
                ':description' => htmlspecialchars($description ?? '')
            ]);
        } catch (PDOException $e) {
            error_log("Category update error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCategory($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM Categorie WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Category deletion error: " . $e->getMessage());
            return false;
        }
    }
}
