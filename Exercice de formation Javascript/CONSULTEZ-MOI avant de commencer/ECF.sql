DROP DATABASE IF EXISTS ECF;
CREATE DATABASE ECF DEFAULT CHARACTER SET UTF8 COLLATE UTF8_general_ci;

use ECF;

CREATE TABLE users (
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pseudo VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    mail VARCHAR(255) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    admin BOOLEAN NOT NULL DEFAULT FALSE

);

INSERT INTO users (pseudo, password, adresse, mail, phone, admin) VALUES 
('Admin', '321', '24 Rue de la Truffe', 'admin@gmail.com', '06.10.11.12.13', TRUE), 
('Utilisateur', '123', '12 Rue du Champignon', 'utilisateur@gmail.com', '06.03.02.01.00', FALSE), 
('David', 'mdp', '56 Avenue de la Tour', 'david@gmail.com', '06.56.10.44.78', TRUE), 
('Jean', 'pwd', '42 Chemin des Batisses', 'jean@gmail.com', '06.78.45.02.12', FALSE);