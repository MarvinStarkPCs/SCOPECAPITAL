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

  // Ejecutar el loader después de que el documento y los recursos estén completamente cargados
  window.onload = () => {
    toggleLoader(true,0); // Mostrar el loader por 5 segundos

    // Aquí puedes llamar a la función toggleLoader en cualquier otro lugar del documento cuando lo necesites
  };