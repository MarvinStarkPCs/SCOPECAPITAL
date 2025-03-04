<?php foreach ($companies as $company): ?>
    <!-- Edit company Modal -->
    <div class="modal fade" id="editModal-<?= $company['id_company'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel-<?= $company['id_company'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $company['id_company'] ?>">Edit company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./company/update/<?= $company['id_company'] ?>" id="editForm-<?= $company['id_company'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $company['id_company'] ?>">Name</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.name') ? 'is-invalid errors-update ' : '' ?>"
                                    id="editName-<?= $company['id_company'] ?>" name="name"
                                    value="<?= old('name', esc($company['name'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.name') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editLastname-<?= $company['id_company'] ?>">Address</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.address') ? 'is-invalid errors-update' : '' ?>"
                                    id="editLastname-<?= $company['id_company'] ?>" name="address"
                                    value="<?= old('address', esc($company['address'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.address') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $company['id_company'] ?>">telephone</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.telephone') ? 'is-invalid errors-update' : '' ?>"
                                    id="editIdentity-<?= $company['id_company'] ?>" name="telephone"
                                    value="<?= old('telephone', esc($company['telephone'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.telephone') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $company['id_company'] ?>">email</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.email') ? 'is-invalid errors-update' : '' ?>"
                                    id="editIdentity-<?= $company['id_company'] ?>" name="email"
                                    value="<?= old('email', esc($company['email'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.email') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $company['id_company'] ?>">representative</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.representative') ? 'is-invalid errors-update' : '' ?>"
                                    id="editIdentity-<?= $company['id_company'] ?>" name="representative"
                                    value="<?= old('representative', esc($company['representative'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.representative') ?>
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
