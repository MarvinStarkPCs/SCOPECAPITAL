<!-- Modal for Adding Company -->
<div class="modal fade" id="addcompanyModal" tabindex="-1" role="dialog" aria-labelledby="addcompanyModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addcompanyModalLabel">Add Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="./company/add" method="post" id="addcompanyForm">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputName">Name</label>
                            <input type="text"
                                class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputName" name="name" placeholder="Name" value="<?= old('name') ?>">
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
                            <label for="inputTelephone">Telephone</label>
                            <input type="text"
                                class="form-control <?= session('errors-insert.telephone') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputTelephone" name="telephone" placeholder="Telephone"
                                value="<?= old('telephone') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.telephone') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail">Email</label>
                            <input type="email"
                                class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputEmail" name="email" placeholder="Email"
                                value="<?= old('email') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.email') ?>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputRepresentative">Representative</label>
                            <input type="text"
                                class="form-control <?= session('errors-insert.representative') ? 'is-invalid errors-insert' : '' ?>"
                                id="inputRepresentative" name="representative" placeholder="Representative"
                                value="<?= old('representative') ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-insert.representative') ?>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="savecompanyButton">Save Company</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let form = document.getElementById('addcompanyForm');
        let input = form.querySelector('input.errors-insert, select.errors-insert, textarea.errors-insert');

        if (input) {
            document.getElementById('openModalButtoncompany').click();
        }
    });
</script>

