@echo off

REM Configuración de las variables
set DB_HOST=localhost
set DB_USER=testdatabase
set DB_PASSWORD=12345
set DB_NAME=scopecapital

REM Archivos SQL a ejecutar
set SQL_FILES=01_create_tables.sql 02_assign_primary_keys.sql 03_assign_foreign_keys.sql 04_create_indexes.sql 05_inserts.sql

REM Función para ejecutar cada archivo SQL
for %%f in (%SQL_FILES%) do (
    echo ================================
    echo Ejecutando archivo: %%f
    echo ================================
    mysql -h %DB_HOST% -u %DB_USER% -p%DB_PASSWORD% --default-character-set=utf8mb4 %DB_NAME% < "%%f"

    if errorlevel 1 (
        echo Error al ejecutar %%f.
        exit /b 1
    ) else (
        echo %%f ejecutado correctamente.
    )
)

echo Todos los archivos SQL se han ejecutado correctamente.
pause
