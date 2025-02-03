-- Índices para la tabla `users`
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_users_identification ON users(identification);

-- Crear índices únicos adicionales
CREATE UNIQUE INDEX idx_config_key ON configuration (config_key);
CREATE UNIQUE INDEX idx_param_key ON parameters (param_key);

-- Índices para la tabla `requests`
CREATE INDEX idx_requests_unique_code ON requests(unique_code);

-- Índices para la tabla `change_history`
CREATE INDEX idx_change_history_request_id ON change_history(request_id);
CREATE INDEX idx_change_history_modified_by_user_id ON change_history(modified_by_user_id);
