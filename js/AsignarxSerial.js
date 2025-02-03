$(document).ready(function () {
    // Definir un array para almacenar los seriales
    var serialesArray = [];

    $('#btnAgregarSerial').on('click', function () {
        var serial = $('#inputSerial').val();
        var origenSeleccionado = $('#origen').val();
        var destinoSeleccionado = $('#destino').val();

        // Validaciones...
        if (!serial) {
            Swal.fire({
                title: "Advertencia",
                text: "Por favor, ingresa un serial.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta el serial
        }

        if (origenSeleccionado === "") {
            Swal.fire({
                title: "Advertencia",
                text: "Por favor, selecciona una ubicación de origen.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta la ubicación de origen
        }

        if (destinoSeleccionado === "") {
            Swal.fire({
                title: "Advertencia",
                text: "Por favor, selecciona una ubicación de destino.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta la ubicación de destino
        }

        if (origenSeleccionado === destinoSeleccionado) {
            Swal.fire({
                title: "Advertencia",
                text: "Las ubicaciones de origen y destino no pueden ser iguales.",
                icon: "warning",
                confirmButtonText: "Aceptar",
            });
            return; // Detener la ejecución si origen y destino son iguales
        }

        // Comprobar si el serial ya existe
        if (serialesArray.includes(serial)) {
            Swal.fire({
                title: "Error",
                text: "Este serial ya ha sido agregado.",
                icon: "error",
                button: "Aceptar"
            });
            return; // No agregar el serial si ya existe
        }

        // Si todos los campos están llenos, realizar la solicitud AJAX
        $.ajax({
            url: 'asignar-articulo/buscarPorSerial', // Cambia esta URL según tu configuración de rutas
            type: 'POST',
            data: {
                serial: serial,
                ubicacion_id_origen: origenSeleccionado, // Enviar ID de la ubicación de origen
                ubicacion_id_destino: destinoSeleccionado // Enviar ID de la ubicación de destino
            },
            dataType: 'json',
            success: function (response) {
                var tableBody = $('#tablaSerial tbody');

                if (response.length > 0) {
                    // Verificar si hay una fila "Lista vacía" y eliminarla si existe
                    if (tableBody.find('tr:contains("Lista vacía")').length) {
                        tableBody.empty(); // Limpiar la tabla
                    }

                    // Agregar los resultados uno por uno
                    $.each(response, function (index, item) {
                        tableBody.append(`
                            <tr>
                                <td>${item.serial}</td>
                                <td>${item.nombre_articulo}</td>
                                <td>${item.nombre_marca}</td>
                                <td>${item.modelo_articulo ? item.modelo_articulo : 'NO APLICA'}</td>
                                <td>${item.nombre_estado}</td>
                                <td><button class="btn btn-danger eliminar" data-id="${item.id_inventario}">Eliminar</button></td>
                            </tr>
                        `);
                    });

                    // Agregar el serial al array
                    serialesArray.push(serial);

                    // Limpiar el campo de entrada
                    $('#inputSerial').val('');
                } else if (response.error) {
                    Swal.fire({
                        title: "Error",
                        text: response.error,
                        icon: "error",
                        button: "Aceptar",
                    }); 
                    $('#inputSerial').val('');
                } else {
                    // Si no hay resultados, mostrar un mensaje
                    tableBody.append('<tr><td colspan="6" class="text-center">No se encontraron resultados</td></tr>');
                    $('#inputSerial').val('');
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
                Swal.fire({
                    title: "Error",
                    text: "Ocurrió un error al realizar la solicitud.",
                    icon: "error",
                    button: "Aceptar",
                });
            }
        });
    });

    // Manejar la eliminación de seriales de la tabla y del array
    $('#tablaSerial').on('click', '.eliminar', function () {
        var row = $(this).closest('tr'); // Obtener la fila a eliminar
        var serial = row.find('td').eq(0).text().trim(); // Obtener el serial de la fila

        // Confirmar eliminación visualmente
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Eliminar la fila del DOM
                row.remove();

                // Eliminar el serial del array
                serialesArray = serialesArray.filter(item => item !== serial); // Filtra el array para eliminar el serial
                console.log(serialesArray)

                // Verificar si la tabla está vacía
                if ($('#tablaSerial tbody tr').length === 0) {
                    // Agregar fila "Lista vacía"
                    $('#tablaSerial tbody').append(`
                        <tr>
                            <td colspan="6" class="text-center">Lista vacía</td>
                        </tr>
                    `);
                }

                Swal.fire('Eliminado', 'El artículo ha sido eliminado.', 'success');
            }
        });
    });

    // Validación al botón de cambiar ubicación
    $('.btn-change-ubication').on('click', function () {
        var origenSeleccionado = $('#origen').val();
        var destinoSeleccionado = $('#destino').val();

        // Validación: verificar que origen y destino estén seleccionados
        if (!origenSeleccionado || !destinoSeleccionado) {
            Swal.fire({
                title: "Advertencia",
                text: "Por favor, selecciona tanto el origen como el destino.",
                icon: "warning",
                button: "Aceptar",
            });
            return; // Detener la ejecución si falta algún campo
        }

        // Validación: comprobar que origen y destino no sean iguales
        if (origenSeleccionado === destinoSeleccionado) {
            Swal.fire({
                title: "Advertencia",
                text: "Las ubicaciones de origen y destino no pueden ser iguales.",
                icon: "warning",
                confirmButtonText: "Aceptar",
            });
            return; // Detener la ejecución si origen y destino son iguales
        }

        // Mostrar confirmación antes de proceder con el cambio
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas cambiar la ubicación de los seriales seleccionados?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cambiar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, realizar la solicitud AJAX
                $.ajax({
                    url: 'asignar-articulo/asignar', // Cambia esta URL según tu configuración de rutas
                    type: 'POST',
                    data: {
                        origen_id: origenSeleccionado,
                        destino_id: destinoSeleccionado,
                        seriales: serialesArray // El array de seriales
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Éxito',
                                text: response.success,
                                icon: 'success'
                            }).then(() => {
                                // Recargar la página después de que el usuario cierre la alerta
                                location.reload();
                            });
                        } else if (response.error) {
                            Swal.fire('Error', response.error, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire('Error', 'Ocurrió un error al realizar la solicitud.', 'error');
                    }
                });
            }
        });
    });

});
