
    document.addEventListener("DOMContentLoaded", function() {


        let alertBoxes = document.querySelectorAll('.alert');

    alertBoxes.forEach(function(alertBox) {
    let progressBar = alertBox.querySelector('.progress-bar');

    if (alertBox && progressBar) {
    // Mostrar el mensaje con la clase 'show'
    alertBox.classList.add('show');

    // Animar la barra de progreso
    progressBar.style.width = '0%';

    // Ocultar el mensaje después de 5 segundos (5000ms)
    setTimeout(function() {
    alertBox.classList.remove('show');
    alertBox.classList.add('hide');
}, 5000);
}
});
        // function toggleLoader(show) {
        //     var loader = document.getElementById('loader');
        //     if (show) {
        //         loader.style.display = 'block';  // Mostrar el loader
        //     } else {
        //         loader.style.display = 'none';   // Ocultar el loader
        //     }
        // }


        const inputs = document.querySelectorAll('input[type="text"]');

        // Para cada input, agregar un evento 'input'
        inputs.forEach(function(input) {
            input.addEventListener('input', function() {
                // Cambiar el valor del input a mayúsculas mientras escribe
                input.value = input.value.toUpperCase();
            });
        });

        const textareas = document.querySelectorAll('textarea');

// Para cada textarea, agregar un evento 'input'
        textareas.forEach(function(textarea) {
            textarea.addEventListener('input', function() {
                // Cambiar el valor del textarea a mayúsculas mientras escribe
                textarea.value = textarea.value.toUpperCase();
            });
        });

    });




