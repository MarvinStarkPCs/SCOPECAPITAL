-- Active: 1738964565388@@127.0.0.1@3306
-- Crear la base de datos
DROP DATABASE IF EXISTS `scopecapital`;
CREATE DATABASE `scopecapital`;
USE `scopecapital`;

-- Tabla roles
CREATE TABLE roles (
    role_name VARCHAR(50) NOT NULL UNIQUE,   -- Restricción UNIQUE
    role_description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla users
CREATE TABLE users (
    -- 🧾 CATEGORÍA: ACUERDOS
    agreement VARCHAR(20),
    number INT,
    letter CHAR(1),
    date_from DATE,
    date_to DATE,
    policy VARCHAR(50),
    approved_by VARCHAR(100),
    approved_date DATE,

    -- 👤 CATEGORÍA: CLIENTE
    name VARCHAR(70) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    identification BIGINT NOT NULL UNIQUE,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15),
    address VARCHAR(255),
    trust VARCHAR(100),
    email_del_trust VARCHAR(150),
    telephone_del_trust VARCHAR(20),
    profile_image VARCHAR(255),

    -- 🏦 CATEGORÍA: BANCARIO
    bank VARCHAR(50),
    swift VARCHAR(20),
    aba VARCHAR(20),
    iban VARCHAR(34),
    account VARCHAR(20),

    -- 🔐 CATEGORÍA: SEGURIDAD Y ACCESO
    password_hash VARCHAR(255) NOT NULL,
    date_registration DATETIME DEFAULT CURRENT_TIMESTAMP,
    login_attempts INT DEFAULT 0,
    last_login_attempt DATETIME,
    status ENUM('active', 'inactive') DEFAULT 'active',
    role_id INT,
    reset_token VARCHAR(64) DEFAULT NULL,
    reset_token_expiration DATETIME DEFAULT NULL,
    -- 💰 CATEGORÍA: FINANZAS / PRÉSTAMOS
    balance DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    principal DECIMAL(10, 2) NOT NULL,
    rate DECIMAL(5, 2) NOT NULL,
    compoundingPeriods INT NOT NULL,
    time INT NOT NULL
);




CREATE TABLE history_transactions (
    user_id INT NOT NULL,                     -- Campo para clave foránea
    amount DECIMAL(10, 2) NOT NULL,
    transaction_type ENUM('loan', 'pay') NOT NULL,
    transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP
    
);
-- Crear la tabla de company asociada a usuarios
CREATE TABLE company(
name VARCHAR(100) NOT NULL,
address VARCHAR(255),
telephone VARCHAR(15),
email VARCHAR(100) UNIQUE,
representative VARCHAR(100)
);
-- Crear la tabla de bank asociada a usuarios
CREATE TABLE bank(
name VARCHAR(100) NOT NULL,
address VARCHAR(255),
account_name VARCHAR(100) NOT NULL UNIQUE
);
-- Crear la tabla de banqueros asociada a usuarios
CREATE TABLE banker (
    name VARCHAR(70) NOT NULL,
    telephone VARCHAR(15),
    email VARCHAR(100) UNIQUE              -- Restricción UNIQUE
);
-- Crear la tabla de configuración asociada a usuarios
CREATE TABLE configuration (
    config_key VARCHAR(100) NOT NULL UNIQUE,
    config_value VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear la tabla de parámetros independiente
CREATE TABLE parameters (
    param_key VARCHAR(100) NOT NULL UNIQUE,
    param_value VARCHAR(255),
    numeric_value DECIMAL(15, 2),      -- valor numérico para dinero, porcentajes, etc.
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla request_types
CREATE TABLE request_types (
    name VARCHAR(100) NOT NULL UNIQUE,        -- Restricción UNIQUE
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla request_statuses
CREATE TABLE request_statuses (
    name VARCHAR(100) NOT NULL,  -- Restricción UNIQUE
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla requests
CREATE TABLE requests (
    unique_code VARCHAR(20) NOT NULL UNIQUE,    -- Restricción UNIQUE
    user_id INT NOT NULL,                       -- Campo para clave foránea
    type_id INT NOT NULL,                       -- Campo para clave foránea
    status_id INT NOT NULL,                     -- Campo para clave foránea
    description TEXT,
    response TEXT,
    attachment_url VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla change_history
CREATE TABLE change_history (
    request_id INT NOT NULL,                    -- Campo para clave foránea
    modified_by_user_id INT NULL,               -- Campo para clave foránea
    change_description TEXT NOT NULL,
    changed_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
