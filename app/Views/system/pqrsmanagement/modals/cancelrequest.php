<!-- Cancel Request Modal -->
<div class="modal fade" id="cancelrequest" tabindex="-1" role="dialog" aria-labelledby="cancelRequestLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="cancelRequestLabel">Cancel Request?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

   <div class="modal-body">
  Are you sure you want to cancel the request with the code:
  <span 
    id="unique-code-display" 
    class="badge badge-danger text-uppercase px-3 py-2 font-weight-bold" 
    style="font-size: 1.2rem;">
  </span>
  <br><br>
  This action cannot be undone.
</div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, go back</button>

        <!-- Confirm Button with dynamic href -->
        <a href="#" id="confirm-cancel-link" class="btn btn-danger">Yes, cancel it</a>

        <!-- Optional: if you want to POST as well -->
        <form id="cancel-form" action="<?= base_url('cancel_request') ?>" method="post" style="display:none;">
          <input type="hidden" name="request_id" id="request-id">
          <input type="hidden" name="unique_code" id="request-code">
        </form>
      </div>

    </div>
  </div>
</div>
<script>
  $('#cancelrequest').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let code = button.data('code');

    // Mostrar el código único en el texto del modal
    $('#unique-code-display').text(code);

    // Actualizar el enlace de confirmación (GET)
    let href = "<?= base_url('admin/pqrsmanagement/cancel-request') ?>/" + id ;
    $('#confirm-cancel-link').attr('href', href);

    // Si usas formulario (POST), también setea los valores ocultos
    $('#request-id').val(id);
    $('#request-code').val(code);
  });
</script>
