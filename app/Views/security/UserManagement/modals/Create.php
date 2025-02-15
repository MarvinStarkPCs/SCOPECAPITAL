<!-- Modal de Agregar user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./usermanagement/add" method="post" id="addUserForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Names</label>
                            <input type="text"
                                class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputName" name="name" placeholder="name" value="<?= old('name') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.name') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastname">Last Name</label>
                            <input type="text"
                                class="form-control <?= session('errors-insert.last_name') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputLastname" name="last_name" placeholder="last name"
                                value="<?= old('last_name') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.last_name') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputIdentity">identification(C.C)</label>
                            <input type="number"
                                class="form-control <?= session('errors-insert.identification') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputIdentity" name="identification" placeholder="Identification"
                                value="<?= old('identification') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.identification') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email"
                                class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputEmail" name="email" placeholder="email" value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.email') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Phone</label>
                            <input type="tel"
                                class="form-control <?= session('errors-insert.phone') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputPhone" name="phone" placeholder="Phone" value="<?= old('phone') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.phone') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
    <label for="inputAddress">Address</label>
    <textarea class="form-control <?= session('errors-insert.address') ? 'is-invalid errors-insert' : '' ?>" 
        id="inputAddress" name="address" placeholder="Address"><?= old('address') ?></textarea>
    <div class="invalid-feedback">
        <?= session('errors-insert.address') ?>
    </div>
</div>

                    </div>
                    <div class="form-group">
                        <label for="selectRole">Seleted Rol</label>
                        <select
                            class="form-control <?= session('errors-insert.id_role') ? 'is-invalid errors-insert' : '' ?>"
                            id="selectRole" name="id_role">
                            <option value="">Selecione un Rol</option>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?= esc($rol['id_role']) ?>" <?= old('id_role') == $rol['id_role'] ? 'selected' : '' ?>>
                                    <?= esc($rol['role_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.id_role') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectStatus">Seleted Status</label>
                        <select class="form-control <?= session('errors-insert.status') ? 'is-invalid errors-insert' : '' ?>"
                            id="selectStatus" name="status">
                            <option value="">Seleccione un status</option>
                            <option value="active" <?= old('status', 'active') == 'active' ? 'selected' : '' ?>>Activo
                            </option>
                            <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.status') ?>
                        </div>
                    </div>
                    <div
                        style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                        <strong>Information:</strong>
                        Email activation is required.
                        Remember that if you want to add balance to the user, they must have the client role.
                        The activation and password change must be done via email.

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveUserButton">Guardar user</button>
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