<?php foreach ($bankers as $banker): ?>
<!-- Modal de Eliminar banker -->
 <div class="modal fade" id="deleteModal-<?= $banker['id_banker'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $banker['id_banker'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $banker['id_banker'] ?>">Delete banker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Are you sure?</p>
                    <p><strong><?= esc($banker['name'] ) ?></strong></p>
                </div>
                <div class="modal-footer">

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="./banker/delete/<?php echo $banker['id_banker']; ?>" class="btn btn-danger">Delete</a>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>