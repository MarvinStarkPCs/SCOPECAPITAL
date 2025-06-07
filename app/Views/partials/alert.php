<!-- Contenedor para las alertas -->
<div id="alert-container"></div>

<script>
// Función para crear y mostrar una alerta
// Función para crear y mostrar una alerta
function mostrarAlerta(tipo, mensaje) {
    console.log(`Mostrando alerta de tipo: ${tipo} con mensaje: ${mensaje}`);
    // Crear el contenedor de la alerta
    let alerta = document.createElement('div');
    alerta.classList.add('alert', `alert-${tipo}`);
    alerta.innerHTML = `
        ${mensaje}
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    `;

    // Agregar la alerta al contenedor
    let container = document.getElementById('alert-container');
    container.appendChild(alerta);

    // Obtener la barra de progreso
    let progressBar = alerta.querySelector('.progress-bar');

    // Forzar el "repaint" antes de iniciar la animación
    progressBar.style.width = '100%';
    progressBar.offsetHeight; // Este acceso fuerza el repaint

    // Iniciar la animación de la barra de progreso
    setTimeout(function() {
        progressBar.style.width = '0%';
    }, 50);

    // Agregar la clase 'show' con un pequeño retardo para activar la animación de aparición
    setTimeout(function() {
        alerta.classList.add('show');
    }, 10);

    // Ocultar el mensaje después de 5 segundos
    setTimeout(function() {
        alerta.classList.remove('show');
        alerta.classList.add('hide');

        // Espera 500ms para que termine la animación antes de eliminar el elemento
        setTimeout(function() {
            alerta.remove();
        }, 500);
    }, 5000);
}


document.addEventListener("DOMContentLoaded", function() {
    <?php if (session()->get('success')): ?>
        mostrarAlerta('success', '<?= esc(session()->get('success')) ?>');
    <?php endif; ?>

    <?php if (session()->get('error')): ?>
        mostrarAlerta('danger', '<?= esc(session()->get('error')) ?>');
    <?php endif; ?>

    <?php if (session()->get('message')): ?>
        mostrarAlerta('warning', '<?= esc(session()->get('message')) ?>');
    <?php endif; ?>
});


</script>