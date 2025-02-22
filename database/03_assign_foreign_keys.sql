-- Asignar clave foránea en la tabla `users` 
ALTER TABLE users
ADD CONSTRAINT FK_role_id FOREIGN KEY (role_id) REFERENCES roles (id_role),
ADD CONSTRAINT FK_company_id FOREIGN KEY (id_company) REFERENCES company (id_company) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT FK_bank_id FOREIGN KEY (id_bank) REFERENCES bank (id_bank) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT FK_banker_id FOREIGN KEY (id_banker) REFERENCES banker (id_banker) ON DELETE SET NULL ON UPDATE CASCADE;

-- Asignar clave foránea en la tabla `requests`
ALTER TABLE requests
ADD CONSTRAINT FK_user_id FOREIGN KEY (user_id) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT FK_type_id FOREIGN KEY (type_id) REFERENCES request_types (id_type) ON DELETE RESTRICT ON UPDATE CASCADE,
ADD CONSTRAINT FK_status_id FOREIGN KEY (status_id) REFERENCES request_statuses (id_status) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Asignar clave foránea en la tabla `change_history`
ALTER TABLE change_history
ADD CONSTRAINT FK_request_id FOREIGN KEY (request_id) REFERENCES requests (id_request) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT FK_modified_by_user_id FOREIGN KEY (modified_by_user_id) REFERENCES users (id_user) ON DELETE SET NULL ON UPDATE CASCADE;

-- Asignar clave foránea en la tabla `transactions_history`
ALTER TABLE history_transactions 
ADD CONSTRAINT fk_transactions_user FOREIGN KEY (user_id) REFERENCES users(id_user);
