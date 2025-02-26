<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container text-center mt-5">
    <div class="card shadow-lg animated-card">
        <div class="card-header bg-dark-blue text-white">
            <h2><i class="fas fa-building"></i> ¡Bienvenido a <span class="text-warning">SCOPE CAPITAL</span>!</h2>
        </div>
        <div class="card-body">
            <img src="<?= base_url('img/logo_small.png') ?>" alt="Scope Capital" class="img-fluid mb-4 logo-animated">
           
        </div>
    </div>
</div>

<style>
    /* Animación de entrada */
    .animated-card {
        border-radius: 15px;
        overflow: hidden;
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Encabezado con gradiente */
    .bg-gradient {
        background: linear-gradient(135deg, #2c3e50, #34495e);
        padding: 15px;
    }

    /* Animación infinita en el logo */
    .logo-animated {
        max-width: 180px;
        animation: bounce 2s infinite ease-in-out;
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }
</style>

<?= $this->endSection() ?>
