<div class="modal fade" id="solverequest" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="requestModalLabel">Solve Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <p>Please provide a response to solve the request:</p>
        <form id="solveRequestForm">
          <input type="hidden" name="id_request" id="modalRequestId">
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
