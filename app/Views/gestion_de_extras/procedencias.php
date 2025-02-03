<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de procedencias</h1>
<p class="mb-4">Aquí puedes gestionar las procedencias del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de procedencias</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
            </div>
            <div>
                <button type="button" id="openModalButtonCategory" class="btn btn-primary" data-toggle="modal"
                        data-target="#addCategoryModal">
                    <i class="fas fa-plus-circle"></i> Agregar procedencia
                </button>
            </div>




        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>NIT O CC</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>

                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($procedencias as $procedencia): ?>
                    <tr>
                        <td><?= esc($procedencia['nombre']) ?></td>
                        <td><?= esc($procedencia['nit_o_cc']) ?></td>
                        <td><?= esc($procedencia['direccion']) ?></td>
                        <td><?= esc($procedencia['telefono']) ?></td>

                        <td class="text-center">
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-<?= $procedencia['id'] ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal"
                                    data-target="#editModal-<?= $procedencia['id'] ?>" title="Editar procedencia">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $procedencia['id'] ?>" title="Eliminar procedencia">
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

<!-- Modal de Agregar procedencia -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Agregar procedencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/procedencias/add') ?>" method="post" id="addCategoryForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCategoryName">Nombre</label>
                            <input type="text" class="form-control <?= session('errors-insert.nombre') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputCategoryName" name="nombre" placeholder="Nombre" value="<?= old('nombre') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.nombre') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputNitOCC">NIT O CC</label>
                            <input type="text" class="form-control <?= session('errors-insert.nit_o_cc') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputNitOCC" name="nit_o_cc" placeholder="NIT O CC" value="<?= old('nit_o_cc') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.nit_o_cc') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputDireccion">Dirección</label>
                            <input type="text" class="form-control <?= session('errors-insert.direccion') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputDireccion" name="direccion" placeholder="Dirección" value="<?= old('direccion') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.direccion') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputTelefono">Teléfono</label>
                            <input type="text" class="form-control <?= session('errors-insert.telefono') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputTelefono" name="telefono" placeholder="Teléfono" value="<?= old('telefono') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.telefono') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputRepresentante">Representante</label>
                            <input type="text" class="form-control <?= session('errors-insert.representante') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputRepresentante" name="representante" placeholder="Representante" value="<?= old('representante') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.representante') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCorreo">Correo</label>
                            <input type="email" class="form-control <?= session('errors-insert.correo') ? 'is-invalid errors-insert' : '' ?>"
                                   id="inputCorreo" name="correo" placeholder="Correo" value="<?= old('correo') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.correo') ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveCategoryButton">Guardar procedencia</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Editar procedencia -->
<?php foreach ($procedencias as $procedencia): ?>
    <div class="modal fade" id="editModal-<?= $procedencia['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $procedencia['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $procedencia['id'] ?>">Editar procedencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('procedencias/update/' . $procedencia['id']) ?>" id="editForm" method="post">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editCategoryName-<?= $procedencia['id'] ?>">Nombre</label>
                                <input type="text" class="form-control <?= session('errors-edit.nombre') ? 'is-invalid' : '' ?>"
                                       id="editCategoryName-<?= $procedencia['id'] ?>" name="nombre"
                                       value="<?= esc($procedencia['nombre']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.nombre') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editNitOCC-<?= $procedencia['id'] ?>">NIT O CC</label>
                                <input type="text" class="form-control <?= session('errors-edit.nit_o_cc') ? 'is-invalid' : '' ?>"
                                       id="editNitOCC-<?= $procedencia['id'] ?>" name="nit_o_cc"
                                       value="<?= esc($procedencia['nit_o_cc']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.nit_o_cc') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editDireccion-<?= $procedencia['id'] ?>">Dirección</label>
                                <input type="text" class="form-control <?= session('errors-edit.direccion') ? 'is-invalid' : '' ?>"
                                       id="editDireccion-<?= $procedencia['id'] ?>" name="direccion"
                                       value="<?= esc($procedencia['direccion']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.direccion') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editTelefono-<?= $procedencia['id'] ?>">Teléfono</label>
                                <input type="text" class="form-control <?= session('errors-edit.telefono') ? 'is-invalid' : '' ?>"
                                       id="editTelefono-<?= $procedencia['id'] ?>" name="telefono"
                                       value="<?= esc($procedencia['telefono']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.telefono') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editRepresentante-<?= $procedencia['id'] ?>">Representante</label>
                                <input type="text" class="form-control <?= session('errors-edit.representante') ? 'is-invalid' : '' ?>"
                                       id="editRepresentante-<?= $procedencia['id'] ?>" name="representante"
                                       value="<?= esc($procedencia['representante']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.representante') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editCorreo-<?= $procedencia['id'] ?>">Correo</label>
                                <input type="email" class="form-control <?= session('errors-edit.correo') ? 'is-invalid' : '' ?>"
                                       id="editCorreo-<?= $procedencia['id'] ?>" name="correo"
                                       value="<?= esc($procedencia['correo']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.correo') ?>
                                </div>
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

    <!-- Modal de Eliminar procedencia -->
    <div class="modal fade" id="deleteModal-<?= $procedencia['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $procedencia['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $procedencia['id'] ?>">Eliminar procedencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta procedencia?</p>
                    <p><strong><?= esc($procedencia['nombre']) ?></strong></p>
                </div>
                <div class="modal-footer">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="<?= base_url('procedencias/delete/' . $procedencia['id']) ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal de Detalles -->
<?php foreach ($procedencias as $procedencia): ?>
    <div class="modal fade" id="detailsModal-<?= $procedencia['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="detailsModalLabel-<?= $procedencia['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $procedencia['id'] ?>">Detalles de procedencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <?= esc($procedencia['nombre']) ?></p>
                    <p><strong>NIT O CC:</strong> <?= esc($procedencia['nit_o_cc']) ?></p>
                    <p><strong>Dirección:</strong> <?= esc($procedencia['direccion']) ?></p>
                    <p><strong>Teléfono:</strong> <?= esc($procedencia['telefono']) ?></p>
                    <p><strong>Representante:</strong> <?= esc($procedencia['representante']) ?></p>
                    <p><strong>Correo:</strong> <?= esc($procedencia['correo']) ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addCategoryForm');
        let input = form.querySelector('input.errors-insert');

        if (input) {
            // Si existe, hace clic en el botón
            document.getElementById('openModalButtonCategory').click();
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
