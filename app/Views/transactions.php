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
        <!-- Formulario de búsqueda de usuario -->
        <form id="searchUserForm" class="row g-3 justify-content-center align-items-center">
    <div class="col-md-6">
        <label for="usuario" class="form-label">Buscar Usuario</label>
        <div class="input-group">
            <input type="text" class="form-control" id="usuario" placeholder="ID o Nombre del Usuario" required>
            <button type="button" class="btn btn-primary" id="searchUserBtn">🔍 Buscar</button>
        </div>
    </div>
</form>


        <!-- Información del usuario encontrado -->
        <div id="userInfo" class="mt-4" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h5 id="userName"></h5>
                    <p>Saldo Actual: <span id="currentBalance">0.00</span> USD</p>
                    <form id="rechargeForm">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Monto a Recargar</label>
                            <input type="number" class="form-control" id="amount" placeholder="Monto" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Recargar Saldo</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Función para buscar usuario
        $('#searchUserBtn').click(function() {
            const userName = $('#usuario').val();
            if (userName) {
                // Simulando una búsqueda de usuario en el backend (aquí puedes hacer un AJAX para buscar al usuario)
                const user = {
                    name: "John Doe", // Esto lo reemplazarías con datos del backend
                    balance: 100.50,  // Este valor también proviene del backend
                    id: 12345 // ID del usuario
                };

                // Mostrar los detalles del usuario
                $('#userName').text(user.name);
                $('#currentBalance').text(user.balance.toFixed(2));

                // Mostrar la sección para recargar
                $('#userInfo').show();
            } else {
                alert("Por favor ingresa el nombre o ID del usuario.");
            }
        });

        // Función para recargar saldo
        $('#rechargeForm').submit(function(e) {
            e.preventDefault();
            const amount = parseFloat($('#amount').val());
            if (isNaN(amount) || amount <= 0) {
                alert("Por favor ingresa un monto válido.");
                return;
            }

            // Realizar la recarga (aquí se haría un AJAX al backend para actualizar el saldo)
            alert(`Saldo recargado exitosamente. Se han agregado ${amount.toFixed(2)} USD.`);
            // Aquí podrías actualizar el saldo del usuario en el front-end, por ejemplo:
            let currentBalance = parseFloat($('#currentBalance').text());
            $('#currentBalance').text((currentBalance + amount).toFixed(2));
            $('#amount').val(''); // Limpiar el campo de monto
        });
    });
</script>

<?= $this->endSection() ?>
