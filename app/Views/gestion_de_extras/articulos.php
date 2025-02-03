<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">Gestión de Artículos</h1>
<p class="mb-4">Aquí puedes gestionar los artículos del sistema.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Artículos</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <!-- Botón de Atrás -->
            <div>
                <a href="<?= base_url('gestion-extras') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Atrás
                </a>
            </div>

            <!-- Grupo de botones alineados a la derecha -->
            <div>
                <!-- Botón para descargar Excel -->
                <a href="<?= base_url('/articulos/articulos-excel') ?>" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Descargar Excel
                </a>
                <!-- Botón de Agregar Artículo -->
                <button type="button" id="openModalButtonArticle" class="btn btn-primary" data-toggle="modal" data-target="#addArticleModal">
                    <i class="fas fa-plus"></i> Agregar Artículo
                </button>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Descripción</th>
                    <th>Valor Unitario</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($articulos as $articulo): ?>
                    <tr>
                        <td><?= esc($articulo['nombre']) ?></td>
                        <td><?= esc($articulo['nombre_marca']) ?></td>
                        <td><?= esc($articulo['modelo']) ?></td>
                        <td><?= esc($articulo['descripcion']) ?></td>
                        <td><?= esc($articulo['valor_unitario'].' $') ?></td>
                        <td><?= esc($articulo['nombre_categoria']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal" data-target="#detailsModal-<?= $articulo['id_articulo'] ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" data-target="#editModal-<?= $articulo['id_articulo'] ?>" title="Editar artículo">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-<?= $articulo['id_articulo'] ?>" title="Eliminar artículo">
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

<!-- Modal de Agregar Artículo -->
<!-- Modal HTML -->
<div class="modal fade" id="addArticleModal" tabindex="-1" role="dialog" aria-labelledby="addArticleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addArticleModalLabel">Agregar Artículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/articulos/add') ?>" method="post" id="addArticleForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Nombre</label>
                            <input type="text" class="form-control <?= session('errors-insert.nombre') ? 'is-invalid' : '' ?>" id="inputName" name="nombre" placeholder="Nombre" value="<?= old('nombre') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.nombre') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputModel">Modelo</label>
                            <input type="text" class="form-control <?= session('errors-insert.modelo') ? 'is-invalid' : '' ?>" id="inputModel" name="modelo" placeholder="Modelo" value="<?= old('modelo') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.modelo') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputDescription">Descripción</label>
                            <textarea class="form-control <?= session('errors-insert.descripcion') ? 'is-invalid' : '' ?>" id="inputDescription" name="descripcion" rows="3" placeholder="Descripción"><?= old('descripcion') ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors-insert.descripcion') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputUnitValue">Valor Unitario</label>
                            <input type="text" class="form-control <?= session('errors-insert.valor_unitario') ? 'is-invalid errors-insert-article' : '' ?>" id="inputUnitValue" name="valor_unitario" placeholder="Valor Unitario" value="<?= old('valor_unitario') ?>" oninput="formatCurrency(this)">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.valor_unitario') ?>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="selectCategory">Categoría</label>
                        <select class="form-control <?= session('errors-insert.categoria_id') ? 'is-invalid' : '' ?>" id="selectCategory" name="categoria_id">
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= esc($categoria['id']) ?>" <?= old('categoria_id') == $categoria['id'] ? 'selected' : '' ?>>
                                    <?= esc($categoria['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.categoria_id') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="selectBrand">Marca</label>
                        <select class="form-control select2 <?= session('errors-insert.marca_id') ? 'is-invalid' : '' ?>" id="selectBrand" name="marca_id">
                            <?php foreach ($marcas as $marca): ?>
                                <option value="<?= esc($marca['id']) ?>" <?= old('marca_id') == $marca['id'] ? 'selected' : '' ?>>
                                    <?= esc($marca['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-insert.marca_id') ?>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="saveArticleButton">Guardar Artículo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Detalles de Artículo -->
<?php foreach ($articulos as $articulo): ?>
    <div class="modal fade" id="detailsModal-<?= $articulo['id_articulo'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $articulo['id_articulo'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $articulo['id_articulo'] ?>">Detalles del Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName">Nombre</label>
                                <input type="text" class="form-control" id="detailsName" value="<?= esc($articulo['nombre']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsCategory">Marca</label>
                                <input type="text" class="form-control" id="detailsMarca" value="<?= esc($articulo['nombre_marca']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsName">Modelo</label>
                                <input type="text" class="form-control" id="detailsName" value="<?= esc($articulo['modelo']) ?>" readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="detailsDescription">Descripción</label>
                                <textarea class="form-control" id="detailsDescription" rows="3" readonly><?= esc($articulo['descripcion']) ?></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="detailsUnitValue">Valor Unitario</label>
                                <input type="text" class="form-control" id="detailsUnitValue" value="<?= esc($articulo['valor_unitario'].'$') ?> " readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsCategory">Categoría</label>
                                <input type="text" class="form-control" id="detailsCategory" value="<?= esc($articulo['nombre_categoria']) ?>" readonly>
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
<?php endforeach; ?>

<!-- Modal de Editar Artículo -->
<?php foreach ($articulos as $articulo): ?>
    <div class="modal fade" id="editModal-<?= $articulo['id_articulo'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $articulo['id_articulo'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $articulo['id_articulo'] ?>">Editar Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('articulos/update/'.$articulo['id_articulo']) ?>" method="post" id="editArticleForm-<?= $articulo['id_articulo'] ?>">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $articulo['id_articulo'] ?>">Nombre</label>
                                <input type="text" class="form-control <?= session('errors-edit.nombre') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editName-<?= $articulo['id_articulo'] ?>" name="nombre"
                                       placeholder="Nombre" value="<?= esc($articulo['nombre']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.nombre') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editBrand-<?= $articulo['id_articulo'] ?>">Marca</label>
                                <input type="text" class="form-control <?= session('errors-edit.marca') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editBrand-<?= $articulo['id_articulo'] ?>" name="marca"
                                       placeholder="Marca" value="<?= esc($articulo['nombre_marca']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.marca') ?>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="editDescription-<?= $articulo['id_articulo'] ?>">Descripción</label>
                                <textarea class="form-control <?= session('errors-edit.descripcion') ? 'is-invalid errors-edit' : '' ?>" 
                                          id="editDescription-<?= $articulo['id_articulo'] ?>" name="descripcion"
                                          rows="3" placeholder="Descripción"><?= esc($articulo['descripcion']) ?></textarea>
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.descripcion') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editUnitValue-<?= $articulo['id_articulo'] ?>">Valor Unitario</label>
                                <input type="number" class="form-control <?= session('errors-edit.valor_unitario') ? 'is-invalid errors-edit' : '' ?>" 
                                       id="editUnitValue-<?= $articulo['id_articulo'] ?>" name="valor_unitario" 
                                       placeholder="Valor Unitario" value="<?= esc($articulo['valor_unitario']) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-edit.valor_unitario') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="editCategory-<?= $articulo['id_articulo'] ?>">Categoría</label>
                            <select class="form-control <?= session('errors-edit.categoria_id') ? 'is-invalid errors-edit' : '' ?>" 
                                    id="editCategory-<?= $articulo['id_articulo'] ?>" name="categoria_id">
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= esc($categoria['id']) ?>" <?= $articulo['id_categoria'] == $categoria['id'] ? 'selected' : '' ?>>
                                        <?= esc($categoria['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= session('errors-edit.categoria_id') ?>
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


<!-- Modal de Eliminar Artículo -->
<?php foreach ($articulos as $articulo): ?>
    <div class="modal fade" id="deleteModal-<?= $articulo['id_articulo'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $articulo['id_articulo'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $articulo['id_articulo'] ?>">Eliminar Artículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar el artículo <strong><?= esc($articulo['nombre']) ?></strong>? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">

                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="articulos/delete/<?php echo $articulo['id_articulo']; ?>" class="btn btn-danger">Eliminar</a>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addArticleForm');
        let input = form.querySelector('input.errors-insert-article');
        if (input) {
            // Si existe, hace clic en el botón
            document.getElementById('openModalButtonArticle').click();
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
    function formatCurrency(input) {
        // Remove any non-digit characters
        let value = input.value.replace(/[^0-9.]/g, '');

        // Convert to float and format as currency
        value = parseFloat(value).toFixed(2);

        // Add currency formatting (e.g., $1,234.56)
        if (!isNaN(value)) {
            input.value = value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(/^/, "$");
        } else {
            input.value = '';
        }
    }

</script>
<?= $this->endSection() ?>
