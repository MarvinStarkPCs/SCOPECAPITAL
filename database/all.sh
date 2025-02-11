
#!/bin/bash

# Configuración de las variables
DB_HOST="localhost"
DB_USER="testdatabase"
DB_PASSWORD="12345"
DB_NAME="scopecapital"

# Archivos SQL a ejecutar
SQL_FILES=(
    "01_create_tables.sql"
    "02_assign_primary_keys.sql"
    "03_assign_foreign_keys.sql"
    "04_create_indexes.sql"
    "05_inserts.sql"
)

# Función para ejecutar cada archivo SQL
for FILE in "${SQL_FILES[@]}"; do
    echo "================================"
    echo "Ejecutando archivo: $FILE"
    echo "================================"

/opt/lampp/bin/mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASSWORD" --default-character-set=utf8mb4 "$DB_NAME" < "$FILE"

    if [ $? -ne 0 ]; then
        echo "Error al ejecutar $FILE."
        exit 1
    else
        echo "$FILE ejecutado correctamente."
    fi
done

echo "Todos los archivos SQL se han ejecutado correctamente."



