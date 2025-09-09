CREATE DATABASE gestion_articles_scientifiques;
USE gestion_articles_scientifiques;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insérez un admin par défaut avec password hashé
INSERT INTO utilisateurs (nom, prenom, login, password, role) 
VALUES ('Admin', 'System', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');




CREATE TABLE Categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE Article (
    IdArticle INT AUTO_INCREMENT PRIMARY KEY,
    Titre VARCHAR(255) NOT NULL,
    Resume TEXT NOT NULL,
    Contenu TEXT NOT NULL,
    Auteur VARCHAR(100) NOT NULL,
    DatePublication DATETIME NOT NULL
);

CREATE TABLE Commentaire (
    id INT AUTO_INCREMENT PRIMARY KEY,
    IdArticle INT NOT NULL,
    Auteur VARCHAR(100) NOT NULL,
    Contenu TEXT NOT NULL,
    DateCommentaire DATETIME NOT NULL,
    FOREIGN KEY (IdArticle) REFERENCES Article(IdArticle) ON DELETE CASCADE
);
