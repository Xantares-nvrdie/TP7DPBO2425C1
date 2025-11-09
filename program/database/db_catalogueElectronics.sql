CREATE DATABASE IF NOT EXISTS db_catalogueElectronics;
USE db_catalogueElectronics;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category_id INT,
    brand_id INT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE SET NULL
);

INSERT INTO categories (name) VALUES ('Laptop'), ('Smartphone'), ('Earphones'), ('Tablet');
INSERT INTO brands (name) VALUES ('Apple'), ('Samsung'), ('Sony'), ('Xiaomi'), ('Dell'), ('HP'),('Lenovo');
INSERT INTO products (name, category_id, brand_id, price, stock) VALUES
('MacBook Pro 14"', 1, 1, 29990000.00, 15),
('Galaxy S23 Ultra', 2, 2, 19999000.00, 50),
('WH-1000XM5 Wireless Headphones', 3, 3, 4999000.00, 75),
('Dell XPS 15', 1, 5, 32000000.00, 20),
('Xiaomi 13T', 2, 4, 6499000.00, 100),
('iPad Pro 11"', 4, 1, 14999000.00, 40),
('ThinkPad X1 Carbon', 1, 7, 27000000.00, 25),
('Galaxy Buds 2 Pro', 3, 2, 2299000.00, 150),
('HP Spectre x360', 1, 6, 21500000.00, 30);
