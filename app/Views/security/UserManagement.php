<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Usuarios</h1>
<p class="mb-4">Aquí puedes gestionar los usuarios del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonUser" class="btn btn-primary" data-toggle="modal"
                    data-target="#addUserModal">
                <i class="fas fa-user-plus"></i> Agregar Usuario
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre y apellido</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></td>
                        <td><?= esc($usuario['identificacion']) ?></td>
                        <td><?= esc($usuario['correo']) ?></td>
                        <td><?= esc($usuario['nombre_perfil']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-<?= $usuario['id'] ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $usuario['id'] ?>" title="Editar usuario">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $usuario['id'] ?>" title="Eliminar usuario">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Agregar Usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('gestion-usuarios/addusuarios/') ?>" method="post" id="addUserForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Nombres</label>
                            <input type="text"
                                   class="form-control <?= session('errors-insert.nombres') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputName" name="nombres" placeholder="Nombre" value="<?= old('nombres') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.nombres') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputLastname">Apellidos</label>
                            <input type="text"
                                   class="form-control <?= session('errors-insert.apellidos') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputLastname" name="apellidos" placeholder="Apellidos"
                                   value="<?= old('apellidos') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.apellidos') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputIdentity">Identidad(C.C)</label>
                            <input type="number"
                                   class="form-control <?= session('errors-insert.identidad') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputIdentity" name="identidad" placeholder="Identidad"
                                   value="<?= old('identidad') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.identidad') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail">Correo Electrónico</label>
                            <input type="email"
                                   class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputEmail" name="email" placeholder="Correo Electrónico"
                                   value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.email') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputPhone">Teléfono</label>
                            <input type="tel"
                                   class="form-control <?= session('errors-insert.telefono') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputPhone" name="telefono" placeholder="Teléfono"
                                   value="<?= old('telefono') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.telefono') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputAddress">Dirección</label>
                            <input type="text"
                                   class="form-control <?= session('errors-insert.direccion') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputAddress" name="direccion" placeholder="Dirección"
                                   value="<?= old('direccion') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.direccion') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectRole">Perfil</label>
                        <select class="form-control <?= session('errors-insert.perfil_id') ? 'is-invalid errors-insert' : '' ?>"
                                id="selectRole" name="perfil_id">
                            <?php foreach ($perfiles as $perfil): ?>
                                <option value="<?= esc($perfil['id']) ?>" <?= old('perfil_id') == $perfil['id'] ? 'selected' : '' ?>>
                                    <?= esc($perfil['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.perfil_id') ?>
                        </div>
                    </div>
                    <div style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                        <strong>Información:</strong> La contraseña por defecto de cada usuario es
                        <strong>SIBI2024</strong> y se requiere activación del correo electrónico.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveUserButton">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Detalles de Usuario -->
<?php foreach ($usuarios as $usuario): ?>
    <div class="modal fade" id="detailsModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="detailsModalLabel-<?= $usuario['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $usuario['id'] ?>">Detalles del Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName">Nombres</label>
                                <input type="text" class="form-control" id="detailsName"
                                       value="<?= esc($usuario['nombres']) ?> <?= esc($usuario['apellidos']) ?>"
                                       readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsIdentity">Identidad(C.C)</label>
                                <input type="text" class="form-control" id="detailsIdentity"
                                       value="<?= esc($usuario['identificacion']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsEmail">Correo Electrónico</label>
                                <input type="email" class="form-control" id="detailsEmail"
                                       value="<?= esc($usuario['correo']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsPhone">Teléfono</label>
                                <input type="text" class="form-control" id="detailsPhone"
                                       value="<?= esc($usuario['telefono']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsAddress">Dirección</label>
                                <input type="text" class="form-control" id="detailsAddress"
                                       value="<?= esc($usuario['direccion']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsRole">Perfil</label>
                                <input type="text" class="form-control" id="detailsRole"
                                       value="<?= esc($usuario['nombre_perfil']) ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Editar Usuario -->
    <div class="modal fade" id="editModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $usuario['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $usuario['id'] ?>">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('gestion-usuarios/editusuario/' . $usuario['id']) ?>" id="editForm"
                          method="post">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $usuario['id'] ?>">Nombre</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.nombres') ? 'is-invalid errors-update' : '' ?>"
                                       id="editName-<?= $usuario['id'] ?>" name="nombre"
                                       value="<?= esc($usuario['nombres']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.nombres') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editLastname-<?= $usuario['id'] ?>">Apellido</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.apellidos') ? 'is-invalid errors-update' : '' ?>"
                                       id="editLastname-<?= $usuario['id'] ?>" name="apellido"
                                       value="<?= esc($usuario['apellidos']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.apellido') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $usuario['id'] ?>">Identidad (C.C)</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.identidad') ? 'is-invalid errors-update' : '' ?>"
                                       id="editIdentity-<?= $usuario['id'] ?>" name="identidad"
                                       value="<?= esc($usuario['identificacion']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.identidad') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editEmail-<?= $usuario['id'] ?>">Correo Electrónico</label>
                                <input type="email"
                                       class="form-control <?= session('errors-edit.correo') ? 'is-invalid errors-update' : '' ?>"
                                       id="editEmail-<?= $usuario['id'] ?>" name="correo"
                                       value="<?= esc($usuario['correo']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.correo') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editPhone-<?= $usuario['id'] ?>">Teléfono</label>
                                <input type="tel"
                                       class="form-control <?= session('errors-edit.telefono') ? 'is-invalid errors-update' : '' ?>"
                                       id="editPhone-<?= $usuario['id'] ?>" name="telefono"
                                       value="<?= esc($usuario['telefono']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.telefono') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editAddress-<?= $usuario['id'] ?>">Dirección</label>
                                <input type="text"
                                       class="form-control <?= session('errors-edit.direccion') ? 'is-invalid errors-update' : '' ?>"
                                       id="editAddress-<?= $usuario['id'] ?>" name="direccion"
                                       value="<?= esc($usuario['direccion']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.direccion') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editRole-<?= $usuario['id'] ?>">Perfil</label>
                            <select class="form-control <?= session('errors-edit.perfil_id') ? 'is-invalid errors-update' : '' ?>"
                                    id="editRole-<?= $usuario['id'] ?>" name="perfil_id">
                                <?php foreach ($perfiles as $perfil): ?>
                                    <option value="<?= esc($perfil['id']) ?>" <?= old('perfil_id') == $perfil['id'] ? 'selected' : '' ?>>

                                        <?= esc($perfil['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-edit.perfil_id') ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Eliminar Usuario -->
    <div class="modal fade" id="deleteModal-<?= $usuario['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $usuario['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $usuario['id'] ?>">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este usuario?</p>
                    <p><strong><?= esc($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></strong></p>
                </div>
                <div class="modal-footer">

                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="gestion-usuarios/deleteusuario/<?php echo $usuario['id']; ?>" class="btn btn-danger">Eliminar</a>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addUserForm');
        let input = form.querySelector('input.errors-insert');

        if (input) {
            // Si existe, hace clic en el botón
            document.getElementById('openModalButtonUser').click();
        }
        let formUpdate = document.getElementById('editForm');
        let inputUpdate = formUpdate ? formUpdate.querySelector('input.errors-update') : null;
        if (inputUpdate){
            let target = localStorage.getItem("data_target");
            const elements = document.querySelectorAll(`[data-target="${target}"]`);
            elements.forEach(element => {
                element.click();
            });
        }
        document.querySelectorAll('#editButton').forEach(button => {
            button.addEventListener('click', function () {
                const dataTargetValue = this.getAttribute('data-target');
                localStorage.setItem("data_target", dataTargetValue);
            });
        });


    });

</script>

<?= $this->endSection() ?>
