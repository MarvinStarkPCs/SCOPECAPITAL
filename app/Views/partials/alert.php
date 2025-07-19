<!-- Contenedor para las alertas -->
<div id="alert-container"></div>

<script>
function mostrarAlerta(tipo, mensaje) {
    let alerta = document.createElement('div');
    alerta.classList.add('alert', `alert-${tipo}`);

    alerta.innerHTML = `
        <div class="alert-content">
           
            <span class="alert-message">${mensaje}</span>
             <button type="button" class="close-btn" aria-label="Close">&times;</button>
        </div>
        <div class="progress">
            <div class="progress-bar" role="progressbar"></div>
        </div>
    `;

    let container = document.getElementById('alert-container');
    container.appendChild(alerta);

    let progressBar = alerta.querySelector('.progress-bar');
    progressBar.style.width = '100%';
    progressBar.offsetHeight;
    setTimeout(() => progressBar.style.width = '0%', 50);

    setTimeout(() => alerta.classList.add('show'), 10);

    const tiempoEspera = 5000;
    const tiempoAnimacion = 500;

    const cerrarAlerta = () => {
        alerta.classList.remove('show');
        alerta.classList.add('hide');
        setTimeout(() => alerta.remove(), tiempoAnimacion);
    };

    const autoCerrar = setTimeout(cerrarAlerta, tiempoEspera);

    alerta.querySelector('.close-btn').addEventListener('click', () => {
        clearTimeout(autoCerrar);
        cerrarAlerta();
    });
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
