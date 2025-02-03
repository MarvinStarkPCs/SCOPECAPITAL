<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de sedes</h1>
<p class="mb-4">Aquí puedes gestionar las sedes del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de sedes</h6>
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
                    <i class="fas fa-plus-circle"></i> Agregar sede
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sedes as $sede): ?>
                    <tr>
                        <td><?= esc($sede['nombre']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Agregar sede -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Agregar sede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/sedes/add') ?>" method="post" id="addCategoryForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="inputCategoryName">Nombre</label>
                        <input type="text"
                               class="form-control <?= session('errors-insert.nombre') ? 'is-invalid errors-insert' : '' ?>"
                               id="inputCategoryName" name="nombre" placeholder="Nombre" value="<?= old('nombre') ?>">
                        <div class="invalid-feedback">
                            <?= session('errors-insert.nombre') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveCategoryButton">Guardar sede</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Editar sede -->
<?php foreach ($sedes as $sede): ?>
    <div class="modal fade" id="editModal-<?= $sede['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $sede['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $sede['id'] ?>">Editar sede</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('sedes/update/' . $sede['id']) ?>" id="editForm"
                          method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="editCategoryName-<?= $sede['id'] ?>">Nombre</label>
                            <input type="text"
                                   class="form-control <?= session('errors-edit.nombre') ? 'is-invalid errors-update' : '' ?>"
                                   id="editCategoryName-<?= $sede['id'] ?>" name="nombre"
                                   value="<?= esc($sede['nombre']) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.nombre') ?>
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

    <!-- Modal de Eliminar sede -->
    <div class="modal fade" id="deleteModal-<?= $sede['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $sede['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $sede['id'] ?>">Eliminar sede</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta sede?</p>
                    <p><strong><?= esc($sede['nombre']) ?></strong></p>
                </div>
                <div class="modal-footer">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="sedes/delete/<?php echo $sede['id']; ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('openModalButtonCategory').style.display = 'none';
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
