-- Asignar clave primaria a la tabla `roles`
ALTER TABLE roles
ADD COLUMN id_role INT AUTO_INCREMENT PRIMARY KEY;
-- Tabla configuration
ALTER TABLE configuration
ADD COLUMN id_config INT AUTO_INCREMENT PRIMARY KEY;
-- Tabla parameters
ALTER TABLE parameters
ADD COLUMN id_param INT AUTO_INCREMENT PRIMARY KEY;
-- Asignar clave primaria a la tabla `users`
ALTER TABLE users
ADD COLUMN id_user INT AUTO_INCREMENT PRIMARY KEY;

-- Asignar clave primaria a la tabla `request_types`
ALTER TABLE request_types
ADD COLUMN id_type INT AUTO_INCREMENT PRIMARY KEY;
-- Asignar clave primaria a la tabla `request_statuses`
ALTER TABLE request_statuses
ADD COLUMN id_status INT AUTO_INCREMENT PRIMARY KEY;
-- Asignar clave primaria a la tabla `requests`
ALTER TABLE requests
ADD COLUMN id_request INT AUTO_INCREMENT PRIMARY KEY;
-- Asignar clave primaria a la tabla `change_history`
ALTER TABLE change_history
ADD COLUMN id_history INT AUTO_INCREMENT PRIMARY KEY;
-- Asignar clave primaria a la tabla `transactions_history`
ALTER TABLE history_transactions
ADD COLUMN id_transaction INT AUTO_INCREMENT PRIMARY KEY;
