-- Asignar clave foránea en la tabla `users` para `role_id`
ALTER TABLE users
ADD CONSTRAINT FK_role_id FOREIGN KEY (role_id) REFERENCES roles (id_role);

-- Asignar clave foránea en la tabla `configuration`
ALTER TABLE configuration
ADD CONSTRAINT fk_configuration_user
FOREIGN KEY (user_id) REFERENCES users (id_user)
ON DELETE CASCADE
ON UPDATE CASCADE;


-- Asignar clave foránea en la tabla `requests`
ALTER TABLE requests
ADD CONSTRAINT FK_user_id FOREIGN KEY (user_id) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT FK_type_id FOREIGN KEY (type_id) REFERENCES request_types (id_type) ON DELETE RESTRICT ON UPDATE CASCADE,
ADD CONSTRAINT FK_status_id FOREIGN KEY (status_id) REFERENCES request_statuses (id_status) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Asignar clave foránea en la tabla `change_history`
ALTER TABLE change_history
ADD CONSTRAINT FK_request_id FOREIGN KEY (request_id) REFERENCES requests (id_request) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT FK_modified_by_user_id FOREIGN KEY (modified_by_user_id) REFERENCES users (id_user) ON DELETE SET NULL ON UPDATE CASCADE;
