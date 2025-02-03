// Inicializar Select2
document.addEventListener('DOMContentLoaded', function() {
    let pqrs =document.getElementById('pqrs');
    console.log(pqrs);
    var origenSelect = document.getElementById('origen');
    var destinoSelect = document.getElementById('destino');
    var articuloSelect = document.getElementById('articulo');
    var estadoUbicacion1Select = document.getElementById('estadoUbicacion1');
    var estadoUbicacion2Select = document.getElementById('estadoUbicacion2');

    // Inicializar Select2
    $(pqrs).select2({
        placeholder: "Seleccione una opción",
        width: '100%'
        
    });
    $(origenSelect).select2({
        placeholder: "Seleccione una opción",
        width: '100%'
    });
    $(destinoSelect).select2({
        placeholder: "Seleccione una opción",
        width: '100%'
    });
    $(articuloSelect).select2({
        placeholder: "Seleccione un artículo",
        width: '100%'
    });
    $(estadoUbicacion1Select).select2({
        placeholder: "Seleccione un estado",
        width: '100%'
    });
    $(estadoUbicacion2Select).select2({
        placeholder: "Seleccione un estado",
        width: '100%'
    });

    // // Cambiar a pestaña Por Serial
    // document.getElementById('btnSerial').onclick = function() {
    //     document.getElementById('serialForm').style.display = 'block';
    //     document.getElementById('ubicacionForm').style.display = 'none';

    //     // Limpiar campo de serial
    //     document.getElementById('inputSerial').value = '';

    //     // Limpiar tabla de seriales
    //     var serialTableBody = document.querySelector('#tablaSerial tbody');
    //     serialTableBody.innerHTML = '<tr><td colspan="6" class="text-center">Lista vacía</td></tr>';

    //     // Cambiar clase activa
    //     this.classList.add('active');
    //     document.getElementById('btnUbicacion').classList.remove('active');
    // };

    // // Cambiar a pestaña Por Ubicación
    // document.getElementById('btnUbicacion').onclick = function() {
    //     document.getElementById('serialForm').style.display = 'none';
    //     document.getElementById('ubicacionForm').style.display = 'block';

    //     // Limpiar campos de selección
    //     origenSelect.value = ''; // Reinicia a opción vacía
    //     destinoSelect.value = ''; // Reinicia a opción vacía
    //     articuloSelect.value = ''; // Reinicia a opción vacía
    //     estadoUbicacion1Select.value = ''; // Reinicia a opción vacía
    //     document.getElementById('cantidad').value = '';
    //     estadoUbicacion2Select.value = ''; // Reinicia a opción vacía

    //     // Limpiar tablas
    //     var ubicacionTableBody = document.querySelector('#tablaUbicacion tbody');
    //     ubicacionTableBody.innerHTML = '<tr><td colspan="5" class="text-center">Lista vacía</td></tr>';

    //     // Reiniciar Select2
    //     $(origenSelect).val(null).trigger('change');
    //     $(destinoSelect).val(null).trigger('change');
    //     $(articuloSelect).val(null).trigger('change');
    //     $(estadoUbicacion1Select).val(null).trigger('change');
    //     $(estadoUbicacion2Select).val(null).trigger('change');

    //     // Cambiar clase activa
    //     this.classList.add('active');
    //     document.getElementById('btnSerial').classList.remove('active');
    // };

    // // Inicializar en la vista de Serial
    // document.getElementById('btnSerial').click();
});
