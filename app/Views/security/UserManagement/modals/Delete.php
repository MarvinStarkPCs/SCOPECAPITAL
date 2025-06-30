<?php foreach ($users as $user): ?>
<!-- Modal de Eliminar user -->
 <div class="modal fade" id="deleteModal-<?= $user['id_user'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $user['id_user'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $user['id_user'] ?>">Delete user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Are you sure?</p>
                    <p><strong><?= esc($user['name'] . ' ' . $user['last_name']) ?></strong></p>
                </div>
                <div class="modal-footer">

                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="./usermanagement/delete/<?php echo $user['id_user']; ?>" class="btn btn-danger">Delete</a>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>