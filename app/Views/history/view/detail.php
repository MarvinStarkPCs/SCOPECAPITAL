<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container shadow bg-dark-blue card p-4 mb-5">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">Historial de Transacciones</h6>
    </div>

    <div class="row">
        <!-- Información del Usuario -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h5><i class="fas fa-user"></i> Usuario: <?= esc($users['name'].' '. $users['last_name'] ?? 'No disponible'); ?></h5>
                <p><i class="fas fa-id-card"></i> Cédula: <?= esc($users['identification'] ?? 'No disponible'); ?></p>
                <p><i class="fas fa-envelope"></i> Correo: <?= esc($users['email'] ?? 'No disponible'); ?></p>
                <p><i class="fas fa-clock"></i> Última sesión: <?= esc($users['last_login_attempt'] ?? 'No disponible'); ?></p>
            </div>
        </div>

        <!-- Información de Saldos -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h5><i class="fas fa-wallet"></i> Saldo y Transacciones</h5>
                <p><i class="fas fa-dollar-sign"></i> Principal: <strong><?= esc($users['principal'] ?? '0'); ?> USD</strong></p>
                <p><i class="fas fa-calculator"></i> Formula: <strong><?= esc($users['balance'] ?? '0'); ?> USD</strong></p>
                <p><i class="fas fa-calendar-alt"></i> Última Transacción: 
                    <strong><?= isset($transactions[0]['transaction_date']) ? esc($transactions[0]['transaction_date']) : 'No disponible'; ?></strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Filtro de fechas -->
    <div class="row mt-4 align-items-end">
        <div class="col-md-3">
            <label for="start-date">Fecha Inicio:</label>
            <input type="date" id="start-date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end-date">Fecha Fin:</label>
            <input type="date" id="end-date" class="form-control">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary w-100" onclick="filterByDate()">Filtrar</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-secondary w-100" onclick="resetFilter()">Limpiar Filtro</button>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Línea de tiempo -->
        <div class="col-md-2 d-flex align-items-center">
            <div class="timeline">
                <ul id="timeline-list"></ul>
            </div>
        </div>

        <!-- Tabla de transacciones -->
        <div class="col-md-10">
         <!-- Exportar y selector de cantidad -->
<div class="d-flex align-items-center justify-content-end mb-3" style="gap: 15px;">
    
   <!-- Botón Exportar a Excel dinámico -->
<button id="btnExportarExcel" class="btn btn-excel btn-sm">
    <i class="fas fa-file-excel"></i> Exportar a Excel
</button>

    <!-- Selector Mostrar -->
    <div class="d-flex align-items-center">
        <label for="itemsPerPage" class="me-2 mb-0 text-white">Mostrar:</label>
        <select id="itemsPerPage" class="form-select custom-select-sm">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="100">100</option>
        </select>
    </div>

</div>



            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Principal</th>
                        <th>Formula</th>
                        <th>Tipo de Transacción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="transactions">
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?= $transaction['amount'] ?> USD</td>
                            <td><?= $transaction['amount'] ?> USD</td>
                            <td><?= ucfirst($transaction['transaction_type']) ?></td>
                            <td><?= $transaction['transaction_date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Controles de paginación -->
            <div style="gap: 30px;" class="d-flex justify-content-center mt-3" id="pagination-controls"></div>
        </div>
    </div>
</div>

<!-- ESTILOS -->
<style>
.btn-excel i {
    margin-right: 6px;
}

    /* Botón Excel */
.btn-excel {
    background-color: #00c292 !important;
    color: white !important;
    font-weight: bold;
    border: none;
    padding: 6px 12px;
    transition: background-color 0.3s ease;
    display: flex;
    align-items: center;
}

.btn-excel:hover {
    background-color: #00a982 !important;
    color: white;
}

/* Select estilo limpio */
.form-select.custom-select-sm {
    background-color: #ffffff;
    color: #000;
    border: none;
    border-radius: 6px;
    padding: 4px 10px;
    font-weight: 500;
    height: auto;
    box-shadow: none;
}

.form-select.custom-select-sm:focus {
    outline: none;
    box-shadow: 0 0 0 2px #f4b400;
}
.timeline {
    position: relative;
    width: 30px;
    margin-left: 20px;
    margin-top: 20px;
}

.timeline ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.timeline ul li {
    position: relative;
    width: 20px;
    height: 20px;
    background: #f4b400;
    border-radius: 50%;
    margin-bottom: 29px;
}

.timeline ul li::before {
    content: "";
    position: absolute;
    width: 5px;
    background: #ccc;
    height: 160%;
    left: 50%;
    transform: translateX(-50%);
    top: 20px;
}

.timeline ul li:last-child::before {
    display: none;
}

</style>

<!-- SCRIPTS -->
<script>
let currentPage = 1;

$(document).ready(function () {
    generateTimeline();
    paginateTable();

    $('#itemsPerPage').on('change', function () {
        currentPage = 1;
        paginateTable();
    });
});

function filterByDate() {
    const startDate = $('#start-date').val();
    const endDate = $('#end-date').val();

    if (!startDate || !endDate) {
        mostrarAlerta('warning', 'Por favor, selecciona ambas fechas (inicio y fin).');
        return;
    }

    if (new Date(startDate) > new Date(endDate)) {
        mostrarAlerta('danger', 'La fecha de inicio no puede ser mayor que la fecha final.');
        return;
    }

    toggleLoader(true, 1000);

    $.ajax({
        url: './filter',
        method: 'POST',
        data: { startDate: startDate, endDate: endDate },
        dataType: 'json',
        success: function (data) {
            const $tbody = $('#transactions');
            $tbody.empty();

            if (data.length === 0) {
                $tbody.append('<tr><td colspan="4">No se encontraron transacciones.</td></tr>');
            } else {
                $.each(data, function (index, row) {
                    const tr = `
                        <tr>
                            <td>${row.amount} USD</td>
                            <td>${row.amount} USD</td>
                            <td>${capitalize(row.transaction_type)}</td>
                            <td>${row.transaction_date}</td>
                        </tr>`;
                    $tbody.append(tr);
                });
            }

            currentPage = 1;
            generateTimeline();
            paginateTable();
        },
        error: function (xhr, status, error) {
            console.error("Error al filtrar por fecha:", status, error);
            alert("Ocurrió un error al obtener las transacciones.");
        }
    });
}

function resetFilter() {
    $('#start-date').val('');
    $('#end-date').val('');
    location.reload();
}

function generateTimeline() {
    const $rows = $("#transactions tr");
    const $timelineList = $("#timeline-list");
    $timelineList.empty();

    $rows.each(function () {
        if ($(this).is(":visible")) {
            $timelineList.append("<li></li>");
        }
    });
}

function paginateTable() {
    const itemsPerPage = parseInt($('#itemsPerPage').val());
    const $rows = $('#transactions tr');
    const totalItems = $rows.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    $rows.hide();
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    $rows.slice(start, end).show();

    generateTimeline();
    renderPaginationControls(totalPages);
}

function renderPaginationControls(totalPages) {
    const $pagination = $('#pagination-controls');
    $pagination.empty();

    if (totalPages <= 1) return;

    const prevDisabled = currentPage === 1 ? 'disabled' : '';
    const nextDisabled = currentPage === totalPages ? 'disabled' : '';

    let html = `
        <button  class="btn btn-sm btn-outline-primary me-2" style="background-color: white;" onclick="changePage(-1)" ${prevDisabled}>Anterior</button>
        <span class="align-self-center me-2">Página ${currentPage} de ${totalPages}</span>
        <button style="background-color: white;" class="btn btn-sm btn-outline-primary" onclick="changePage(1)" ${nextDisabled}>Siguiente</button>
    `;
    $pagination.html(html);
}

function changePage(direction) {
    const itemsPerPage = parseInt($('#itemsPerPage').val());
    const totalItems = $('#transactions tr').length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    currentPage += direction;
    currentPage = Math.max(1, Math.min(currentPage, totalPages));

    paginateTable();
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

document.getElementById("btnExportarExcel").addEventListener("click", function () {
    const tabla = document.querySelector("#transactions");
    const filas = Array.from(tabla.querySelectorAll("tr"));
    
    if (!filas.length) {
        mostrarAlerta('info', 'No hay datos para exportar.');
        return;
    }

    const encabezado = ["Monto", "Monto Calculado", "Tipo de Transacción", "Fecha"];
    const data = [encabezado];

    filas.forEach(tr => {
        const celdas = Array.from(tr.querySelectorAll("td"));
        if (celdas.length > 0) {
            data.push(celdas.map(td => td.innerText));
        }
    });

    const hoja = XLSX.utils.aoa_to_sheet(data);

    // Aplicar estilos al encabezado (solo color de fondo aquí)
    const headerStyle = {
        fill: {
            fgColor: { rgb: "F6C058" } // Color fondo encabezado
        },
        font: {
            bold: true,
            color: { rgb: "000000" }
        }
    };

    // Aplica estilos al encabezado (A1, B1, C1, D1...)
    const columnCount = encabezado.length;
    for (let i = 0; i < columnCount; i++) {
        const cellRef = XLSX.utils.encode_cell({ r: 0, c: i });
        if (!hoja[cellRef]) continue;
        hoja[cellRef].s = headerStyle;
    }

    const libro = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(libro, hoja, "Transacciones");

    // Exporta el archivo
    XLSX.writeFile(libro, "transacciones.xlsx");
});

</script>

<?= $this->endSection() ?>
