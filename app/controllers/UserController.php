<?php
require_once 'app/models/UserModel.php';

class UserController {
    private $model;

    public function __construct($pdo) {
    
        $this->model = new UserModel($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->model->authenticate($_POST['login'], $_POST['password']);

            if ($user) {
                $_SESSION['message'] = "Welcome";
                $_SESSION['user']['id'] == $user['id'];
                $_SESSION['user']['nom'] = $user['nom'];
                $_SESSION['user']['prenom'] = $user['prenom'];
                $_SESSION['user']['login'] = $user['login'];
                $_SESSION['user']['role'] = $user['role'];
                $_SESSION['login'] = $user['nom'];

                header('Location: index.php');
                exit;
            } else {
                $errors = $user;
            }
        }

        include VIEW_PATH . '/user/login.php';
    }

    public function options() {
        include VIEW_PATH . '/user/options.php';
    }


    

    public function logout() {
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function listeUtilisateurs() {
        $this->checkAdmin();
        $utilisateurs = $this->model->getAllUsers();
        include VIEW_PATH . '/user/index.php';
    }

    public function creerUtilisateur() {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->model->createUser($_POST);
            if ($result === true) {
                $_SESSION['message'] = "Utilisateur créé avec succès";
                header('Location: index.php/user');
                exit;
            } else {
                $errors = $result;
            }
        }
        include VIEW_PATH . '/user/create.php';
    }

    public function modifierUtilisateur($id) {
        if (!$this->isAdmin() && $_SESSION['user']['id'] != $id) {
            $_SESSION['error'] = "Accès non autorisé";
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->model->updateUser($id, $_POST);
            if ($result === true) {
                $_SESSION['message'] = "Utilisateur mis à jour avec succès";

                if ($_SESSION['user']['id'] == $id) {
                    $_SESSION['user']['nom'] = $_POST['nom'];
                    $_SESSION['user']['prenom'] = $_POST['prenom'];
                    $_SESSION['user']['login'] = $_POST['login'];
                }

                header('Location: index.php/user');
                exit;
            } else {
                $errors = $result;
            }
        }

        $user = $this->model->getUserById($id);
        if (!$user) {
            $_SESSION['error'] = "Utilisateur non trouvé";
            header('Location: index.php/user');
            exit;
        }

        include VIEW_PATH . '/user/edit.php';
    }

    public function supprimerUtilisateur($id) {
        $this->checkAdmin();

        if ($_SESSION['user']['id'] == $id) {
            $_SESSION['error'] = "Vous ne pouvez pas supprimer votre propre compte";
            header('Location: index.php/user');
            exit;
        }

        if ($this->model->deleteUser($id)) {
            $_SESSION['message'] = "Utilisateur supprimé avec succès";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression";
        }

        header('Location: index.php/user');
        exit;
    }

    private function isAdmin() {
        return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
    }

    private function checkAdmin() {
        if (!$this->isAdmin()) {
            $_SESSION['error'] = "Accès refusé : droits insuffisants";
            header('Location: index.php');
            exit;
        }
    }
}