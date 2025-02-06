<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Filtros de búsqueda -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">PQRS</h6>
    </div>
    <div class="card-body">
        <form class="row g-3 justify-content-center">
            <!-- Campo Tipo -->
            <div class="col-md-3">
                <label for="tipo" class="form-label">Tipo PQR</label>
                <select class="form-select select2 pqrs" id="pqrs">
                    <option value="POS" selected>OPEN</option>
                    <option value="ATM">CLOSED</option>
                </select>
            </div>

            <!-- Campo Rango de Fechas -->
            <div class="col-md-3">
                <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control custom-date-input" id="fechaInicio">
            </div>

            <div class="col-md-3">
                <label for="fechaFin" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control custom-date-input" id="fechaFin">
            </div>
        </form>

        <!-- Botón de Búsqueda en fila independiente -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-2 text-center">
                <button type="button" class="btn btn-warning w-100">🔍 Búsqueda</button>
            </div>
        </div>

        <!-- Tabla de Resultados (vacía) -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Usuario</th>
                        <th>Tipo</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Fecha Apertura</th>
                        <th>Fecha Cierre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                        <!-- Ejemplo de fila con colspan en la columna "Acciones" -->
                        <td colspan="8" class="text-center">LISTA VACIA</td>
                    </tr>
                    <!-- La tabla está vacía por ahora -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Estilos -->
<style>
    .custom-date-input {
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transition: all 0.3s ease;
        height: 38px;
    }

    .custom-date-input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    .form-label {
        white-space: nowrap;
    }

    /* Separar los campos de fecha */
    .form-select, .form-control {
        margin-bottom: 15px;
    }

    /* Mejorar el espacio entre los campos del rango de fecha */
    .row.g-3 {
        margin-bottom: 20px;
    }
</style>

<?= $this->endSection() ?>
