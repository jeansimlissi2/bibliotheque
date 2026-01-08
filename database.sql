CREATE DATABASE IF NOT EXISTS `default`;
USE `default`;

CREATE TABLE IF NOT EXISTS `livres` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `titre` VARCHAR(255) NOT NULL,
    `auteur` VARCHAR(255) NOT NULL,
    `image_url` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `annee_publication` INT,
    `genre` VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS `lecteurs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(255) NOT NULL,
    `prenom` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `date_inscription` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `liste_lecture` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `id_livre` INT NOT NULL,
    `id_lecteur` INT NOT NULL,
    `date_emprunt` DATE NOT NULL,
    `date_retour` DATE,
    FOREIGN KEY (`id_livre`) REFERENCES `livres`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`id_lecteur`) REFERENCES `lecteurs`(`id`) ON DELETE CASCADE
);

-- Exemple de données (optionnel)
INSERT INTO `livres` (`titre`, `auteur`, `image_url`, `description`, `annee_publication`, `genre`) VALUES
('Le Seigneur des Anneaux', 'J.R.R. Tolkien', 'images/seigneur_anneaux.jpg', 'Un grand classique de la fantasy.', 1954, 'Fantasy'),
('Dune', 'Frank Herbert', 'images/dune.jpg', 'Un chef-d\'œuvre de la science-fiction.', 1965, 'Science-fiction'),
('1984', 'George Orwell', 'images/1984.jpg', 'Un roman dystopique incontournable.', 1949, 'Dystopie'),
('Fondation', 'Isaac Asimov', 'images/fondation.jpg', 'Une saga emblématique de la science-fiction.', 1951, 'Science-fiction');

-- Exemple de données pour les lecteurs (optionnel)
INSERT INTO `lecteurs` (`nom`, `prenom`, `email`, `password`) VALUES
('Doe', 'John', 'john.doe@example.com', '$2y$10$abcdefghijklmnopqrstuvABCDEFGHIJKLMNOPQRSTUV0123456789'), -- Mot de passe 'password' haché
('Dupont', 'Marie', 'marie.dupont@example.com', '$2y$10$abcdefghijklmnopqrstuvABCDEFGHIJKLMNOPQRSTUV0123456789'); -- Mot de passe 'password' haché
