CREATE DATABASE IF NOT EXISTS edifis_pro;
USE edifis_pro;

-- Table des statuts
CREATE TABLE statut (
    id INT AUTO_INCREMENT PRIMARY KEY,
    statut VARCHAR(255) NOT NULL
);

-- Table des chantiers
CREATE TABLE chantier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    statut_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE,
    FOREIGN KEY (statut_id) REFERENCES statut(id) ON DELETE CASCADE
);

-- Table des rôles
CREATE TABLE role (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255) NOT NULL
);

-- Table des employés
CREATE TABLE employe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    adresse VARCHAR(255),
    poste VARCHAR(255),
    FOREIGN KEY (role_id) REFERENCES role(id) ON DELETE CASCADE
);

-- Table des compétences
CREATE TABLE competences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

-- Table pivot pour les compétences des employés
CREATE TABLE employe_competences (
    employe_id INT NOT NULL,
    competences_id INT NOT NULL,
    PRIMARY KEY (employe_id, competences_id),
    FOREIGN KEY (employe_id) REFERENCES employe(id) ON DELETE CASCADE,
    FOREIGN KEY (competences_id) REFERENCES competences(id) ON DELETE CASCADE
);

-- Table des affectations
CREATE TABLE affectation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chantier_id INT NOT NULL,
    employe_id INT NOT NULL,
    date_affectation_debut DATE NOT NULL,
    date_affectation_fin DATE,
    FOREIGN KEY (chantier_id) REFERENCES chantier(id) ON DELETE CASCADE,
    FOREIGN KEY (employe_id) REFERENCES employe(id) ON DELETE CASCADE
);
