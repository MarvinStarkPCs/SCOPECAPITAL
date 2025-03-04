<!-- Modal de Agregar banker -->
<div class="modal fade" id="addbankerModal" tabindex="-1" role="dialog" aria-labelledby="addbankerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addbankerModalLabel">Add banker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./banker/add" method="post" id="addbankerForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text"
                                class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputName" name="name" placeholder="name" value="<?= old('name') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.name') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputtelephone">telephone</label>
                            <textarea
                                class="form-control <?= session('errors-insert.telephone') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputtelephone" name="telephone" placeholder="telephone"><?= old('telephone') ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors-insert.telephone') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputemail">Email</label>
                            <input type="email"
                                class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputemail" name="email" placeholder="email"
                                value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.email') ?>
                            </div>
                        </div>
                    </div>
                

                

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="savebankerButton">Guardar banker</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addbankerForm');
        let input = form.querySelector('input.errors-insert, select.errors-insert, textarea.errors-insert');


        if (input) {
            document.getElementById('openModalButtonbanker').click();
        }



    });

</script>