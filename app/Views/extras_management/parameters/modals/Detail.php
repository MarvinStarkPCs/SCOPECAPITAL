<!-- Modal de Detalles de Usuario -->
<?php foreach ($users as $user): ?>
    <div class="modal fade" id="detailsModal-<?= $user['id_user'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="detailsModalLabel-<?= $user['id_user'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel-<?= $user['id_user'] ?>">Details from user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="detailsName">Name</label>
                                <input type="text" class="form-control" id="detailsName"
                                       value="<?= esc($user['name']) ?> <?= esc($user['last_name']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsIdentity">Identification (ID)</label>
                                <input type="text" class="form-control" id="detailsIdentity"
                                       value="<?= esc($user['identification']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsEmail">Email</label>
                                <input type="email" class="form-control" id="detailsEmail"
                                       value="<?= esc($user['email']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsPhone">Phone</label>
                                <input type="text" class="form-control" id="detailsPhone"
                                       value="<?= esc($user['phone']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsAddress">Address</label>
                                <input type="text" class="form-control" id="detailsAddress"
                                       value="<?= esc($user['address']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsStatus">Status</label>
                                <input type="text" class="form-control" id="detailsStatus"
                                       value="<?= esc($user['status']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsLoginAttempts">Login attempts</label>
                                <input type="text" class="form-control" id="detailsLoginAttempts"
                                       value="<?= esc($user['login_attempts']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsLastLogin">Last login attempt</label>
                                <input type="text" class="form-control" id="detailsLastLogin"
                                       value="<?= esc($user['last_login_attempt']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsRole">Role</label>
                                <input type="text" class="form-control" id="detailsRole"
                                       value="<?= esc($user['role_name']) ?>" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="detailsRegistrationDate">Registration date</label>
                                <input type="text" class="form-control" id="detailsRegistrationDate"
                                       value="<?= esc($user['date_registration']) ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>

</script>
