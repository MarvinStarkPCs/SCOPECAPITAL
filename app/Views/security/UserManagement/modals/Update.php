<?php foreach ($users as $user): ?>

<!-- Edit User Modal -->
<div class="modal fade" id="editModal-<?= $user['id_user'] ?>" tabindex="-1" role="dialog"
       aria-labelledby="editModalLabel-<?= $user['id_user'] ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $user['id_user'] ?>">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="location.reload();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('./admin/usermanagement/update/' . $user['id_user']) ?>" id="editForm" method="post">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="editName-<?= $user['id_user'] ?>">First Name</label>
                            <input type="text" class="form-control <?= session('errors-edit.name') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editName-<?= $user['id_user'] ?>" name="name" value="<?= old('name', esc($user['name'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.name') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editLastname-<?= $user['id_user'] ?>">Last Name</label>
                            <input type="text" class="form-control <?= session('errors-edit.last_name') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editLastname-<?= $user['id_user'] ?>" name="last_name" value="<?= old('last_name', esc($user['last_name'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.last_name') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editIdentity-<?= $user['id_user'] ?>">Identity (ID Card)</label>
                            <input type="text" class="form-control <?= session('errors-edit.identification') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editIdentity-<?= $user['id_user'] ?>" name="identification" value="<?= old('identification', esc($user['identification'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.identification') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editEmail-<?= $user['id_user'] ?>">Email</label>
                            <input type="email" class="form-control <?= session('errors-edit.email') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editEmail-<?= $user['id_user'] ?>" name="email" value="<?= old('email', esc($user['email'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.email') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editPhone-<?= $user['id_user'] ?>">Phone</label>
                            <input type="tel" class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                   id="editPhone-<?= $user['id_user'] ?>" name="phone" value="<?= old('phone', esc($user['phone'])) ?>">
                            <div class="invalid-feedback">
                                <?= session('errors-edit.phone') ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editAddress-<?= $user['id_user'] ?>">Address</label>
                            <textarea class="form-control <?= session('errors-edit.address') ? 'is-invalid errors-edit' : '' ?>"
                                      id="editAddress-<?= $user['id_user'] ?>" name="address"><?= old('address', esc($user['address'])) ?></textarea>
                            <div class="invalid-feedback">
                                <?= session('errors-edit.address') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editRole-<?= $user['id_user'] ?>">Role</label>
                        <select class="form-control <?= session('errors-edit.id_role') ? 'is-invalid errors-edit'  : '' ?>"
                                id="editRole-<?= $user['id_user'] ?>" name="id_role">
                            <option value="">Select a Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= esc($role['id_role']) ?>" <?= old('id_role', $user['role_id']) == $role['id_role'] ? 'selected' : '' ?>>
                                    <?= esc($role['role_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-edit.id_role') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectStatus">Select Status</label>
                        <select class="form-control <?= session('errors-edit.status') ? 'is-invalid errors-edit' : '' ?>"
                                id="selectStatus" name="status">
                            <option value="">Select a Status</option>
                            <option value="active" <?= old('status', $user['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= old('status', $user['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= session('errors-edit.status') ?>
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

        let formUpdate = document.getElementById('editForm');
        let inputUpdate = formUpdate ? formUpdate.querySelector('input.errors-edit, select.errors-edit, textarea.errors-edit') : null;
        console.log(inputUpdate);
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


</script>