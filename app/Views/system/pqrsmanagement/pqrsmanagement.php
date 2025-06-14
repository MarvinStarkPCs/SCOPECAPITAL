<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Filtros de búsqueda -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">PQRS</h6>


        <button class="btn btn-sm btn-outline-light" type="button" id="toggleFiltros">
            <i class="fas fa-sliders-h me-1"></i> Mostrar Filtros
        </button>

    </div>
    <!-- Filtros ocultos por defecto -->
    <div class="card-body" id="filtroCollapse" style="display: none;">
        <form class="row g-3 justify-content-center">
            <div class="col-md-3">
                <label for="tipoPQRS" class="form-label">Tipo PQRS</label>
                <select class="form-control select2" id="tipoPQRS" name="tipoPQRS">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($requestTypes as $type): ?>
                        <option value="<?= htmlspecialchars($type['id_type']) ?>">
                            <?= htmlspecialchars($type['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="estadoPQRS" class="form-label">Estado PQRS</label>
                <select class="form-control select2" id="estadoPQRS" name="estadoPQRS">
                    <option value="">-- Seleccione --</option>
                    <?php foreach ($requestStatuses as $status): ?>
                        <option value="<?= htmlspecialchars($status['id_status']) ?>">
                            <?= htmlspecialchars($status['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="fechaInicio" class="form-label">Fecha Inicio</label>
                <input type="date" class="form-control custom-date-input" id="fechaInicio">
            </div>

            <div class="col-md-3">
                <label for="fechaFin" class="form-label">Fecha Fin</label>
                <input type="date" class="form-control custom-date-input" id="fechaFin">
            </div>
        </form>


        <div class="row justify-content-center mt-3">
            <div class="col-md-2 text-center">
                <!-- Botón Buscar -->
                <button type="button" id="btnFiltrar" class="btn btn-warning w-100">
                    <i class="fas fa-search me-1"></i> Búsqueda
                </button>



            </div>
            <div class="col-md-2 text-center">
                <!-- Botón Limpiar -->
                <button type="button" id="btnLimpiar" class="btn btn-secondary w-100">
                    <i class="fas fa-broom me-1"></i> Limpiar
                </button>
            </div>
        </div>

    </div>

    <!-- Tabla de resultados -->
    <div class="card-body">
        <div class="table-responsive mt-4">
            <table class="table table-bordered" id="dataTable" width="100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>codigo unico</th>
                        <th>Nombre Usuario</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Fecha Apertura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaResultados">

                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $row): ?>
                            <tr>
                                <td><?= esc($row->unique_code) ?></td>
                                <td><?= esc($row->email) ?></td>
                                <td><?= esc($row->type) ?></td>
                                <td><?= esc($row->status) ?></td>
                                <td><?= esc($row->created_at) ?></td>
                                <td>
                                    <?php if ($row->id_status != 2 && $row->id_status != 3): ?>
                                        <!-- Resolve Button -->
                                        <a href="#" class="btn btn-sm btn-success open-request-modal" title="Resolve"
                                            data-toggle="modal" data-target="#solverequest" data-id="<?= esc($row->id_request) ?>"
                                            data-code="<?= esc($row->unique_code) ?>">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                         <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#cancelrequest"
                                            title="Reject" data-id="<?= esc($row->id_request) ?>"
                                            data-code="<?= esc($row->unique_code) ?>">
                                            <i class="fas fa-times-circle"></i>
                                        </a>

                                    <?php endif; ?>

                                   
                                    

                                    <!-- Details Button -->
                                    <a href="#" class="btn btn-sm btn-info" title="Details"
                                        data-id="<?= esc($row->id_request) ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Puedes mostrar un mensaje si no hay solicitudes -->
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Estilos -->
<style>
    .custom-date-input,
    .form-control {
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transition: all 0.3s ease;
        height: auto;
        min-height: 38px;
    }

    .custom-date-input:focus,
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        color: #ccc;
    }

    .form-select,
    .form-control {
        margin-bottom: 15px;
    }

    .row.g-3 .col-md-3 {
        margin-bottom: 15px;
    }

    .select2-container--default .select2-selection--single {
        border-radius: 8px;
        height: 38px;
        padding: 5px 12px;
        background-color: #fff;
        color: #000;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 26px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    body.bg-dark,
    .card.bg-dark-blue {
        background-color: #1c1f26 !important;
        color: #fff;
    }
</style>

<!-- Scripts -->
<script>
    $(document).ready(function () {
  function renderTable(data) {
    console.log('Renderizando tabla con datos:', data);
    const tbody = $('#tablaResultados');
    tbody.empty();

    if (data.length === 0) {
        const filaVacia = $('<tr>').append(
            $('<td>').attr('colspan', 6).addClass('text-center').text('Lista vacía')
        );
        tbody.append(filaVacia);
        return;
    }

    console.log('Datos recibidos:', data);
    $.each(data, function (index, item) {
        console.log('Procesando item:', item);
        let fila = $("<tr>");
        fila.append($("<td>").text(item.unique_code));
        fila.append($("<td>").text(item.email));
        fila.append($("<td>").text(item.type));
        fila.append($("<td>").text(item.status));
        fila.append($("<td>").text(item.created_at));

        // Declarar la variable antes de usarla
        let acciones = '';

        // Botón de aprobar si status_id no es 4 ni 3
        if (item.status_id != 2 && item.status_id != 3) {
            acciones += `
                <a class="btn btn-sm btn-success open-request-modal" 
                    title="Resolver"
                    data-toggle="modal" 
                    data-target="#solverequest" 
                    data-id="${item.id_request}" 
                    data-code="${item.unique_code}">
                    <i class="fas fa-check-circle"></i>
                </a>
            `;

            acciones += `
                <a href="#" class="btn btn-sm btn-danger" 
                    data-toggle="modal" 
                    data-target="#cancelrequest"
                    title="Rechazar" 
                    data-id="${item.id_request}" 
                    data-code="${item.unique_code}">
                    <i class="fas fa-times-circle"></i>
                </a>
            `;
        }

        // Botón de ver detalles (siempre)
        acciones += `
            <a href="#" class="btn btn-sm btn-info" title="Detalles">
                <i class="fas fa-eye"></i>
            </a>
        `;

        fila.append($("<td>").html(acciones));
        tbody.append(fila);
    });
}


        // BOTÓN FILTRAR
        $('#btnFiltrar').on('click', function () {
            const data = {
                tipoPQRS: $('#tipoPQRS').val(),
                estadoPQRS: $('#estadoPQRS').val(),
                fechaInicio: $('#fechaInicio').val(),
                fechaFin: $('#fechaFin').val()
            };
            if (data.fechaInicio && data.fechaFin) {
                const inicio = new Date(data.fechaInicio);
                const fin = new Date(data.fechaFin);
                if (inicio < fin) {
                    mostrarAlerta('info', 'La fecha de inicio no puede ser MENOR que la fecha de fin.');
                    return; // Detiene la ejecución si la validación falla
                }
            } else if (data.fechaInicio || data.fechaFin) {
                mostrarAlerta('info', 'Debe ingresar ambas fechas o ninguna.');
                return; // Detiene la ejecución si solo una fecha está presente
            }

            console.log('Datos a enviar:', data);
            $.ajax({
                url: '<?= base_url('admin/pqrsmanagement/filter') ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function () {
                    console.log('Enviando filtros...');
                },
                success: function (response) {
                    toggleLoader(true, 1000);
                    const tableResult = response.data;
                    renderTable(tableResult);
                    mostrarAlerta('success', 'Filtros enviados correctamente.');
                },
                error: function (xhr) {
                    console.error('Error en el envío:', xhr.responseText);
                    mostrarAlerta('danger', 'Error al enviar los filtros.');
                }
            });
        });

        // BOTÓN LIMPIAR
        $('#btnLimpiar').on('click', function () {
            $('#tipoPQRS').val('').trigger('change');
            $('#estadoPQRS').val('').trigger('change');
            $('#fechaInicio').val('');
            $('#fechaFin').val('');

            // Opcional: recargar tabla sin filtros
            $.ajax({
                url: '<?= base_url('admin/pqrsmanagement/filter') ?>',
                type: 'POST',
                data: {}, // sin filtros
                dataType: 'json',
                success: function (response) {
                    toggleLoader(true, 1000);

                    renderTable(response.data);
                    mostrarAlerta('info', 'Filtros limpiados.');
                },
                error: function (xhr) {
                    console.error('Error al limpiar filtros:', xhr.responseText);
                    mostrarAlerta('danger', 'Error al limpiar los filtros.');
                }
            });
        });
        // TOGGLE FILTROS
        const btnToggle = document.getElementById("toggleFiltros");
        const filtros = document.getElementById("filtroCollapse");

        btnToggle.addEventListener("click", function () {
            const isVisible = filtros.style.display !== "none";
            filtros.style.display = isVisible ? "none" : "block";

            btnToggle.innerHTML = isVisible
                ? '<i class="fas fa-sliders-h me-1"></i> Mostrar Filtros'
                : '<i class="fas fa-sliders-h me-1"></i> Ocultar Filtros';
        });
        // INICIALIZAR SELECT2
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select2').select2({
                width: '100%'
            });
        } else {
            console.warn('Select2 no cargado.');
        }


    });


</script>
<?= view('system/pqrsmanagement/modals/cancelrequest') ?>
<?= view('system/pqrsmanagement/modals/detailrequest') ?>
<?= view('system/pqrsmanagement/modals/solverequest') ?>

<?= $this->endSection() ?>