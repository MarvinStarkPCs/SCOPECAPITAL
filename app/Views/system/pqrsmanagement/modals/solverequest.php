<div class="modal fade"
 id="solverequest"
  tabindex="-1"
  aria-labelledby="requestModalLabel"
   aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="requestModalLabel">Solve Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        
        <label><strong>Unique Code:</strong> <span id="unique-code-display-resolve"></span></label>
        <p>Please provide a response to solve the request:</p>
        <form action="<?= base_url('./admin/pqrsmanagement/resolved-request') ?>" method="post" id="solveRequestForm">
          <input type="hidden" name="id_request" id="modalRequestIdResolve">
          <div class="mb-3">
            <label for="responseText" class="form-label">Response</label>
            <textarea class="form-control" id="responseText" name="response" rows="3" required></textarea>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="solveRequestForm" class="btn btn-success">Submit Response</button>
      </div>

    </div>
  </div>
</div>

<script>
  $('#solverequest').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget);
    let id = button.data('id');
    let code = button.data('code');

    // Mostrar el código único
    $('#unique-code-display-resolve').text(code);
    // Setear el ID en el input hidden
    $('#modalRequestIdResolve').val(id);
  });
</script>
