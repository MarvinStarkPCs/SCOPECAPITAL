-- Active: 1738964565388@@127.0.0.1@3306@scopecapital
-- Insertar roles
INSERT INTO roles (role_name, role_description)
VALUES
    ('ADMIN', 'ADMINISTRADOR CON ACCESO COMPLETO'),
    ('CLIENT', 'USUARIO CON PERMISOS DE EDICIÓN');

-- Insert request types
INSERT INTO request_types (name, description)
VALUES
    ('REQUEST', 'REQUEST FOR INFORMATION OR ACTION'),
    ('COMPLAINT', 'EXPRESSION OF DISSATISFACTION WITH A SERVICE'),
    ('CLAIM', 'FORMAL REQUEST TO RESOLVE A PROBLEM'),
    ('SUGGESTION', 'IMPROVEMENT PROPOSAL'),
    ('REPORT', 'REPORT OF AN IRREGULARITY');


-- Insert request statuses
INSERT INTO request_statuses (name, description)
VALUES
    ('PENDING', 'REQUEST RECEIVED BUT NOT YET PROCESSED'),
    ('RESOLVED', 'REQUEST ADDRESSED AND CLOSED'),
    ('REJECTED', 'REQUEST NOT ACCEPTED OR INVALID');




-- Insertar usuarios
INSERT INTO users (id_user, name, last_name, identification, email, password_hash, role_id, principal,rate, compoundingPeriods, time)
VALUES
    (1, 'JUAN', 'PÉREZ', 123456789, 'admin@admin.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 1, 10000.00, 5.00, 4, 12),
    (2, 'ANA', 'LÓPEZ', 987654321, 'ana@example.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 2, 5000.00, 3.50, 2, 6);

-- Insertar solicitudes (corrigiendo user_id)
INSERT INTO requests (unique_code, user_id, type_id, status_id, description, attachment_url)
VALUES
    ('REQ001', 1, 1, 1, 'SOLICITO INFORMACIÓN SOBRE MIS DATOS REGISTRADOS.', NULL),
    ('REQ002', 2, 2, 2, 'TENGO UNA QUEJA SOBRE EL SERVICIO RECIBIDO.', 'https://example.com/file1.pdf'),
    ('REQ003', 1, 3, 3, 'RECLAMO POR UN CARGO NO AUTORIZADO.', 'https://example.com/file2.pdf');
-- Insertar historial de cambios

-- Insertar configuración
INSERT INTO configuration (config_key, config_value, description)
VALUES
    ('smtp_config', '{"host":"smtp.gmail.com","username":"letrasylyrics48@gmail.com","port":"465","smtp_password":" tafi ljrp cmpz wbem","security":"ssl"}', 'Servidor SMTP');
  
