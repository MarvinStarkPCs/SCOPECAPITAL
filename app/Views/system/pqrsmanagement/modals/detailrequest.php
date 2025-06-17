<!-- Modal de Detalles de Usuario -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles de la Solicitud</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="detailsId">ID Solicitud</label>
              <input type="text" class="form-control" id="detailsId" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="detailsCode">Código Único</label>
              <input type="text" class="form-control" id="detailsCode" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="detailsEmail">Correo del Usuario</label>
              <input type="email" class="form-control" id="detailsEmail" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="detailsType">Tipo de Solicitud</label>
              <input type="text" class="form-control" id="detailsType" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="detailsStatus">Estado</label>
              <input type="text" class="form-control" id="detailsStatus" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Archivo Adjunto</label><br>
              <a id="detailsAttachmentLink" href="#" target="_blank" style="display:none;">Ver archivo</a>
            </div>
            <div class="form-group col-12">
              <label for="detailsDescription">Descripción</label>
              <textarea class="form-control" id="detailsDescription" rows="3" readonly></textarea>
            </div>
            <div class="form-group col-12">
              <label for="detailsRespuesta">Respuesta</label>
              <textarea class="form-control" id="detailsRespuesta" rows="3" readonly></textarea>
            </div>
            <div class="form-group col-md-6">
              <label for="detailsCreated">Fecha de Creación</label>
              <input type="text" class="form-control" id="detailsCreated" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="detailsUpdated">Última Actualización</label>
              <input type="text" class="form-control" id="detailsUpdated" readonly>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.btn-info', function (e) {
    e.preventDefault();

    const id = $(this).data('id');

    $.ajax({
      url: '<?= base_url('admin/pqrsmanagement/getDetails') ?>', // ajusta esta URL si no usas PHP
      type: 'POST',
      data: { id: id },
      dataType: 'json',
      success: function (response) {
        if (response && response.data) {
          const d = response.data[0];
          

          $('#detailsId').val(d.id_request || '');
          $('#detailsCode').val(d.unique_code || '');
          $('#detailsEmail').val(d.email || '');
          $('#detailsType').val(d.type || '');
          $('#detailsStatus').val(d.status || '');
          $('#detailsDescription').val(d.description || '');
          $('#detailsRespuesta').val(d.response || '');
          $('#detailsCreated').val(d.created_at || '');
          $('#detailsUpdated').val(d.updated_at || '');

          // Archivo adjunto: si existe, mostrar link, sino ocultar
         const baseUrl = '<?= base_url() ?>'; // asegúrate de tener esto arriba

if (d.attachment_url && d.attachment_url.trim() !== '') {
  const fullUrl = baseUrl + 'upload/pqrs/' + d.attachment_url;
  $('#detailsAttachmentLink').attr('href', fullUrl).show();
} else {
  $('#detailsAttachmentLink').hide();
}


          $('#detailsModal').modal('show');
        } else {
          alert('No se encontraron datos para esta solicitud.');
        }
      },
      error: function (xhr) {
        console.error('Error AJAX:', xhr.responseText);
        alert('Error en la solicitud.');
      }
    });
  });
</script>
