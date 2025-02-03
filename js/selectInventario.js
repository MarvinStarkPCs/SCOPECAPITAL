$(document).ready(function() {
    $('#selectBrand').select2({
        width: '100%', // Asegura que el campo select ocupe el 100% del ancho
        dropdownParent: $('#addArticleModal') // El modal donde está el select
    });

    // Inicializa Select2 para los select del modal
    $('#openProcedencia,#openArticulo').select2({
        width: '100%',
        placeholder: function() {
            return $(this).data('placeholder');
        },
        dropdownParent: $('#openInventoryModal')
    });
        $('#openArticulo').change(function() {
            var quantityContainer = $('#quantityContainer');
            var serialContainer = $('#serialContainer');
            $('#serialList').empty(); // Limpiar la lista de seriales

            Swal.fire({
                title: '¿Este artículo tiene serial?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mostrar contenedor de seriales y ocultar cantidad
                    serialContainer.show();
                    quantityContainer.hide(); // Ocultar la cantidad
                    $('#openQuantity').prop('disabled', true); // Deshabilitar el campo cantidad

                    // Activar la escucha de la tecla "A" solo cuando hay seriales
                    $(document).on('keydown.addSerial', function(event) {
                        if (event.key === "l" || event.key === "L") { // Detecta tanto "a" como "A"
                            $('#addSerialButton').click(); // Simular clic en el botón
                        }
                    });
                } else {
                    // Ocultar seriales y mostrar cantidad
                    serialContainer.hide();
                    quantityContainer.show(); // Mostrar la cantidad
                    $('#openQuantity').prop('disabled', false); // Habilitar el campo cantidad

                    // Desactivar la escucha de la tecla "A" si no hay seriales
                    $(document).off('keydown.addSerial');
                }
            });
        });

        $('#addSerialButton').click(function() {
            // Ocultar el modal de Agregar inventario antes de mostrar el SweetAlert
            $('#openInventoryModal').modal('hide');

            Swal.fire({
                title: 'Ingrese el nuevo serial:',
                input: 'text', // Tipo de input de texto
                inputAttributes: {
                    autocapitalize: 'off', // Evita capitalización automática
                    placeholder: 'Escriba el serial aquí...', // Texto guía
                    style:'text-transform: uppercase;'
                },
                showCancelButton: true,
                confirmButtonText: 'Agregar',
                cancelButtonText: 'Cancelar',
                allowOutsideClick: false, // Evitar cierre al hacer clic fuera del modal
                allowEscapeKey: false,   // Evitar cierre con la tecla Esc
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    var newSerial = result.value.trim().toUpperCase(); // Eliminar espacios en blanco
                    var isDuplicate = false;

                    // Verificar si el serial ya existe en la lista
                    $('#serialList div span').each(function() {
                        if ($(this).text() === newSerial) {
                            isDuplicate = true;
                        }
                    });

                    if (isDuplicate) {
                        // Mostrar una alerta si el serial ya está agregado
                        Swal.fire({
                            title: 'Error',
                            text: 'Este serial ya ha sido agregado.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        // Agregar el nuevo serial si no está duplicado
                        var serialInput = $('<input>', {
                            type: 'hidden',
                            name: 'seriales[]',
                            value: newSerial
                        });

                        // Añadir el serial a la lista visible y agregar el input oculto
                        $('#serialList').append(
                            '<div class="d-flex justify-content-between align-items-center mb-1">' +
                            '<span>' + newSerial + '</span>' +
                            '<button type="button" class="btn btn-danger btn-sm removeSerialButton">Eliminar</button>' +
                            '</div>'
                        );

                        var audio = new Audio('sound/notification-sound-7062.mp3'); // Cambia 'path/to/' por la ruta de tu archivo de sonido
                        audio.play();

                        // Añadir el input oculto al formulario
                        $('#openInventoryForm').append(serialInput);
                    }
                }

                // Mostrar nuevamente el modal de Agregar inventario después de cerrar el SweetAlert
                $('#openInventoryModal').modal('show');
            });
        });
        // Manejar la eliminación de seriales
        $('#serialList').on('click', '.removeSerialButton', function() {
            $(this).parent().remove();
        });
    $('#openInventoryForm').submit(function(event) {
        var serialCount = $('#serialList div').length;
        var serialContainer = $('#serialContainer');

        if (serialContainer.is(':visible') && serialCount === 0) {
            // Mostrar advertencia si el contenedor de seriales está visible pero no se ha agregado ningún serial
            event.preventDefault(); // Evitar el envío del formulario
            Swal.fire({
                title: 'Error',
                text: 'Debe agregar al menos un serial antes de enviar el formulario.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });

    });


