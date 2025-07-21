<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/npm/xlsx-style@0.8.13/dist/xlsx.full.min.js"></script>


<!-- Filtros de búsqueda -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">PQRS</h6>

        <div>
            <button id="btnExportarDetalles" class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> Export to Excel
            </button>



            <button class="btn btn-sm btn-outline-light" type="button" id="toggleFiltros">
                <i class="fas fa-sliders-h me-1"></i> Hide filters
            </button>
        </div>
    </div>

    <!-- Filtros desplegados por defecto -->
    <div class="card-body" id="filtroCollapse" style="display: block;">
        <form class="row g-3 justify-content-center">
            <div class="col-md-3">
                <label for="tipoPQRS" class="form-label">PQRS type</label>
                <select class="form-control select2" id="tipoPQRS" name="tipoPQRS">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php foreach ($requestTypes as $type): ?>
                        <option value="<?= htmlspecialchars($type['id_type']) ?>">
                            <?= htmlspecialchars($type['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="estadoPQRS" class="form-label">PQRS status</label>
                <select class="form-control select2" id="estadoPQRS" name="estadoPQRS">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php foreach ($requestStatuses as $status): ?>
                        <option value="<?= htmlspecialchars($status['id_status']) ?>">
                            <?= htmlspecialchars($status['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label for="fechaInicio" class="form-label">Start date</label>
                <input type="date" class="form-control custom-date-input" id="fechaInicio">
            </div>

            <div class="col-md-3">
                <label for="fechaFin" class="form-label">End date</label>
                <input type="date" class="form-control custom-date-input" id="fechaFin">
            </div>
        </form>

        <div class="row justify-content-center mt-3">
            <div class="col-md-2 text-center">
                <button type="button" id="btnFiltrar" class="btn btn-warning w-100">
                    <i class="fas fa-search me-1"></i> Search
                </button>
            </div>
            <div class="col-md-2 text-center">
                <button type="button" id="btnLimpiar" class="btn btn-secondary w-100">
                    <i class="fas fa-broom me-1"></i> Clean
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de resultados -->
    <div class="card-body">
        <div class="table-responsive mt-4">
            <?php

            ?>
            <table class="table table-bordered" id="dataTable" width="100%">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Unique Code</th>
                        <th>User Name</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Opening Date</th>
                        <th>Actions</th>
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
                                        <a href="#" class="btn btn-sm btn-success open-request-modal"
                                            title="Resolve" data-toggle="modal" data-target="#solverequest"
                                            data-id="<?= esc($row->id_request) ?>" data-code="<?= esc($row->unique_code) ?>">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger"
                                            data-toggle="modal" data-target="#cancelrequest"
                                            title="Reject" data-id="<?= esc($row->id_request) ?>" data-code="<?= esc($row->unique_code) ?>">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                    <?php endif; ?>

                                    <a href="#" class="btn btn-sm btn-info" title="Details"
                                        data-id="<?= esc($row->id_request) ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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

    .select2-container--default .select2-selection--single {
        border-radius: 8px;
        height: 38px;
        padding: 5px 12px;
        background-color: #fff;
        color: #000;
        border: 1px solid #ced4da;
    }

    body.bg-dark,
    .card.bg-dark-blue {
        background-color: #1c1f26 !important;
        color: #fff;
    }
</style>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
    $(document).ready(function() {
       let datosFiltrados = <?= json_encode($requests) ?>;

        function renderTable(data) {
            const tbody = $('#tablaResultados');
            tbody.empty();

            if (data.length === 0) {
                const filaVacia = $('<tr>').append(
                    $('<td colspan="6" class="text-center text-muted py-3">').html('<i class="fas fa-info-circle me-1"></i> No results found.')
                );
                tbody.append(filaVacia);
                return;
            }

            $.each(data, function(index, item) {
                let fila = $("<tr>");
                fila.append($("<td>").text(item.unique_code));
                fila.append($("<td>").text(item.email));
                fila.append($("<td>").text(item.type));
                fila.append($("<td>").text(item.status));
                fila.append($("<td>").text(item.created_at));

                let acciones = '';
                if (item.status_id != 2 && item.status_id != 3) {
                    acciones += `
                        <a class="btn btn-sm btn-success open-request-modal" 
                            title="Resolve"
                            data-toggle="modal" 
                            data-target="#solverequest" 
                            data-id="${item.id_request}" 
                            data-code="${item.unique_code}">
                            <i class="fas fa-check-circle"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-danger" 
                            data-toggle="modal" 
                            data-target="#cancelrequest"
                            title="Reject" 
                            data-id="${item.id_request}" 
                            data-code="${item.unique_code}">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    `;
                }
                acciones += `
                    <a href="#" class="btn btn-sm btn-info" title="Details">
                        <i class="fas fa-eye"></i>
                    </a>
                `;
                fila.append($("<td>").html(acciones));
                tbody.append(fila);
            });
        }

        $('#btnFiltrar').on('click', function() {
            const data = {
                tipoPQRS: $('#tipoPQRS').val(),
                estadoPQRS: $('#estadoPQRS').val(),
                fechaInicio: $('#fechaInicio').val(),
                fechaFin: $('#fechaFin').val()
            };

            if (data.fechaInicio && data.fechaFin) {
                const inicio = new Date(data.fechaInicio);
                const fin = new Date(data.fechaFin);
                if (inicio > fin) {
                    mostrarAlerta('info', 'Please ensure the start date is before the end date.');
                    return;
                }
            } else if (data.fechaInicio || data.fechaFin) {
                mostrarAlerta('info', 'Please complete both date fields or clear them.');
                return;
            }

            $.ajax({
                url: '<?= base_url('admin/pqrsmanagement/filter') ?>',
                type: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    console.log('Sending filters...');
                },
                success: function(response) {
                    toggleLoader(true, 1000);
                    console.log('Filter response:', response);
                    datosFiltrados = response.data;
                    renderTable(response.data);
                    mostrarAlerta('success', 'Filters applied successfully.');
                },
                error: function(xhr) {
                    console.error('Filter error:', xhr.responseText);
                    mostrarAlerta('danger', 'Filter submission failed.');
                }
            });
        });

        $('#btnLimpiar').on('click', function() {
            $('#tipoPQRS').val('').trigger('change');
            $('#estadoPQRS').val('').trigger('change');
            $('#fechaInicio').val('');
            $('#fechaFin').val('');

            $.ajax({
                url: '<?= base_url('admin/pqrsmanagement/filter') ?>',
                type: 'POST',
                data: {},
                dataType: 'json',
                success: function(response) {
                    toggleLoader(true, 1000);
                    datosFiltrados = response.data;
                    renderTable(response.data);
                    mostrarAlerta('info', 'All filters removed.');
                },
                error: function(xhr) {
                    console.error('Clear filter error:', xhr.responseText);
                    mostrarAlerta('danger', 'Clear filters failed.');
                }
            });
        });

        // Exportar a Excel con detalles
    $('#btnExportarDetalles').on('click', function () {
    if (!Array.isArray(datosFiltrados) || datosFiltrados.length === 0) {
        mostrarAlerta('info', 'No hay datos para exportar.');
        return;
    }

   const encabezado = [
    "Code",
    "User",
    "Type",
    "Status",
    "Description",
    "Response",
    "Creation Date",
    "Update Date",
    "Attachment"
];

    const filas = datosFiltrados.map(item => [
        item.unique_code,
        item.email,
        item.type,
        item.status,
        item.description || "Sin descripción",
        item.response || "Sin respuesta",
        item.created_at,
        item.updated_at || "No disponible",
        item.attachment_url || "No disponible"
    ]);

    const hoja = XLSX.utils.aoa_to_sheet([encabezado, ...filas]);

    // ✅ Aplicar estilo al encabezado
    encabezado.forEach((col, index) => {
        const cellRef = XLSX.utils.encode_cell({ r: 0, c: index });
        hoja[cellRef].s = {
            fill: {
                fgColor: { rgb: "F6C058" }  // Color de fondo #F6C058
            },
            font: {
                bold: true,
                color: { rgb: "000000" }
            },
            alignment: {
                horizontal: "center",
                vertical: "center"
            }
        };
    });

    const libro = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(libro, hoja, "PQRS Detallado");

    XLSX.writeFile(libro, "pqrs.xlsx");
});


        // Toggle filtros
        const btnToggle = document.getElementById("toggleFiltros");
        const filtros = document.getElementById("filtroCollapse");

        btnToggle.addEventListener("click", function() {
            $(filtros).slideToggle(200, function() {
                const isVisible = $(this).is(':visible');
                btnToggle.innerHTML = isVisible ?
                    '<i class="fas fa-sliders-h me-1"></i> Hide filters' :
                    '<i class="fas fa-sliders-h me-1"></i> Show filters';
            });
        });

        // Select2
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('.select2').select2({
                width: '100%',
                placeholder: '-- Seleccione --',
                allowClear: true
            });
        }
    });
</script>



<?= view('system/pqrsmanagement/modals/cancelrequest') ?>
<?= view('system/pqrsmanagement/modals/detailrequest') ?>
<?= view('system/pqrsmanagement/modals/solverequest') ?>

<?= $this->endSection() ?>