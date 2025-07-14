CREATE DATABASE finalProject;
USE finalProject;

-- Table des membres
DROP TABLE emprunts_membre;
DROP TABLE emprunts_categorie_objet;
DROP TABLE emprunts_objet;
DROP TABLE emprunts_images_objet;
DROP TABLE emprunts_emprunt;

CREATE TABLE emprunts_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(100),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

-- Table des catégories
CREATE TABLE emprunts_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

-- Table des objets
CREATE TABLE emprunts_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES emprunts_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES emprunts_membre(id_membre)
);

-- Table des images des objets
CREATE TABLE emprunts_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES emprunts_objet(id_objet)
);

-- Table des emprunts
CREATE TABLE emprunts_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES emprunts_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES emprunts_membre(id_membre)
);


-- Membres
INSERT INTO emprunts_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1990-01-01', 'Femme', 'alice@example.com', 'Antananarivo', 'mdp1', 'alice.jpg'),
('Bob', '1985-05-12', 'Homme', 'bob@example.com', 'Fianarantsoa', 'mdp2', 'bob.jpg'),
('Claire', '1992-08-21', 'Femme', 'claire@example.com', 'Toamasina', 'mdp3', 'claire.jpg'),
('David', '1988-11-30', 'Homme', 'david@example.com', 'Toliara', 'mdp4', 'david.jpg');

-- Catégories
INSERT INTO emprunts_categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

-- Objets de Alice (id_membre = 1)
INSERT INTO emprunts_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Perceuse', 2, 1),
('Clé à molette', 3, 1),
('Mixeur', 4, 2),
('Lisseur', 1, 2),
('Tournevis', 2, 2),
('Cric', 3, 3),
('Blender', 4, 3),
('Pince à épiler', 1, 4),
('Scie', 2, 4);

-- Emprunts (emprunts_membre 1 emprunte un emprunts_objet du emprunts_membre 2, etc.)
INSERT INTO emprunts_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 1, '2025-07-01', '2025-07-05'),
(2, 1, '2025-07-02', '2025-07-07'),
(3, 2, '2025-07-03', '2025-07-08'),
(4, 2, '2025-07-04', '2025-07-09'),
(5, 3, '2025-07-05', '2025-07-10'),
(6, 3, '2025-07-06', '2025-07-11'),
(7, 4, '2025-07-07', '2025-07-12'),
(8, 4, '2025-07-08', '2025-07-13'),
(9, 1, '2025-07-09', '2025-07-14'),
(10, 2, '2025-07-10', '2025-07-15');

-- Images des objets
INSERT INTO emprunts_images_objet (id_objet, nom_image) VALUES
(1, 'WEB_D373E _BaByliss_Cordkeeper_2000_Hairdryer_3.jpg'),
(2, 'perceuse-electrique-280w-220v-10mm-avec-led-.jpg'),
(3, 'cle-a-molette-15-virax-017015.jpg'),
(4, 'ariete-585-nero-part-tazza-piedini-a4703113be01a382a2a2ad472c55cf80.jpg'),
(5, 'VR039297_0.jpg'),
(6, 'media.webp'),
(7, 'cric-a-bouteille-30t-worksite.jpg'),
(8, 'trust-blender-15l-plastique-300w-tb-pn2876b.jpg'),
(9, '300005.jpg'),
(10, '712091_01_P_WE_8_Turbo_Cut_Fuchsschwanz_450_WZ_jpg_1280x1280.jpg');

