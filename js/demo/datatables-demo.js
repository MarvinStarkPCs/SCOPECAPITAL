// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "url": "../js/locales/Spanish.json" // Ruta local del archivo JSON
    }
  });
});
