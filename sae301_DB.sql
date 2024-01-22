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
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (address_id) REFERENCES addresses(address_id)
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
CREATE TABLE productcategories (
    category_id INT,
    product_id INT,
    PRIMARY KEY (category_id, product_id),
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
) ENGINE=InnoDB;

-- Table des Commandes
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    address_id INT,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (address_id) REFERENCES addresses(address_id)
) ENGINE=InnoDB;

-- Table des Éléments de Commande
CREATE TABLE orderitems (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    price DECIMAL(10, 2),
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
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
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
) ENGINE=InnoDB;

-- Table des Promotions
CREATE TABLE promotions (
    promotion_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    discount_percent DECIMAL(5, 2),
    start_date DATE,
    end_date DATE,
    status VARCHAR(50) DEFAULT 'active',
    FOREIGN KEY (product_id) REFERENCES products(product_id)
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

-- Produits
INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Citrus Breeze",
    "Une explosion vivifiante d'agrumes, avec des notes de citron, de bergamote et d'orange. Parfait pour une journée ensoleillée.",
    "45",
    "100",
    "hesperides1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Limoncello Zest",
    "Inspiré par l'Italie, ce parfum associe des notes de citron vert, de mandarine et de pamplemousse pour une expérience rafraîchissante.",
    "55",
    "54",
    "hesperides2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Summer Sorbet",
    "Un mélange énergisant de citron, de menthe et de mandarine, évoquant la fraîcheur d'une glace estivale.",
    "40",
    "64",
    "hesperides3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Orange Blossom Bliss",
    "Les notes florales d'orange et de néroli sont associées à des nuances de petit grain, créant une sensation florale et fruitée.",
    "50",
    "35",
    "hesperides4.png"
);



INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Rose Enchantée",
    "Un bouquet captivant de roses, de pivoines et de jasmin, créant une ambiance romantique et féminine.",
    "56",
    "36",
    "fleuris1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Gardenia Dream",
    "L'arôme envoûtant de la gardenia associé à des notes délicates de muguet et de tubéreuse, pour une expérience florale sophistiquée.",
    "35",
    "46",
    "fleuris2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Cherry Blossom Euphoria",
    "Inspiré par les cerisiers en fleurs, ce parfum mêle des notes de fleurs de cerisier, de magnolia et de violette.",
    "75",
    "53",
    "fleuris3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Iris Mystique",
    "Une composition élégante mettant en valeur l'iris, la rose et le freesia, pour une fragrance florale et poudrée.",
    "70",
    "65",
    "fleuris4.png"
);



INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Cedarwood Elegance",
    "Un mélange sophistiqué de cèdre, de vétiver et de patchouli, créant une base boisée chaleureuse et durable.",
    "80",
    "87",
    "boises1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Sandalwood Serenity",
    "Des nuances riches de bois de santal, d'ambre et de vanille, pour une fragrance apaisante et enveloppante.",
    "90",
    "78",
    "boises2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Oakmoss Odyssey",
    "Une odeur boisée terreuse associée à des notes de mousse de chêne, de musc et de cuir, évoquant une forêt mystique.",
    "75",
    "67",
    "boises3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Teakwood Temptation",
    "Un parfum boisé oriental avec des accents de teck, de cuir et de cardamome, pour une expérience séduisante.",
    "45",
    "76",
    "boises4.png"
);



INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Lavender Fields",
    "Un parfum fougère classique mettant en avant la lavande, la mousse de chêne et le géranium.",
    "65",
    "56",
    "fougeres1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Vetiver Voyager",
    "Une aventure olfactive avec des notes de vétiver, de bergamote et de cyprès, pour un parfum frais et masculin.",
    "50",
    "26",
    "fougeres2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Sage Harmony",
    "Des accords d'herbes fraîches, de sauge et de fougère, créant une fragrance tonique et revigorante.",
    "80",
    "87",
    "fougeres3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Oak & Moss Blend",
    "Un mélange boisé-fougère harmonieux avec des notes de mousse de chêne, de cèdre et de lavande.",
    "70",
    "56",
    "fougeres4.png"
);



INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Bergamot & Oakmoss Elixir",
    "Une harmonie parfaite entre la bergamote pétillante, la mousse de chêne et le patchouli, pour une fragrance élégante et raffinée.",
    "60",
    "90",
    "chypres1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Jasmine Noir Chypre",
    "Les notes florales du jasmin noir se mêlent à des accords de ciste et de labdanum, créant une fragrance envoûtante.",
    "90",
    "89",
    "chypres2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Amber Accord Symphony",
    "Un accord chypré oriental mettant en valeur l'ambre, le patchouli et le citron, pour une expérience olfactive sophistiquée.",
    "85",
    "67",
    "chypres3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Cypress & Citrus Fusion",
    "Une fusion stimulante de cyprès, de citron et de vétiver, pour une fragrance chyprée dynamique.",
    "80",
    "47",
    "chypres4.png"
);



INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Vanilla Velvet Dream",
    "Une explosion suave de vanille, de musc et d'ambre, créant une fragrance orientale douce et envoûtante.",
    "70",
    "82",
    "oriental1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Spiced Oud Euphoria",
    "Des épices exotiques, de l'oud et du bois de santal s'entrelacent pour créer une expérience orientale riche et captivante.",
    "75",
    "78",
    "oriental2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Incense Mystique",
    "Un mélange mystique d'encens, de myrrhe et de bois d'agar, pour une immersion olfactive dans l'Orient antique.",
    "60",
    "23",
    "oriental3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Orchid Noir Overture",
    "Les notes opulentes d'orchidée noire, de safran et de bois de rose créent une fragrance orientale luxueuse.",
    "90",
    "43",
    "oriental4.png"
);



INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Lavender & Sage Fusion",
    "Un mélange apaisant de lavande, de sauge et de romarin, pour une fragrance aromatique équilibrée.",
    "100",
    "78",
    "aromatique1.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Eucalyptus Breeze",
    "La fraîcheur revitalisante de l'eucalyptus, associée à des nuances d'agrumes et de menthe, crée une expérience aromatique vivifiante.",
    "50",
    "37",
    "aromatique2.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Basil & Citrus Harmony",
    "Une fusion d'agrumes énergisants avec des notes de basilic et de thym, pour une expérience aromatique dynamique.",
    "70",
    "32",
    "aromatique3.png"
);

INSERT INTO 
    products (`name`, `description`, `price`, `stock_quantity`, `image`) 
VALUES 
    (
    "Rosemary Elixir",
    "Les notes herbacées du romarin se mêlent à des accords de citron et de bois de cèdre, créant une fragrance aromatique stimulante.",
    "95",
    "79",
    "aromatique4.png"
);

-- Produits Catégories
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('1', '1');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('1', '2');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('1', '3');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('1', '4');

INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('2', '5');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('2', '6');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('2', '7');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('2', '8');

INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('3', '9');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('3', '10');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('3', '11');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('3', '12');

INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('4', '13');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('4', '14');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('4', '15');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('4', '16');

INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('5', '17');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('5', '18');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('5', '19');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('5', '20');

INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('6', '21');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('6', '22');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('6', '23');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('6', '24');

INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('7', '25');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('7', '26');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('7', '27');
INSERT INTO productcategories (`category_id`, `product_id`) VALUES ('7', '28');

-- Création de l'utilisateur
-- CREATE USER 'u968260774_delicoradmin'@'localhost' IDENTIFIED BY 'sspxywn@|:A4';
-- GRANT ALL PRIVILEGES ON *.* TO 'u968260774_delicoradmin'@'localhost' WITH GRANT OPTION;
-- FLUSH PRIVILEGES;

-- Fermeture
COMMIT;