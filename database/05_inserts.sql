-- Insertar roles
INSERT INTO roles (role_name, role_description)
VALUES
    ('ADMIN', 'ADMINISTRADOR CON ACCESO COMPLETO'),
    ('CLIENT', 'USUARIO CON PERMISOS DE EDICIÓN'),
    ('GUEST', 'USUARIO CON PERMISOS LIMITADOS');

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
    ('EN PROCESO', 'SOLICITUD EN TRÁMITE'),
    ('RESUELTA', 'SOLICITUD ATENDIDA Y CERRADA'),
    ('RECHAZADA', 'SOLICITUD NO ACEPTADA O INVÁLIDA');

-- Insertar usuarios
INSERT INTO users (name, last_name, identification, email, password_hash, role_id)
VALUES
    ('JUAN', 'PÉREZ', 123456789, 'admin@admin.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 1),
    ('ANA', 'LÓPEZ', 987654321, 'ana@example.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 2),
    ('LUIS', 'GÓMEZ', 456789123, 'luis@example.com', '$2y$10$HASHPARAUSUARIO', 3);

-- Insertar solicitudes
INSERT INTO requests (unique_code, user_id, type_id, status_id, description, attachment_url)
VALUES
    ('REQ001', 1, 1, 1, 'SOLICITO INFORMACIÓN SOBRE MIS DATOS REGISTRADOS.', NULL),
    ('REQ002', 2, 2, 2, 'TENGO UNA QUEJA SOBRE EL SERVICIO RECIBIDO.', 'https://example.com/file1.pdf'),
    ('REQ003', 3, 3, 3, 'RECLAMO POR UN CARGO NO AUTORIZADO.', 'https://example.com/file2.pdf'),
    ('REQ004', 1, 4, 4, 'SUGERENCIA PARA MEJORAR LA ATENCIÓN AL CLIENTE.', NULL);

-- Insertar historial de cambios
INSERT INTO change_history (request_id, modified_by_user_id, change_description)
VALUES
    (1, 1, 'LA SOLICITUD FUE CREADA POR EL USUARIO.'),
    (2, 2, 'ESTADO ACTUALIZADO DE PENDIENTE A EN PROCESO.'),
    (3, 3, 'SOLICITUD RESUELTA CON ÉXITO.'),
    (4, 1, 'EL ESTADO FUE ACTUALIZADO A RECHAZADA.');
