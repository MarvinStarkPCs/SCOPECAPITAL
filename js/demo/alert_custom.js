
    document.addEventListener("DOMContentLoaded", function() {


       
        

const inputs = document.querySelectorAll('input[type="text"]');

// Para cada input, agregar un evento 'input'
inputs.forEach(function(input) {
    input.addEventListener('input', function() {
        // Verificar si el input no tiene la clase 'no-uppercase'
        if (!input.classList.contains('no-uppercase')) {
            // Cambiar el valor del input a mayúsculas mientras escribe
            input.value = input.value.toUpperCase();
        }
    });
});
const textareas = document.querySelectorAll('textarea');

// Para cada textarea, agregar un evento 'input'
textareas.forEach(function(textarea) {
    textarea.addEventListener('input', function() {
        // Verificar si el textarea no tiene la clase 'no-uppercase'
        if (!textarea.classList.contains('no-uppercase')) {
            // Cambiar el valor del textarea a mayúsculas mientras escribe
            textarea.value = textarea.value.toUpperCase();
        }
    });
});


    });




