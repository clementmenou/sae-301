START TRANSACTION;

-- Création de la BDD, définition du jeu de caractère et règles de comparaisons pour le tri
CREATE DATABASE IF NOT EXISTS u968260774_delicor
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Définition bdd sur laquelle on va travailler
USE u968260774_delicor;

-- Table des Utilisateurs
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'customer'
) ENGINE=InnoDB;

-- Table des Adresses de Livraison
CREATE TABLE addresses (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(255),
    city VARCHAR(255),
    zip_code VARCHAR(20),
    country VARCHAR(255),
    status VARCHAR(50) DEFAULT 'active'
) ENGINE=InnoDB;

-- Table de Jonction Utilisateurs-Adresses
CREATE TABLE useraddresses (
    user_id INT,
    address_id INT,
    PRIMARY KEY (user_id, address_id),
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (address_id) REFERENCES Addresses(address_id)
) ENGINE=InnoDB;

-- Table des Catégories
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
) ENGINE=InnoDB;

-- Table des Produits
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2),
    stock_quantity INT,
    image VARCHAR(50),
    status VARCHAR(50) DEFAULT 'active'
) ENGINE=InnoDB;

-- Table de Jonction Produits-Catégories
CREATE TABLE productCategories (
    category_id INT,
    product_id INT,
    PRIMARY KEY (category_id, product_id),
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (category_id) REFERENCES Categories(category_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Table des Commandes
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    address_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (address_id) REFERENCES Addresses(address_id)
) ENGINE=InnoDB;

-- Table des Éléments de Commande
CREATE TABLE orderitems (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Table des Avis
CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    rating INT,
    text TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Table des Promotions
CREATE TABLE promotions (
    promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    discount_percent DECIMAL(5, 2),
    start_date DATE,
    end_date DATE,
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Insertions de base
-- Utilisateurs
INSERT INTO
    users (`first_name`, `last_name`, `username`, `email`, `password`, `status`)
VALUES
    ('admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$m81LrzAtqQwp9dT60krAzuU61C/zbHShtmXxYx6/w9DKmso0EgQXW', 'admin');

-- Catégories
INSERT INTO categories (`name`) VALUES ('hesperides');
INSERT INTO categories (`name`) VALUES ('fleuris');
INSERT INTO categories (`name`) VALUES ('boises');
INSERT INTO categories (`name`) VALUES ('fougeres');
INSERT INTO categories (`name`) VALUES ('chypres');
INSERT INTO categories (`name`) VALUES ('orientaux');
INSERT INTO categories (`name`) VALUES ('aromatiques');


-- Création de l'utilisateur
-- CREATE USER 'u968260774_delicoradmin'@'localhost' IDENTIFIED BY 'sspxywn@|:A4';
-- GRANT ALL PRIVILEGES ON *.* TO 'u968260774_delicoradmin'@'localhost' WITH GRANT OPTION;
-- FLUSH PRIVILEGES;

-- Fermeture
COMMIT;