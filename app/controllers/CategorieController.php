<?php
class CategorieController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Lister toutes les catégories
    public function index() {
        $categories = $this->model->getListeCategories();
        if ($categories === false) {
            $_SESSION['error'] = "Erreur lors du chargement des catégories";
        }
        include VIEW_PATH . '/category/index.php';
    }

    // Afficher le formulaire de création
    public function create() {
        include VIEW_PATH . '/category/create.php';
    }

    // Enregistrer une nouvelle catégorie
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = "Le nom de la catégorie est obligatoire";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category/create");
                exit;
            }

            $success = $this->model->addCategory($name, $description);
            if ($success) {
                $_SESSION['message'] = "Catégorie ajoutée avec succès";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category");
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de la catégorie";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category/create");
            }
            exit;
        }
    }

    // Afficher une catégorie
    public function show($id) {
        $category = $this->model->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Catégorie non trouvée";
            header("Location: " . BASE_PATH_SERVER . "/index.php/category");
            exit;
        }
        include VIEW_PATH . '/category/show.php';
    }

    // Afficher le formulaire d'édition
    public function edit($id) {
        $category = $this->model->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Catégorie non trouvée";
            header("Location: " . BASE_PATH_SERVER . "/index.php/category");
            exit;
        }
        include VIEW_PATH . '/category/edit.php';
    }

    // Mettre à jour une catégorie
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = "Le nom de la catégorie est obligatoire";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category/{$id}/edit");
                exit;
            }

            $success = $this->model->updateCategory($id, $name, $description);
            if ($success) {
                $_SESSION['message'] = "Catégorie mise à jour avec succès";
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de la catégorie";
            }
            header("Location: " . BASE_PATH_SERVER . "/index.php/category/{$id}");
            exit;
        }
    }

    // Supprimer une catégorie
    public function destroy($id) {
        $success = $this->model->deleteCategory($id);
        if ($success) {
            $_SESSION['message'] = "Catégorie supprimée avec succès";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de la catégorie";
        }
        header("Location: " . BASE_PATH_SERVER . "/index.php/category");
        exit;
    }
}
