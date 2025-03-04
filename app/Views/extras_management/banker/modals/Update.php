<?php foreach ($bankers as $banker): ?>
    <!-- Edit banker Modal -->
    <div class="modal fade" id="editModal-<?= $banker['id_banker'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel-<?= $banker['id_banker'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $banker['id_banker'] ?>">Edit banker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./banker/update/<?= $banker['id_banker'] ?>" id="editForm-<?= $banker['id_banker'] ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="editName-<?= $banker['id_banker'] ?>">Name</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.name') ? 'is-invalid errors-update ' : '' ?>"
                                    id="editName-<?= $banker['id_banker'] ?>" name="name"
                                    value="<?= old('name', esc($banker['name'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.name') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editLastname-<?= $banker['id_banker'] ?>">telephone</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.telephone') ? 'is-invalid errors-update' : '' ?>"
                                    id="editLastname-<?= $banker['id_banker'] ?>" name="telephone"
                                    value="<?= old('telephone', esc($banker['telephone'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.telephone') ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="editIdentity-<?= $banker['id_banker'] ?>">Email</label>
                                <input type="text"
                                    class="form-control <?= session('errors-update.email') ? 'is-invalid errors-update' : '' ?>"
                                    id="editIdentity-<?= $banker['id_banker'] ?>" name="email"
                                    value="<?= old('email', esc($banker['email'])) ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors-update.email') ?>
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
