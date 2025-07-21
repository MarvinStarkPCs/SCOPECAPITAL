<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container shadow bg-dark-blue card p-4 mb-5">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">Transaction History</h6>
    </div>

    <div class="row">
        <!-- User Information -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h5><i class="fas fa-user"></i> User: <?= esc($users['name'].' '. $users['last_name'] ?? 'Not available'); ?></h5>
                <p><i class="fas fa-id-card"></i> ID: <?= esc($users['identification'] ?? 'Not available'); ?></p>
                <p><i class="fas fa-envelope"></i> Email: <?= esc($users['email'] ?? 'Not available'); ?></p>
                <p><i class="fas fa-clock"></i> Last login: <?= esc($users['last_login_attempt'] ?? 'Not available'); ?></p>
            </div>
        </div>

        <!-- Balance Information -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h5><i class="fas fa-wallet"></i> Balance and Transactions</h5>
                <p><i class="fas fa-dollar-sign"></i> Principal: <strong><?= esc($users['principal'] ?? '0'); ?> USD</strong></p>
                <p><i class="fas fa-calculator"></i> Calculated: <strong><?= esc($users['balance'] ?? '0'); ?> USD</strong></p>
                <p><i class="fas fa-calendar-alt"></i> Last Transaction: 
                    <strong><?= isset($transactions[0]['transaction_date']) ? esc($transactions[0]['transaction_date']) : 'Not available'; ?></strong>
                </p>
            </div>
        </div>
    </div>

    <!-- Date Filter -->
    <div class="row mt-4 align-items-end">
        <div class="col-md-3">
            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" class="form-control">
        </div>
        <!-- Hidden input for ID from URL -->
        <input type="hidden" id="user-id" name="user_id" value="">
        <div class="col-md-3">
            <button class="btn btn-primary w-100" onclick="filterByDate()">Filter</button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-secondary w-100" onclick="resetFilter()">Clear Filter</button>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Timeline -->
        <div class="col-md-2 d-flex align-items-center">
            <div class="timeline">
                <ul id="timeline-list"></ul>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="col-md-10">
            <div class="d-flex align-items-center justify-content-end mb-3" style="gap: 15px;">
                <button id="btnExportarExcel" class="btn btn-excel btn-sm">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </button>
                <div class="d-flex align-items-center">
                    <label for="itemsPerPage" class="me-2 mb-0 text-white">Show:</label>
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
                        <th>Calculated</th>
                        <th>Transaction Type</th>
                        <th>Date</th>
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

            <div style="gap: 30px;" class="d-flex justify-content-center mt-3" id="pagination-controls"></div>
        </div>
    </div>
</div>
<!-- ESTILOS -->
<style>
.btn-excel i { margin-right: 6px; }
.btn-excel {
    background-color: #00c292 !important;
    color: white !important;
    font-weight: bold;
    border: none;
    padding: 6px 12px;
    display: flex;
    align-items: center;
}
.btn-excel:hover { background-color: #00a982 !important; }
.form-select.custom-select-sm {
    background-color: #ffffff;
    color: #000;
    border: none;
    border-radius: 6px;
    padding: 4px 10px;
    font-weight: 500;
    height: auto;
}
.form-select.custom-select-sm:focus {
    outline: none;
    box-shadow: 0 0 0 2px #f4b400;
}
.timeline {
    position: relative;
    width: 30px;
 

        margin-left: 112px;
    margin-top: 79px;
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

    // Capturar ID desde URL
    const urlParts = window.location.pathname.split('/');
    const userId = urlParts[urlParts.length - 1] || urlParts[urlParts.length - 2];
    $('#user-id').val(userId);

    $('#itemsPerPage').on('change', function () {
        currentPage = 1;
        paginateTable();
    });
});

function filterByDate() {
    const startDate = $('#start-date').val();
    const endDate = $('#end-date').val();
    const userId = $('#user-id').val();

    if (!startDate || !endDate) {
        mostrarAlerta('warning', 'Por favor, selecciona ambas fechas.');
        return;
    }
    if (new Date(startDate) > new Date(endDate)) {
        mostrarAlerta('danger', 'La fecha de inicio no puede ser mayor que la final.');
        return;
    }

    toggleLoader(true, 1000);

    $.ajax({
        url: './filter',
        method: 'POST',
        data: {
            startDate: startDate,
            endDate: endDate,
            user_id: userId
        },
        dataType: 'json',
        success: function (data) {
            const $tbody = $('#transactions').empty();
            if (data.length === 0) {
                $tbody.append('<tr><td colspan="4">No se encontraron transacciones.</td></tr>');
            } else {
                $.each(data, function (index, row) {
                    $tbody.append(`
                        <tr>
                            <td>${row.amount} USD</td>
                            <td>${row.amount} USD</td>
                            <td>${capitalize(row.transaction_type)}</td>
                            <td>${row.transaction_date}</td>
                        </tr>`);
                });
            }
            currentPage = 1;
            generateTimeline();
            paginateTable();
        },
        error: function () {
            alert("Error al obtener las transacciones.");
        }
    });
}

function resetFilter() {
    $('#start-date').val('');
    $('#end-date').val('');
    location.reload();
}

function generateTimeline() {
    const $rows = $("#transactions tr:visible");
    const $timelineList = $("#timeline-list").empty();
    $rows.each(() => $timelineList.append("<li></li>"));
}

function paginateTable() {
    const itemsPerPage = parseInt($('#itemsPerPage').val());
    const $rows = $('#transactions tr');
    const totalPages = Math.ceil($rows.length / itemsPerPage);

    $rows.hide().slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage).show();

    generateTimeline();
    renderPaginationControls(totalPages);
}

function renderPaginationControls(totalPages) {
    const $pagination = $('#pagination-controls').empty();
    if (totalPages <= 1) return;

    $pagination.html(`
       <button style="background-color: white" class="btn btn-sm btn-outline-primary me-2" onclick="changePage(-1)" ${currentPage === 1 ? 'disabled' : ''}>Previous</button>
<span class="align-self-center me-2">Page ${currentPage} of ${totalPages}</span>
<button style="background-color: white" class="btn btn-sm btn-outline-primary" onclick="changePage(1)" ${currentPage === totalPages ? 'disabled' : ''}>Next</button>

    `);
}

function changePage(direction) {
    const totalItems = $('#transactions tr').length;
    const itemsPerPage = parseInt($('#itemsPerPage').val());
    const totalPages = Math.ceil(totalItems / itemsPerPage);
    currentPage = Math.max(1, Math.min(currentPage + direction, totalPages));
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
const encabezado = ["Principal", "Calculated Amount", "Transaction Type", "Date"];

    const data = [encabezado];

    filas.forEach(tr => {
        const celdas = Array.from(tr.querySelectorAll("td"));
        if (celdas.length > 0) {
            data.push(celdas.map(td => td.innerText));
        }
    });

    const hoja = XLSX.utils.aoa_to_sheet(data);
    const headerStyle = {
        fill: { fgColor: { rgb: "F6C058" } },
        font: { bold: true, color: { rgb: "000000" } }
    };

    for (let i = 0; i < encabezado.length; i++) {
        const cellRef = XLSX.utils.encode_cell({ r: 0, c: i });
        if (hoja[cellRef]) hoja[cellRef].s = headerStyle;
    }

    const libro = XLSX.utils.book_new();
XLSX.utils.book_append_sheet(libro, hoja, "Transactions");
XLSX.writeFile(libro, "transactions.xlsx");

});
</script>

<?= $this->endSection() ?>
