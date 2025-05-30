<?php foreach ($banks as $bank): ?>
    <!-- Edit bank Modal -->
    <div class="modal fade" id="editModal-<?= $bank['id_bank'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel-<?= $bank['id_bank'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $bank['id_bank'] ?>">Edit bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./bank/update/<?= $bank['id_bank'] ?>" id="editForm-<?= $bank['id_bank'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $bank['id_bank'] ?>">Name</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.name') ? 'is-invalid errors-update ' : '' ?>"
                                    id="editName-<?= $bank['id_bank'] ?>" name="name"
                                    value="<?= old('name', esc($bank['name'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.name') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editLastname-<?= $bank['id_bank'] ?>">Address</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.address') ? 'is-invalid errors-update' : '' ?>"
                                    id="editLastname-<?= $bank['id_bank'] ?>" name="address"
                                    value="<?= old('address', esc($bank['address'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.address') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $bank['id_bank'] ?>">Account Name</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.account_name') ? 'is-invalid errors-update' : '' ?>"
                                    id="editIdentity-<?= $bank['id_bank'] ?>" name="account_name"
                                    value="<?= old('account_name', esc($bank['account_name'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.account_name') ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="location.reload();">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let forms = document.querySelectorAll('form[id^="editForm-"]');
    let inputUpdate = null;
    let target = localStorage.getItem("data_target");

    forms.forEach(form => {
        let input = form.querySelector('input.errors-update, select.errors-update, textarea.errors-update');
        if (input) {
            inputUpdate = input;
        }
    });

    if (inputUpdate && target) {
        const elements = document.querySelectorAll(`[data-target="${target}"]`);
        elements.forEach(element => {
            element.click();
        });
    }

    document.querySelectorAll('[id^="editButton"]').forEach(button => {
        button.addEventListener('click', function () {
            const dataTargetValue = this.getAttribute('data-target');
            localStorage.setItem("data_target", dataTargetValue);
        });
    });
});


</script>
