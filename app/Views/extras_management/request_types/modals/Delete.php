<?php foreach ($banks as $bank): ?>
<!-- Modal de Eliminar bank -->
 <div class="modal fade" id="deleteModal-<?= $bank['id_bank'] ?>" tabindex="-1" role="dialog"
         aria-labelledby="deleteModalLabel-<?= $bank['id_bank'] ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel-<?= $bank['id_bank'] ?>">Eliminar bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar a este bank?</p>
                    <p><strong><?= esc($bank['name'] . ' ' . $bank['account_name']) ?></strong></p>
                </div>
                <div class="modal-footer">

                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="./bank/delete/<?php echo $bank['id_bank']; ?>" class="btn btn-danger">Eliminar</a>

                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>