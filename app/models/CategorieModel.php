

<?php
class CategorieModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }


    public function validate($data) {
        $errors = [];

        if (empty($data['id'])) {
            $errors['id'] = 'Le  est requis.';
        }

        if (empty($data['name'])) {
            $errors['Resume'] = 'Le résumé est requis.';
        }

        if (empty($data['description'])) {
            $errors['Contenu'] = 'Le contenu est requis.';
        }

        return $errors;
    }


    // Récupérer toutes les catégories
    // Dans CategorieModel.php, ajoutez cette méthode :

    public function getListeCategories() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM categories ORDER BY name");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["bdd" => $e->getMessage()];
        }
    }


    // Récupérer une catégorie par son ID
    public function getCategoryById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération de la catégorie: " . $e->getMessage());
            return false;
        }
    }

    // Ajouter une nouvelle catégorie
    public function addCategory($name, $description = null) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
            return $stmt->execute([
                ':name' => htmlspecialchars($name),
                ':description' => htmlspecialchars($description)
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de la catégorie: " . $e->getMessage());
            return false;
        }
    }

    // Mettre à jour une catégorie



public function modifierCategorie($data, $id) {
    try {
        // Validation des données (optionnel si déjà fait dans le contrôleur)
        $errors = $this->validate($data);
        if (!empty($errors)) return $errors;

        // Préparation de la requête SQL
        $stmt = $this->pdo->prepare("
            UPDATE categories 
            SET Nom = :name, Description = :description 
            WHERE id = :id
        ");

        // Exécution avec les données fournies
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['Nom'],
            ':description' => $data['Description']
        ]);

    } catch (PDOException $e) {
        error_log("Erreur lors de la mise à jour de la catégorie : " . $e->getMessage());
        return false;
    }
}


    
    // Supprimer une catégorie
    public function deleteCategory($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de la catégorie: " . $e->getMessage());
            return false;
        }
    }

        
}

