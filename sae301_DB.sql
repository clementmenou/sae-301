START TRANSACTION;

-- Création de la BDD, définition du jeu de caractère et règles de comparaisons pour le tri
CREATE DATABASE IF NOT EXISTS sae301
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Utilisation de la bdd pour travailler dessus
USE sae301;

-- Table des Utilisateurs
CREATE TABLE Users (
    user_id INT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    address VARCHAR(255),
    join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
    status VARCHAR(50)
) ENGINE=InnoDB;

-- Table des Produits
CREATE TABLE Products (
    product_id INT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    price DECIMAL(10, 2),
    stock_quantity INT,
    category_id INT,
    status VARCHAR(50),
    FOREIGN KEY (category_id) REFERENCES Categories(category_id)
) ENGINE=InnoDB;

-- Table des Catégories
CREATE TABLE Categories (
    category_id INT PRIMARY KEY,
    name VARCHAR(255)
) ENGINE=InnoDB;

-- Table des Commandes
CREATE TABLE Orders (
    order_id INT PRIMARY KEY,
    user_id INT,
    address_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (address_id) REFERENCES Addresses(address_id)
) ENGINE=InnoDB;

-- Table des Éléments de Commande
CREATE TABLE OrderItems (
    order_item_id INT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    FOREIGN KEY (order_id) REFERENCES Orders(order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Table des Avis
CREATE TABLE Reviews (
    review_id INT PRIMARY KEY,
    user_id INT,
    product_id INT,
    rating INT,
    text TEXT,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(50),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Table des Adresses de Livraison
CREATE TABLE Addresses (
    address_id INT PRIMARY KEY,
    street VARCHAR(255),
    city VARCHAR(255),
    zip_code VARCHAR(20),
    region VARCHAR(255),
    country VARCHAR(255),
    status VARCHAR(50)
) ENGINE=InnoDB;

-- Table de Jonction Utilisateurs-Adresses
CREATE TABLE UserAddresses (
    user_id INT,
    address_id INT,
    PRIMARY KEY (user_id, address_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (address_id) REFERENCES Addresses(address_id)
) ENGINE=InnoDB;

-- Table des Promotions
CREATE TABLE Promotions (
    promotion_id INT PRIMARY KEY,
    product_id INT,
    discount_percent DECIMAL(5, 2),
    start_date DATE,
    end_date DATE,
    status VARCHAR(50),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
) ENGINE=InnoDB;

-- Création de l'utilisateur
CREATE USER 'admin_630126434750398'@'localhost' IDENTIFIED BY 'jgB=H5%s2Kgj@u7';
GRANT ALL PRIVILEGES ON *.* TO 'admin_630126434750398'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;

-- Fermeture
COMMIT;