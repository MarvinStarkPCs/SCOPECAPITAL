<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Estados</h1>
<p class="mb-4">Aquí puedes gestionar los Estados del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Estados</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
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
                <?php foreach ($estados as $estado): ?>
                    <tr>
                        <td><?= esc($estado['nombre']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal de Agregar Estado -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Agregar Estado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/estados/add') ?>" method="post" id="addCategoryForm">
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
                        <button type="submit" class="btn btn-primary" id="saveCategoryButton">Guardar Estado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Editar Estado -->
<?php foreach ($estados as $estado): ?>
    <div class="modal fade" id="editModal-<?= $estado['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $estado['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $estado['id'] ?>">Editar Estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('estados/update/' . $estado['id']) ?>" id="editForm"
                          method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="editCategoryName-<?= $estado['id'] ?>">Nombre</label>
                            <input type="text"
                                   class="form-control <?= session('errors-edit.nombre') ? 'is-invalid errors-update' : '' ?>"
                                   id="editCategoryName-<?= $estado['id'] ?>" name="nombre"
                                   value="<?= esc($estado['nombre']) ?>">
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

    <!-- Modal de Eliminar Estado -->
    <div class="modal fade" id="deleteModal-<?= $estado['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $estado['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $estado['id'] ?>">Eliminar Estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este estado?</p>
                    <p><strong><?= esc($estado['nombre']) ?></strong></p>
                </div>
                <div class="modal-footer">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="estados/delete/<?php echo $estado['id']; ?>" class="btn btn-danger">Eliminar</a>
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
