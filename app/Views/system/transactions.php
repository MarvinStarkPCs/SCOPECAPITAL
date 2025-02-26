<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    #searchUserForm .input-group .btn {
        margin-left: 15px; /* Evita separación entre el botón y el input */
    }
</style>
<!-- Filtro de búsqueda y gestión de transacciones -->
<div class="card shadow mb-4">

    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">Gestión de Transacciones</h6>
    </div>
    
    <div class="card-body">
        <!-- Formulario de búsqueda de identification -->
        <form id="searchUserForm" class="row g-3 justify-content-center align-items-center">
        <?= csrf_field() ?>
            <div class="col-md-6">
                <label for="identification" class="form-label">Buscar Usuario</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="identification" placeholder="ID o Nombre del Usuario" required>
                    <button type="button" class="btn btn-primary" id="searchUserBtn">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
        <!-- Información del identification encontrado -->
        <div id="userInfo" class="mt-4" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h5 id="userName"></h5>
                    <p><i class="fas fa-wallet"></i> Saldo Actual: <span id="currentBalance">0.00</span> USD</p>
                    <form id="rechargeForm">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Monto a Recargar</label>
                            <input type="number" class="form-control" id="amount" placeholder="Monto" required>
                            <input type="text" name="id_user" id="id_user" hidden>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-money-bill-wave"></i> Recargar Saldo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Estilos -->
<style>
    .form-label {
        font-weight: bold;
    }

    .btn {
        font-weight: bold;
    }

    #userInfo {
        display: none;
    }
</style>

<!-- Scripts -->
<script>
$(document).ready(function() {
    // Función para buscar identification
    $('#searchUserBtn').click(function() {
        const identification = $('#identification').val();
        if (identification) {
            $.ajax({
                url: './transactions/search',
                type: 'POST',
                data: { identification: identification },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        const user = response.data;
                        console.log(user);
                        $('#userName').text(user.name+' '+user.last_name);
                        $('#id_user').val(user.id_user);
                        $('#currentBalance').text(parseFloat(user.balance).toFixed(2));
                        $('#userInfo').show();
                        $('#rechargeForm').data('identification', user.identification, user.id_user);   
                        mostrarAlerta('success', 'Usuario encontrado con éxito.');
                    } else {
                        mostrarAlerta('danger', response.message);
                    }
                },
                error: function() {
                    mostrarAlerta('danger', 'Error en la búsqueda del identification.');
                }
            });
        } else {
            mostrarAlerta('warning', 'Por favor ingresa el nombre o ID del identification.');
        }
    });

    // Función para recargar saldo
    $('#rechargeForm').submit(function(e) {
        e.preventDefault();
        const amount = parseFloat($('#amount').val());
       
        const id_user = $('#id_user').val(); 

        const identification = $(this).data('identification');
console.log(amount);
console.log(identification);
console.log(id_user);
        if (isNaN(amount) || amount <= 0) {
            mostrarAlerta('warning', 'Por favor ingresa un monto válido.');
            return;
        }

        $.ajax({
            url: './transactions/recharge',
            type: 'POST',
            data: {
                id_user: id_user,
                identification: identification,
                amount: amount
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    mostrarAlerta('success', `Saldo recargado exitosamente. Nuevo saldo: ${response.newBalance.toFixed(2)} USD.`);
                    $('#currentBalance').text(response.newBalance.toFixed(2));
                    $('#amount').val('');
                } else {
                    mostrarAlerta('danger', response.message);
                }
            },
            error: function() {
                mostrarAlerta('danger', 'Error en la recarga de saldo.');
            }
        });
    });
});

</script>

<?= $this->endSection() ?>
