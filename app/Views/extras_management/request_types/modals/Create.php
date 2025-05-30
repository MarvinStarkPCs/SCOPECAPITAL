<!-- Modal de Agregar bank -->
<div class="modal fade" id="addbankModal" tabindex="-1" role="dialog" aria-labelledby="addbankModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addbankModalLabel">Add bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./bank/add" method="post" id="addbankForm">
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
                            <label for="inputAddress">Address</label>
                            <textarea
                                class="form-control <?= session('errors-insert.address') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputAddress" name="address" placeholder="Address"><?= old('address') ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors-insert.address') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputAccount_name">Account Name</label>
                            <input type="account_name"
                                class="form-control <?= session('errors-insert.account_name') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputaccount_name" name="account_name" placeholder="account_name"
                                value="<?= old('account_name') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.account_name') ?>
                            </div>
                        </div>
                    </div>
                

                

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="savebankButton">Guardar bank</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Verifica si hay un input con la clase específica dentro del formulario
        let form = document.getElementById('addbankForm');
        let input = form.querySelector('input.errors-insert, select.errors-insert, textarea.errors-insert');


        if (input) {
            document.getElementById('openModalButtonbank').click();
        }



    });

</script>