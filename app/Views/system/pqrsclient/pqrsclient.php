<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container pb-5" style="min-height: 80vh;">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 mb-5">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="fas fa-file-alt"></i> Feedback Form</h3>
                </div>
                <div class="card-body">

                    <!-- FORMULARIO SIN ACTION NI METHOD -->
                    <form id="pqrs-form" enctype="multipart/form-data">

                        <!-- Tipo de solicitud -->
                        <div class="form-group">
                            <label><i class="fas fa-list-alt"></i> Type of PQRS</label>
                            <select class="form-control" id="type_id" name="type_id">
                                <option value="">Select a type</option>
                                <?php foreach ($request_types as $type): ?>
                                    <option value="<?= esc($type['id_type']) ?>" <?= old('type_id') == $type['id_type'] ? 'selected' : '' ?>>
                                        <?= esc($type['name']) ?> - <?= esc($type['description']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label><i class="fas fa-comment-dots"></i> Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?= old('description') ?></textarea>
                        </div>

                        <!-- Archivo adjunto -->
                        <div class="form-group text-center">
                            <label for="attachment" class="btn btn-primary btn-lg px-4 py-2"
                                   style="background: linear-gradient(45deg, #007bff, #0056b3);
                                          border-radius: 30px;
                                          box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                                          transition: all 0.3s ease-in-out;
                                          cursor: pointer;">
                                <i class="fas fa-paperclip"></i> Upload file
                            </label>
                            <input type="file" class="form-control-file d-none" id="attachment" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                            <p id="file-name" class="mt-2 text-muted">No file selected.</p>
                        </div>

                        <!-- Botón de enviar -->
                        <div class="text-center">
                            <button type="button" class="btn btn-success btn-lg" onclick="validarYEnviar()">
                                <i class="fas fa-paper-plane"></i> Send PQRS
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- VALIDACIÓN Y ENVÍO DINÁMICO -->
<script>
    function validarYEnviar() {
        let form = document.getElementById('pqrs-form');
        let tipo = document.getElementById('type_id').value;
        let descripcion = document.getElementById('description').value.trim();
        let archivo = document.getElementById('attachment').files;

        if (!tipo) {
             mostrarAlerta('warning','⚠️ Please select a PQRS type.');
            return;
        }

        if (descripcion.length < 10) {
              mostrarAlerta('warning','⚠️ Description must be at least 10 characters.');
            return;
        }

        if (archivo.length === 0) {
             mostrarAlerta('warning','⚠️ Please upload a file.');
            return;
        }

        // ✅ Si todo está bien, agregamos el action y method dinámicamente
        form.action = "<?= base_url('client/pqrs-sent/save') ?>";
        form.method = "POST";

    // ✅ Mostramos loader antes de enviar
        toggleLoader(true, 2500); // Puedes ajustar el tiempo si es necesario

        // ✅ Enviamos formulario
        setTimeout(() => {
            form.submit();
        }, 200); //
    }

    // Mostrar nombre del archivo seleccionado
    document.getElementById('attachment').addEventListener('change', function () {
        const file = this.files[0];
        document.getElementById('file-name').innerText = file ? file.name : 'No file selected.';
    });
</script>

<?= $this->endSection() ?>
