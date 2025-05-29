-- Create the database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS testdb;

-- Use the database
USE testdb;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);