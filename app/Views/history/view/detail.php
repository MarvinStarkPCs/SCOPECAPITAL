<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container shadow bg-dark-blue card p-4 mb-5">
<div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">History de Transactions/Detail Transaction</h6>
    </div>
    <div class="row">
        <!-- Información del Usuario -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h5><i class="fas fa-user"></i> Usuario: <span id="username"><?= esc($users['name'].' '. $users['last_name']?? 'No disponible'); ?></span></h5>
                <p><i class="fas fa-id-card"></i> Cédula: <?= esc($users['identification'] ?? 'No disponible'); ?></p>
                <p><i class="fas fa-envelope"></i> Correo: <?= esc($users['email'] ?? 'No disponible'); ?></p>
                <p><i class="fas fa-clock"></i> Última sesión: <span id="last-login"><?= date("d/m/Y H:i:s") ?></span></p>
                </div>
        </div>


        <!-- Información de Saldos -->
        <div class="col-md-6">
            <div class="card p-3 bg-light">
                <h5><i class="fas fa-wallet"></i> Saldo y Transacciones</h5>
                <p><i class="fas fa-dollar-sign"></i> Saldo Actual: <strong> <?= esc($users['balance'] ?? 'No disponible'); ?>USD</strong></p>
                <p><i class="fas fa-calculator"></i> Saldo Calculado: <strong><?= esc($users['balance'] ?? 'No disponible'); ?></strong></p>
                <p><i class="fas fa-calendar-alt"></i> Última Transacción: <span id="last-transaction">22/02/2024</span></p>
            </div>
        </div>
    </div>

    <!-- Filtro de fechas -->
    <div class="row mt-4">
        <div class="col-md-4">
            <label for="start-date">Fecha Inicio:</label>
            <input type="date" id="start-date" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="end-date">Fecha Fin:</label>
            <input type="date" id="end-date" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100" onclick="filterByDate()">Filtrar</button>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Timeline alineado con la tabla -->
        <div class="col-md-2 d-flex align-items-center">
            <div class="timeline">
                <ul id="timeline-list"></ul>
            </div>
        </div>

        <!-- Tabla -->
        <div class="col-md-10">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Monto</th>
                        <th>Monto Calculado</th>
                        <th>Tipo de Transacción</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="transactions">
                <?php foreach ($transactions as $transaction): ?>
                        <tr>
                        <td><?= $transaction['amount'] ?> USD </td>
                            <td><?= $transaction['amount'] ?> USD</td>
                            <td><?= ucfirst($transaction['transaction_type']) ?></td>
                            <td><?= $transaction['transaction_date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

<style>
body {
    font-family: Arial, sans-serif;
}

/* Estilos de la línea de tiempo */
.timeline {
    position: relative;
    width: 30px;
    left: 133px;
    top: 30px;
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    generateTimeline();
});

function generateTimeline() {
    let rows = document.querySelectorAll("#transactions tr");
    let timelineList = document.getElementById("timeline-list");

    timelineList.innerHTML = "";

    rows.forEach(row => {
        if (row.style.display !== "none") {
            let li = document.createElement("li");
            timelineList.appendChild(li);
        }
    });
}

function filterByDate() {
    toggleLoader(true, 1000)
    console.log("Filtrando por fecha...");

    let startDate = document.getElementById("start-date").value;
    let endDate = document.getElementById("end-date").value;
    let rows = document.querySelectorAll("#transactions tr");

    rows.forEach(row => {
        let dateCell = row.cells[3].textContent.trim();
        let rowDate = new Date(dateCell);
        let start = startDate ? new Date(startDate) : null;
        let end = endDate ? new Date(endDate) : null;

        if ((start && rowDate < start) || (end && rowDate > end)) {
            row.style.display = "none";
        } else {
            row.style.display = "";
        }
    });

    generateTimeline();  // Ajusta los puntos después del filtrado
}
</script>

<?= $this->endSection() ?>
