<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container pb-5" style="min-height: 80vh;">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 mb-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="fas fa-file-alt"></i> Formulario de PQRS</h3>
                </div>
                <div class="card-body">



                    <form action="<?= base_url('client/pqrs-sent/save') ?>" method="post" enctype="multipart/form-data">

                        <!-- Tipo de solicitud -->
                        <div class="form-group">
                            <label><i class="fas fa-list-alt"></i> Tipo de solicitud</label>
                            <select class="form-control" id="type_id" name="type_id" required>
                                <option value="">Seleccione un tipo</option>
                                <?php foreach ($request_types as $type): ?>
                                    <option value="<?= esc($type['id_type']) ?>" <?= old('type_id') == $type['id_type'] ? 'selected' : '' ?>>
                                        <?= esc($type['name']) ?> - <?= esc($type['description']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label><i class="fas fa-comment-dots"></i> Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required minlength="10"><?= old('description') ?></textarea>
                        </div>

                        <!-- Archivo adjunto -->
                        <div class="form-group text-center">
                            <label for="attachment" class="btn btn-primary btn-lg px-4 py-2"
                                style="background: linear-gradient(45deg, #007bff, #0056b3);
                                       border-radius: 30px;
                                       box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                                       transition: all 0.3s ease-in-out;
                                       cursor: pointer;">
                                <i class="fas fa-paperclip"></i> Seleccionar archivo
                            </label>
                            <input type="file" class="form-control-file d-none" id="attachment" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" required>
                            <p id="file-name" class="mt-2 text-muted">Ningún archivo seleccionado</p>
                        </div>

                        <!-- Botón de enviar -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-paper-plane"></i> Enviar PQRS
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos y script para mostrar el nombre del archivo seleccionado -->
<style>
    label:hover {
        transform: scale(1.05);
        opacity: 0.9;
    }
</style>

<script>
    document.getElementById("attachment").addEventListener("change", function() {
        var fileName = this.files[0] ? this.files[0].name : "Ningún archivo seleccionado";
        document.getElementById("file-name").innerText = fileName;
    });
</script>

<?= $this->endSection() ?>
