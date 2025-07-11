-- Active: 1738964565388@@127.0.0.1@3306@scopecapital
-- Insertar roles
INSERT INTO roles (role_name, role_description)
VALUES
    ('ADMIN', 'ADMINISTRADOR CON ACCESO COMPLETO'),
    ('CLIENT', 'USUARIO CON PERMISOS DE EDICIÓN');

-- Insertar tipos de solicitud
INSERT INTO request_types (name, description)
VALUES
    ('PETICIÓN', 'SOLICITUD DE INFORMACIÓN O ACCIÓN'),
    ('QUEJA', 'EXPRESIÓN DE INSATISFACCIÓN CON UN SERVICIO'),
    ('RECLAMO', 'REQUERIMIENTO FORMAL PARA SOLUCIONAR UN PROBLEMA'),
    ('SUGERENCIA', 'PROPUESTA DE MEJORA'),
    ('DENUNCIA', 'INFORME DE UNA IRREGULARIDAD');

-- Insertar estados de solicitud
INSERT INTO request_statuses (name, description)
VALUES
    ('PENDIENTE', 'SOLICITUD RECIBIDA PERO NO PROCESADA'),
    ('RESUELTA', 'SOLICITUD ATENDIDA Y CERRADA'),
    ('RECHAZADA', 'SOLICITUD NO ACEPTADA O INVÁLIDA');

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
    ('smtp_host', 'smtp.gmail.com', 'Servidor SMTP'),
    ('smtp_port', '587', 'Puerto SMTP (TLS)'),
    ('smtp_user', 'tu_correo@gmail.com', 'Usuario SMTP'),
    ('smtp_password', 'tu_contraseña', 'Contraseña SMTP'),
    ('smtp_secure', 'tls', 'Tipo de seguridad (tls o ssl)'),
    ('smtp_from_name', 'Nombre Remitente', 'Nombre del remitente'),
    ('smtp_from_email', 'tu_correo@gmail.com', 'Correo electrónico del remitente');
