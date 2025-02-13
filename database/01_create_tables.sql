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
    name VARCHAR(70) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    identification BIGINT NOT NULL UNIQUE,  -- Restricción UNIQUE
    date_registration DATETIME DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(100) UNIQUE,               -- Restricción UNIQUE
    phone VARCHAR(15),
    address VARCHAR(255),
    status ENUM('active', 'inactive') DEFAULT 'active',
    password_hash VARCHAR(255) NOT NULL,
    login_attempts INT DEFAULT 0,
    last_login_attempt DATETIME,
    role_id INT                             -- Campo para clave foránea
);

-- Crear la tabla de configuración asociada a usuarios
CREATE TABLE configuration (
    id_config INT,
    config_key VARCHAR(100) NOT NULL UNIQUE,
    config_value VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    user_id INT NOT NULL,  -- Relación con la tabla `users`
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear la tabla de parámetros independiente
CREATE TABLE parameters (
    id_param INT,
    param_key VARCHAR(100) NOT NULL UNIQUE,
    param_value VARCHAR(255) NOT NULL,
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla request_types
CREATE TABLE request_types (
    name VARCHAR(50) NOT NULL UNIQUE,        -- Restricción UNIQUE
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla request_statuses
CREATE TABLE request_statuses (
    name ENUM('Pendiente', 'En proceso', 'Resuelta', 'Rechazada') NOT NULL,
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
