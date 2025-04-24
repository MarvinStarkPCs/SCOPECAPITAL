<!-- Modal de Agregar user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="./usermanagement/add" method="post" id="addUserForm">
    <?= csrf_field() ?>

    <!-- Información Personal -->
    <h5 class="text-primary">Información Personal</h5>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="inputName">Nombres</label>
            <input type="text" class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert' : '' ?>" id="inputName" name="name" placeholder="Nombre" value="<?= old('name') ?>">
            <div class="invalid-feedback">
                <?= session('errors-insert.name') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="inputLastname">Apellidos</label>
            <input type="text" class="form-control <?= session('errors-insert.last_name') ? 'is-invalid errors-insert' : '' ?>" id="inputLastname" name="last_name" placeholder="Apellido" value="<?= old('last_name') ?>">
            <div class="invalid-feedback">
                <?= session('errors-insert.last_name') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="inputIdentity">Identificación (C.C)</label>
            <input type="number" class="form-control <?= session('errors-insert.identification') ? 'is-invalid errors-insert' : '' ?>" id="inputIdentity" name="identification" placeholder="Identificación" value="<?= old('identification') ?>">
            <div class="invalid-feedback">
                <?= session('errors-insert.identification') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="inputEmail">Correo Electrónico</label>
            <input type="email" class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>" id="inputEmail" name="email" placeholder="Correo" value="<?= old('email') ?>">
            <div class="invalid-feedback">
                <?= session('errors-insert.email') ?>
            </div>
        </div>
    </div>

    <!-- Información Bancaria -->
    <h5 class="text-primary">Información Bancaria</h5>
    <div class="row">
        <div class="form-group col-md-4">
            <label for="inputSwift">Código SWIFT</label>
            <input type="text" class="form-control <?= session('errors-insert.swift_code') ? 'is-invalid errors-insert' : '' ?>" id="inputSwift" name="swift_code" placeholder="SWIFT Code" value="<?= old('swift_code') ?>">
            <div class="invalid-feedback">
                <?= session('errors-insert.swift_code') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="inputRouting">Routing</label>
            <input type="text" class="form-control <?= session('errors-insert.routing') ? 'is-invalid errors-insert' : '' ?>" id="inputRouting" name="routing" placeholder="Routing" value="<?= old('routing') ?>">
            <div class="invalid-feedback">
                <?= session('errors-insert.routing') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="selectCompany">Compañía</label>
            <select class="form-control select2 <?= session('errors-insert.id_company') ? 'is-invalid errors-insert' : '' ?>" id="selectCompany" name="id_company">
                <option value="">Seleccione una Compañía</option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?= $company['id_company'] ?>" <?= old('id_company') == $company['id_company'] ? 'selected' : '' ?>><?= $company['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors-insert.id_company') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="selectBank">Banco</label>
            <select class="form-control select2 <?= session('errors-insert.id_bank') ? 'is-invalid errors-insert' : '' ?>" id="selectBank" name="id_bank">
                <option value="">Seleccione un Banco</option>
                <?php foreach ($banks as $bank): ?>
                    <option value="<?= $bank['id_bank'] ?>" <?= old('id_bank') == $bank['id_bank'] ? 'selected' : '' ?>><?= $bank['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors-insert.id_bank') ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="selectBanker">Banquero</label>
            <select class="form-control select2 <?= session('errors-insert.id_banker') ? 'is-invalid errors-insert' : '' ?>" id="selectBanker" name="id_banker">
                <option value="">Seleccione un Banquero</option>
                <?php foreach ($bankers as $banker): ?>
                    <option value="<?= $banker['id_banker'] ?>" <?= old('id_banker') == $banker['id_banker'] ? 'selected' : '' ?>><?= $banker['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors-insert.id_banker') ?>
            </div>
        </div>
    </div>

    <!-- Información del Sistema -->
    <h5 class="text-primary">Información del Sistema</h5>
    <div class="row">
       
        <div class="form-group col-md-4">
            <label for="selectStatus">Estado</label>
            <select class="form-control" id="selectStatus" name="status">
                <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Activo</option>
                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
    </div>
</form>

            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addUserForm');
        let input = form.querySelector('input.errors-insert, select.errors-insert, textarea.errors-insert');


        if (input) {
            document.getElementById('openModalButtonUser').click();
        }
        
      

    });

</script>