<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    .icon-image {
        width: 60px;
        height: auto;
        transition: transform 0.3s, filter 0.3s;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 15px;
        border: 2px solid #ddd;
        border-radius: 8px;
        background-color: #FEC659;
        transition: background-color 0.3s, box-shadow 0.3s, border-color 0.3s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        text-decoration: none;
        color: inherit;
    }

    .card:hover {
        background-color: #FEC659;
        box-shadow: 0 6px 12px rgba(36, 36, 49, 0.3);
        border-color: #192229;
    }

    .card:hover .icon-image {
        transform: scale(1.1);
        filter: brightness(1.2);
    }

    .card-content {
        display: flex;
        flex-direction: row;
        align-items: center;
        width: 100%;
        justify-content: space-between;
    }

    .card-text {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-left: 20px;
        text-align: left;
    }

    .card-image {
        margin-left: 15px;
    }

    /* Estilos mejorados para el botón de regreso */
    .back-button {
        display: flex;
        align-items: center;
        font-size: 0.9rem; /* Tamaño más pequeño */
        font-weight: bold;
        color: #192229; /* Color oscuro para mejor contraste */
        text-decoration: none;
        margin-bottom: 10px;
    }

    .back-button i {
        margin-right: 5px;
        font-size: 1.1rem; /* Ícono más pequeño */
        color: #192229;
        transition: transform 0.2s;
    }

    .back-button:hover {
        color: rgba(25, 34, 41, 0.8);
    }

    .back-button:hover i {
        transform: translateX(-3px); /* Pequeño efecto de movimiento */
    }

    .container-box {
        border: 2px solid rgb(42, 61, 77);
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    @media (max-width: 768px) {
        .card {
            flex-direction: column;
        }

        .card-content {
            flex-direction: column;
            align-items: center;
        }

        .card-text {
            margin-left: 0;
            margin-bottom: 10px;
            text-align: center;
        }

        .card-image {
            margin-left: 0;
        }
    }

    @media (max-width: 576px) {
        .icon-image {
            width: 50px;
        }

        .card-text {
            font-size: 1.5rem;
        }
    }

    .color-text {
        color: #409b41;
    }
</style>

<div class="container">
    <!-- Botón de regreso mejorado -->
    <!-- <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i> Volver
    </a> -->

    <div class="header mb-4">
        <h1 class="h3 color-text">Gestión de Extras</h1>
    </div>

    <div class="container-box bg-dark-blue">
        <div class="row bg-dark-blue">
            <!-- Bank -->
            <!-- <div class="col-12 col-md-4 mb-4">
                <a href="< ?= base_url('admin/extrasmanagement/bank'); ?>" class="card">
                    <div class="card-content">
                        <div class="card-text">
                            <h5 class="mb-0">Bank</h5>
                        </div>
                        <div class="card-image">
                            <img src="<?= base_url('img/gestionextras/6.png'); ?>" alt="Bank" class="icon-image">
                        </div>
                    </div>
                </a>
            </div> -->

            <!-- Banker -->
            <!-- <div class="col-12 col-md-4 mb-4">
                <a href="< ?= base_url('admin/extrasmanagement/banker'); ?>" class="card">
                    <div class="card-content">
                        <div class="card-text">
                            <h5 class="mb-0">Banker</h5>
                        </div>
                        <div class="card-image">
                            <img src="<?= base_url('img/gestionextras/5.png'); ?>" alt="Banker" class="icon-image">
                        </div>
                    </div>
                </a>
            </div> -->

            <!-- Company -->
            <!-- <div class="col-12 col-md-4 mb-4">
                <a href="< ?= base_url('admin/extrasmanagement/company'); ?>" class="card">
                    <div class="card-content">
                        <div class="card-text">
                            <h5 class="mb-0">Company</h5>
                        </div>
                        <div class="card-image">
                            <img src="<?= base_url('img/gestionextras/4.png'); ?>" alt="Company" class="icon-image">
                        </div>
                    </div>
                </a>
            </div> -->

            <!-- Parameters
            <div class="col-12 col-md-4 mb-4">
                <a href="< ?= base_url('admin/extrasmanagement/parameters'); ?>" class="card">
                    <div class="card-content">
                        <div class="card-text">
                            <h5 class="mb-0">Parameters</h5>
                        </div>
                        <div class="card-image">
                            <img src="< ?= base_url('img/gestionextras/1.png'); ?>" alt="Parameters" class="icon-image">
                        </div>
                    </div>
                </a>
            </div> -->

            <!-- Request Statuses -->
            <div class="col-12 col-md-4 mb-4">
                <a href="<?= base_url('admin/extrasmanagement/request-statuses'); ?>" class="card">
                    <div class="card-content">
                        <div class="card-text">
                            <h5 class="mb-0">Request Statuses</h5>
                        </div>
                        <div class="card-image">
                            <img src="<?= base_url('img/gestionextras/3.png'); ?>" alt="Request Statuses" class="icon-image">
                        </div>
                    </div>
                </a>
            </div>

            <!-- Request Types -->
            <div class="col-12 col-md-4 mb-4">
                <a href="<?= base_url('admin/extrasmanagement/request-types'); ?>" class="card">
                    <div class="card-content">
                        <div class="card-text">
                            <h5 class="mb-0">Request Types</h5>
                        </div>
                        <div class="card-image">
                            <img src="<?= base_url('img/gestionextras/3.png'); ?>" alt="Request Types" class="icon-image">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

