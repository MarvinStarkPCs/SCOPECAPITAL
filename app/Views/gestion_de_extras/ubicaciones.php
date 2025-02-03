<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Ubicaciones</h1>
<p class="mb-4">Aquí puedes gestionar las ubicaciones del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Ubicaciones</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <!-- Grupo de botones alineados a la izquierda -->
            <div>
                <!-- Botón de Atrás -->
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
                <!-- Botón para descargar Excel -->
                <a href="<?= base_url('/ubicaciones/ubicaciones-excel') ?>" class="btn btn-success ml-2">
                    <i class="fas fa-file-excel"></i> Descargar Excel
                </a>
            </div>
            <!-- Grupo de botones alineados a la derecha -->
            <div>
                <button type="button" id="openModalButtonUbicacion" class="btn btn-primary" data-toggle="modal" data-target="#addUbicacionModal">
                    <i class="fas fa-plus"></i> Agregar Ubicación
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre de Ubicación</th>
                    <th>Nombre de Sede</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($ubicaciones as $ubicacion): ?>
                    <tr>
                        <td><?= esc($ubicacion['nombre_ubicacion']) ?></td>
                        <td><?= esc($ubicacion['nombre_sede']) ?></td>
                        <td>
                            <!-- Botón de Editar -->
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#editModal-<?= $ubicacion['id'] ?>" title="Editar ubicación">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- Botón de Eliminar -->
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $ubicacion['id'] ?>" title="Eliminar ubicación">
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

<!-- Modal de Agregar Ubicación -->
<div class="modal fade" id="addUbicacionModal" tabindex="-1" role="dialog" aria-labelledby="addUbicacionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUbicacionModalLabel">Agregar Ubicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('ubicaciones/store') ?>" method="post" id="addUbicacionForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="inputName">Nombre de Ubicación</label>
                        <input type="text" class="form-control <?= session('errors-insert.nombre_ubicacion') ? 'is-invalid' : '' ?>" id="inputName" name="nombre_ubicacion" placeholder="Nombre de Ubicación" value="<?= old('nombre_ubicacion') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors-insert.nombre_ubicacion') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectSede">Sede</label>
                        <select class="form-control <?= session('errors-insert.sede_id') ? 'is-invalid' : '' ?>" id="selectSede" name="sede_id">
                            <?php foreach ($sedes as $sede): ?>
                                <option value="<?= esc($sede['id']) ?>" <?= old('sede_id') == $sede['id'] ? 'selected' : '' ?>>
                                    <?= esc($sede['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.sede_id') ?>
                        </div>
                    </div>

                    <div style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                        <strong>Información:</strong> Asegúrate de ingresar todos los datos correctamente antes de guardar la ubicación.
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveUbicacionButton">Guardar Ubicación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Editar Ubicación -->
<?php foreach ($ubicaciones as $ubicacion): ?>
    <div class="modal fade" id="editModal-<?= $ubicacion['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $ubicacion['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $ubicacion['id'] ?>">Editar Ubicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('ubicaciones/update/'.$ubicacion['id']) ?>" method="post" id="editUbicacionForm-<?= $ubicacion['id'] ?>">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="editName-<?= $ubicacion['id'] ?>">Nombre de Ubicación</label>
                            <input type="text" class="form-control <?= session('errors-update.nombre_ubicacion') ? 'is-invalid' : '' ?>" id="editName-<?= $ubicacion['id'] ?>" name="nombre_ubicacion" placeholder="Nombre de Ubicación" value="<?= esc($ubicacion['nombre_ubicacion']) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-update.nombre_ubicacion') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editSede-<?= $ubicacion['id'] ?>">Sede</label>
                            <select class="form-control <?= session('errors-update.sede_id') ? 'is-invalid' : '' ?>" id="editSede-<?= $ubicacion['id'] ?>" name="sede_id">
                                <?php foreach ($sedes as $sede): ?>
                                    <option value="<?= esc($sede['id']) ?>" <?= $ubicacion['sede_id'] == $sede['id'] ? 'selected' : '' ?>>
                                        <?= esc($sede['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-update.sede_id') ?>
                            </div>
                        </div>

                        <div style="border: 1px solid #17a2b8; padding: 10px; background-color: #e9f7fc; border-radius: 5px; margin-bottom: 15px;">
                            <strong>Información:</strong> Asegúrate de revisar los datos antes de guardar los cambios.
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
<?php endforeach; ?>

<!-- Modal de Eliminar Ubicación -->
<?php foreach ($ubicaciones as $ubicacion): ?>
    <div class="modal fade" id="deleteModal-<?= $ubicacion['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $ubicacion['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $ubicacion['id'] ?>">Eliminar Ubicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta ubicación?</p>
                    <p><strong><?= esc($ubicacion['nombre_ubicacion']) ?></strong></p>
                </div>
                <div class="modal-footer">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="<?= base_url('ubicaciones/delete/'.$ubicacion['id']) ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // IDs de los botones que se deben remover
        const botonesParaRemover = ['editModal-1', 'deleteModal-1', 'editModal-3',  'deleteModal-3','editModal-2','deleteModal-2'];

        botonesParaRemover.forEach(botonId => {
            const boton = document.querySelector(`button[data-target="#${botonId}"]`);
            if (boton) {
                boton.remove(); // Elimina el botón del DOM
            }
        });
    });

</script>
<?= $this->endSection() ?>
