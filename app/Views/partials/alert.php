<!-- Mostrar mensajes de exito -->
<?php if (session()->get('success')): ?>
    <div class="alert alert-success">
        <?= session()->get('success') ?>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
    </div>
<?php endif; ?>

<!-- Mostrar mensajes de error -->
<?php if (session()->get('error')): ?>
    <div class="alert alert-danger">
        <?= session()->get('error') ?>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
    </div>
<?php endif; ?>

<!-- Mostrar mensajes largos -->
<?php if (session()->get('message')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Atención!</strong> <?= session()->get('message') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>