<?php
class CategorieController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // List all categories
    public function index() {
        $categories = $this->model->getListeCategories();
        if ($categories === false) {
            $_SESSION['error'] = "Could not load categories.";
        }
        include VIEW_PATH . '/category/index.php';
    }

    // Show creation form
    public function create() {
        include VIEW_PATH . '/category/create.php';
    }

    // Store a new category
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = "Category name is required.";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category/create");
                exit;
            }

            $success = $this->model->addCategory($name, $description);
            if ($success) {
                $_SESSION['message'] = "Category added successfully.";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category");
            } else {
                $_SESSION['error'] = "Could not add the category.";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category/create");
            }
            exit;
        }
    }

    // Show one category
    public function show($id) {
        $category = $this->model->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Category not found.";
            header("Location: " . BASE_PATH_SERVER . "/index.php/category");
            exit;
        }
        include VIEW_PATH . '/category/show.php';
    }

    // Show edit form
    public function edit($id) {
        $category = $this->model->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Category not found.";
            header("Location: " . BASE_PATH_SERVER . "/index.php/category");
            exit;
        }
        include VIEW_PATH . '/category/edit.php';
    }

    // Update a category
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($name)) {
                $_SESSION['error'] = "Category name is required.";
                header("Location: " . BASE_PATH_SERVER . "/index.php/category/{$id}/edit");
                exit;
            }

            $success = $this->model->updateCategory($id, $name, $description);
            if ($success) {
                $_SESSION['message'] = "Category updated successfully.";
            } else {
                $_SESSION['error'] = "Could not update the category.";
            }
            header("Location: " . BASE_PATH_SERVER . "/index.php/category/{$id}");
            exit;
        }
    }

    // Delete a category
    public function destroy($id) {
        $success = $this->model->deleteCategory($id);
        if ($success) {
            $_SESSION['message'] = "Category deleted successfully.";
        } else {
            $_SESSION['error'] = "Could not delete the category.";
        }
        header("Location: " . BASE_PATH_SERVER . "/index.php/category");
        exit;
    }
}
