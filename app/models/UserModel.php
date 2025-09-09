<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function validateUserData($data, $isUpdate = false) {
        $errors = [];

        if (empty($data['nom'])) {
            $errors['nom'] = 'Le nom est requis.';
        }

        if (empty($data['prenom'])) {
            $errors['prenom'] = 'Le prénom est requis.';
        }

        if (empty($data['login'])) {
            $errors['login'] = 'L\'email est requis.';
        } elseif (!filter_var($data['login'], FILTER_VALIDATE_EMAIL)) {
            $errors['login'] = 'L\'email n\'est pas valide.';
        }

        if (!$isUpdate && empty($data['password'])) {
            $errors['password'] = 'Le mot de passe est requis.';
        } elseif (!empty($data['password']) && strlen($data['password']) < 6) {
            $errors['password'] = 'Le mot de passe doit contenir au moins 6 caractères.';
        }

        return $errors;
    }

    public function findByLogin($login) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM utilisateurs WHERE login = :login");
            $stmt->execute([':login' => $login]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur findByLogin: " . $e->getMessage());
            return false;
        }
    }

    public function authenticate($login, $password) {
        $user = $this->findByLogin($login);

        // if ($user && password_verify($password, $user['password'])) {
        //     unset($user['password']); // sécurité
        //     return $user;
        // }
        return $user;
        // return false;
    }

    public function createUser($userData) {
        try {
            $errors = $this->validateUserData($userData);
            if (!empty($errors)) return $errors;

            $stmt = $this->pdo->prepare("INSERT INTO utilisateurs 
                (nom, prenom, login, password, role) 
                VALUES (:nom, :prenom, :login, :password, :role)");

            return $stmt->execute([
                ':nom' => htmlspecialchars($userData['nom']),
                ':prenom' => htmlspecialchars($userData['prenom']),
                ':login' => htmlspecialchars($userData['login']),
                ':password' => password_hash($userData['password'], PASSWORD_DEFAULT),
                ':role' => $userData['role'] ?? 'user'
            ]);
        } catch (PDOException $e) {
            error_log("Erreur création utilisateur: " . $e->getMessage());
            return ['bdd' => $e->getMessage()];
        }
    }

    public function updateUser($id, $userData) {
        try {
            $errors = $this->validateUserData($userData, true);
            if (!empty($errors)) return $errors;

            $sql = "UPDATE utilisateurs SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    login = :login, 
                    role = :role";

            $params = [
                ':id' => $id,
                ':nom' => htmlspecialchars($userData['nom']),
                ':prenom' => htmlspecialchars($userData['prenom']),
                ':login' => htmlspecialchars($userData['login']),
                ':role' => $userData['role'] ?? 'user'
            ];

            if (!empty($userData['password'])) {
                $sql .= ", password = :password";
                $params[':password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
            }

            $sql .= " WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur mise à jour utilisateur: " . $e->getMessage());
            return ['bdd' => $e->getMessage()];
        }
    }

    public function getAllUsers() {
        try {
            $stmt = $this->pdo->query("SELECT id, nom, prenom, login, role, created_at FROM utilisateurs");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération utilisateurs: " . $e->getMessage());
            return false;
        }
    }

    public function getUserById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT id, nom, prenom, login, role FROM utilisateurs WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur récupération utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function deleteUser($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Erreur suppression utilisateur: " . $e->getMessage());
            return false;
        }
    }
}
