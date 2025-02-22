  // Función global para mostrar/ocultar el loader
  function toggleLoader(show, duration) {
    const loaderOverlay = document.getElementById('loader-overlay');

    if (show) {
      loaderOverlay.style.display = 'flex'; // Mostrar el loader
    } else {
      loaderOverlay.style.display = 'none'; // Ocultar el loader
    }

    // Si el loader se está mostrando, lo ocultamos después del tiempo indicado (por defecto 3 segundos)
    if (show) {
      setTimeout(() => {
        toggleLoader(false);
      }, duration);
    }
  }


  