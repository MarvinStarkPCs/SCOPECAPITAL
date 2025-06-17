<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    #searchUserForm .input-group .btn {
        margin-left: 15px;
    }
</style>

<!-- Search filter and payment management -->
<div class="card shadow mb-4">

    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">Payment Management</h6>
    </div>
    
    <div class="card-body">
        <!-- User search form -->
        <form id="searchUserForm" class="row g-3 justify-content-center align-items-center">
            <?= csrf_field() ?>
            <div class="col-md-6">
                <label for="identification" class="form-label">Search User</label>
                <div class="input-group">
                    <input type="number" class="form-control" id="identification" placeholder="Identification Number" required>
                    <button type="button" class="btn btn-primary" id="searchUserBtn">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </form>

        <!-- Found user information -->
        <div id="userInfo" class="mt-4" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h5 id="userName"></h5>
                    <p><i class="fas fa-wallet"></i> Current Balance: <span id="currentBalance">0.00</span> USD</p>
                    <form id="rechargeForm">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Payment Amount</label>
                            <input type="number" class="form-control" id="amount" placeholder="Amount" required>
                            <input type="text" name="id_user" id="id_user" hidden>
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-money-bill-wave"></i> Make Payment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional styles -->
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
    // Search user
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
                        $('#userName').text(user.name + ' ' + user.last_name);
                        $('#id_user').val(user.id_user);
                        $('#currentBalance').text(parseFloat(user.balance).toFixed(2));
                        $('#userInfo').show();
                        $('#rechargeForm').data('identification', user.identification, user.id_user);   
                        mostrarAlerta('success', 'User found successfully.');
                    } else {
                        mostrarAlerta('danger', response.message);
                    }
                },
                error: function() {
                    mostrarAlerta('danger', 'Error searching for the user.');
                }
            });
        } else {
            mostrarAlerta('warning', 'Please enter the user name or ID.');
        }
    });

    // Make payment
    $('#rechargeForm').submit(function(e) {
        e.preventDefault();
        const amount = parseFloat($('#amount').val());
        const id_user = $('#id_user').val(); 
        const identification = $(this).data('identification');

        if (isNaN(amount) || amount <= 0) {
            mostrarAlerta('warning', 'Please enter a valid amount.');
            return;
        }

        $.ajax({
            url: './transactions/pay',
            type: 'POST',
            data: {
                id_user: id_user,
                identification: identification,
                amount: amount
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    mostrarAlerta('success', `Payment completed successfully. New balance: ${response.newBalance.toFixed(2)} USD.`);
                    $('#currentBalance').text(response.newBalance.toFixed(2));
                    $('#amount').val('');
                } else {
                    mostrarAlerta('danger', response.message);
                }
            },
            error: function() {
                mostrarAlerta('danger', 'Error processing the payment.');
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
