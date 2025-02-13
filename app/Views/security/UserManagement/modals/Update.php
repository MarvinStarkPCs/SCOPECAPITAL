<?php foreach ($users as $user): ?>

  
  <!-- Modal de Editar user -->
  <div class="modal fade" id="editModal-<?= $user['id_user'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $user['id_user'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $user['id_user'] ?>">Editar user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('gestion-users/edituser/' . $user['id_user']) ?>" id="editForm"
                          method="post">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $user['id_user'] ?>">name</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.name') ? 'is-invalid errors-update' : '' ?>"
                                       id="editName-<?= $user['id_user'] ?>" name="name"
                                       value="<?= esc($user['name']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.name') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editLastname-<?= $user['id_user'] ?>">Apellido</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.last_name') ? 'is-invalid errors-update' : '' ?>"
                                       id="editLastname-<?= $user['id_user'] ?>" name="apellido"
                                       value="<?= esc($user['last_name']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.apellido') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $user['id_user'] ?>">Identidad (C.C)</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.identidad') ? 'is-invalid errors-update' : '' ?>"
                                       id="editIdentity-<?= $user['id_user'] ?>" name="identidad"
                                       value="<?= esc($user['identification']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.identidad') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editEmail-<?= $user['id_user'] ?>">email Electrónico</label>
                                <input type="email"
                                       class="form-control <?= session('errors-edit.email') ? 'is-invalid errors-update' : '' ?>"
                                       id="editEmail-<?= $user['id_user'] ?>" name="email"
                                       value="<?= esc($user['email']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.email') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editPhone-<?= $user['id_user'] ?>">Teléfono</label>
                                <input type="tel"
                                       class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-update' : '' ?>"
                                       id="editPhone-<?= $user['id_user'] ?>" name="phone"
                                       value="<?= esc($user['phone']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.phone') ?>
                                </div>
                            </div>
                            <!-- <div class="form-group col-md-6">
                                <label for="editAddress-< ?= $user['id_user'] ?>">Dirección</label>
                                <input type="text"
                                       class="form-control < ?= session('errors-edit.direccion') ? 'is-invalid errors-update' : '' ?>"
                                       id="editAddress-< ?= $user['id_user'] ?>" name="direccion"
                                       value="< ?= esc($user['direccion']) ?>">
                                <div class="invalid-feedback">
                                    < ?= session('errors-edit.direccion') ?>
                                </div>
                            </div> -->
                        </div>
                        <!-- <div class="form-group">
                            <label for="editRole-< ?= $user['id_user'] ?>">rol</label>
                            <select class="form-control < ?= session('errors-edit.rol_id') ? 'is-invalid errors-update' : '' ?>"
                                    id="editRole-< ?= $user['id_user'] ?>" name="rol_id">
                                < ?php foreach ($roles as $rol): ?>
                                    <option value="< ?= esc($rol['id_role']) ?>" < ? = old('id_role') == $rol['id_role'] ? 'selected' : '' ?>>

                                        < ? = esc($rol['name']) ?>
                                    </option>
                                < php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                < ?= session('errors-edit.rol_id') ?>
                            </div>
                        </div> -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    console.log('Update modal');
</script>