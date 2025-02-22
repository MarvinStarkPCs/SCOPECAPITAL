<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Filtros de búsqueda -->
<div class="card shadow mb-4 ">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">History de transactions</h6>
    </div>
    <div class="card-body">
        <form class="row g-3 justify-content-center">
            <!-- Campo Identificación con icono -->
            <div class="col-md-3">
                <label for="identification" class="form-label">
                    <i class="fas fa-id-card"></i> Identificación
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" id="identification" placeholder="Ingrese la identificación">
                </div>
            </div>
        </form>

        <!-- Botón de Búsqueda centrado -->
        <div class="row justify-content-center mt-3">
            <div class="col-md-3 d-flex justify-content-center">
                <button type="button" id="searchUserBtn" class="btn btn-warning">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </div>

        <!-- Tabla de Resultados -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Identificación</th>
                        <th>Nombre Usuario</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <tr>
                        <td colspan="6" class="text-center">LISTA VACÍA</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script para buscar y actualizar la tabla -->
<script>
$(document).ready(function() {
    $('#searchUserBtn').click(function() {
        toggleLoader(true, 1000)

        const identification = $('#identification').val();

        if (identification) {
            $.ajax({
                url: './historytransactions/search', // Ruta al controlador
                type: 'POST',
                data: { identification: identification },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const user = response.data;
                        console.log(user);

                        // Limpiar la tabla antes de agregar nueva data
                        $('#userTableBody').empty();

                        // Agregar nueva fila con la información del usuario
                        let newRow = `
                            <tr>
                                <td>${user.identification}</td>
                                <td>${user.name} ${user.last_name}</td>
                                <td>${user.email}</td>
                                <td>${user.phone}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        ${user.status === 'active' ? 
                                            `<span class="badge badge-success">Activo</span>
                                            <button class="btn btn-sm btn-success ml-2" title="Usuario activo">
                                                <i class="fas fa-check-circle"></i>
                                            </button>` :
                                            `<span class="badge badge-danger">Inactivo</span>
                                            <button class="btn btn-sm btn-danger ml-2" title="Usuario inactivo">
                                                <i class="fas fa-times-circle"></i>
                                            </button>`}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="./historytransactions/detail/${user.id_user}" class="btn btn-primary btn-sm" title="Ver detalles">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        `;

                        $('#userTableBody').append(newRow);
                    } else {
                        mostrarAlerta('danger', response.message);
                        $('#userTableBody').html('<tr><td colspan="6" class="text-center">No se encontraron datos</td></tr>');
                    }
                },
                error: function() {
                    mostrarAlerta('danger', 'Error en la búsqueda del usuario.');
                }
            });
        } else {
            mostrarAlerta('warning', 'Por favor ingrese un número de identificación.');
        }
    });
});
</script>

<?= $this->endSection() ?>
