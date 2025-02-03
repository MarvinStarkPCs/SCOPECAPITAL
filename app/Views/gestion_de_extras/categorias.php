<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Categorías</h1>
<p class="mb-4">Aquí puedes gestionar las categorías del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Categorías</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <!-- Botón de Atrás -->
            <div>
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
            </div>
            <div>
                <!-- Botón para agregar una categoría -->
                <button type="button" id="openModalButtonCategory" class="btn btn-primary" data-toggle="modal"
                        data-target="#addCategoryModal">
                    <i class="fas fa-plus-circle"></i> Agregar Categoría
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= esc($categoria['nombre']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $categoria['id'] ?>" title="Editar categoría">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $categoria['id'] ?>" title="Eliminar categoría">
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

<!-- Modal de Agregar Categoría -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Agregar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/categorias/add') ?>" method="post" id="addCategoryForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="inputCategoryName">Nombre</label>
                        <input type="text"
                               class="form-control <?= session('errors-insert.nombre') ? 'is-invalid errors-insert' : '' ?>"
                               id="inputCategoryName" name="nombre" placeholder="Nombre" value="<?= old('nombre') ?>" required>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.nombre') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveCategoryButton">Guardar Categoría</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Editar Categoría -->
<?php foreach ($categorias as $categoria): ?>
    <div class="modal fade" id="editModal-<?= $categoria['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="editModalLabel-<?= $categoria['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $categoria['id'] ?>">Editar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('categorias/update/' . $categoria['id']) ?>" id="editForm"
                          method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="editCategoryName-<?= $categoria['id'] ?>">Nombre</label>
                            <input type="text"
                                   class="form-control <?= session('errors-edit.nombre') ? 'is-invalid errors-update' : '' ?>"
                                   id="editCategoryName-<?= $categoria['id'] ?>" name="nombre"
                                   value="<?= esc($categoria['nombre']) ?>" required>
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

    <!-- Modal de Eliminar Categoría -->
    <div class="modal fade" id="deleteModal-<?= $categoria['id'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $categoria['id'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $categoria['id'] ?>">Eliminar Categoría</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
                    <p><strong><?= esc($categoria['nombre']) ?></strong></p>
                </div>
                <div class="modal-footer">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="categorias/delete/<?php echo $categoria['id']; ?>" class="btn btn-danger">Eliminar</a>
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
