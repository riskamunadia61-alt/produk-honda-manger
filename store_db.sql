CREATE DATABASE IF NOT EXISTS store_db;
USE store_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Data Unit Honda
INSERT INTO products (name, category, price, stock) VALUES
('Honda Vario 160', 'Matic', 27350000.00, 15),
('Honda Beat Street', 'Matic', 18700000.00, 25),
('Honda CBR250RR', 'Sport', 63900000.00, 5),
('Honda CRF150L', 'Off-Road', 36500000.00, 8);