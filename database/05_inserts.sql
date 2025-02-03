-- Insertar roles iniciales
INSERT INTO roles (role_name, role_description)
VALUES
    ('admin', 'Administrador con acceso completo'),
    ('client', 'Usuario con permisos de edición'),
    ('guest', 'Usuario con permisos limitados');

-- Insertar tipos de solicitud
INSERT INTO request_types (name, description)
VALUES
    ('Petición', 'Solicitud de información o acción'),
    ('Queja', 'Expresión de insatisfacción con un servicio'),
    ('Reclamo', 'Requerimiento formal para solucionar un problema'),
    ('Sugerencia', 'Propuesta de mejora'),
    ('Denuncia', 'Informe de una irregularidad');

-- Insertar estados de solicitud
INSERT INTO request_statuses (name, description)
VALUES
    ('Pendiente', 'Solicitud recibida pero no procesada'),
    ('En proceso', 'Solicitud en trámite'),
    ('Resuelta', 'Solicitud atendida y cerrada'),
    ('Rechazada', 'Solicitud no aceptada o inválida');

-- Insertar usuarios
INSERT INTO users (name, last_name, identification, email, password_hash, role_id)
VALUES
    ('Juan', 'Pérez', 123456789, 'admin@admin.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 1),
    ('Ana', 'López', 987654321, 'ana@example.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 2),
    ('Luis', 'Gómez', 456789123, 'luis@example.com', '$2y$10$HashParaUsuario', 3);

-- Insertar solicitudes
INSERT INTO requests (unique_code, user_id, type_id, status_id, description, attachment_url)
VALUES
    ('REQ001', 1, 1, 1, 'Solicito información sobre mis datos registrados.', NULL),
    ('REQ002', 2, 2, 2, 'Tengo una queja sobre el servicio recibido.', 'https://example.com/file1.pdf'),
    ('REQ003', 3, 3, 3, 'Reclamo por un cargo no autorizado.', 'https://example.com/file2.pdf'),
    ('REQ004', 1, 4, 4, 'Sugerencia para mejorar la atención al cliente.', NULL);

-- Insertar historial de cambios
INSERT INTO change_history (request_id, modified_by_user_id, change_description)
VALUES
    (1, 1, 'La solicitud fue creada por el usuario.'),
    (2, 2, 'Estado actualizado de Pendiente a En proceso.'),
    (3, 3, 'Solicitud resuelta con éxito.'),
    (4, 1, 'El estado fue actualizado a Rechazada.');
