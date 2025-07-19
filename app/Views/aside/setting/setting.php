<?= $this->extend('layouts/main') ?> 
<?= $this->section('content') ?>

<div class="container container-taps">
    <div class="tabs">
        <div class="tab active" data-target="smtp">
            <i class="fas fa-envelope"></i> SMTP
        </div>
    </div>

    <!-- SMTP -->
    <div class="tab-content active" id="smtp">
        <h3>Configuración SMTP</h3>

        <form id="smtp-form" method="post" action="./setting/save_smtp">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="host">Servidor SMTP:</label>
                <input type="text"
                    class="no-uppercase form-control <?= session('errors-insert.host') ? 'is-invalid errors-insert' : '' ?>"
                    id="host" name="host" placeholder="smtp.ejemplo.com" 
                    value="<?= old('host', isset($stmp_config['host']) ? $stmp_config['host'] : '') ?>">
                <div class="invalid-feedback">
                    <?= session('errors-insert.host') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="port">Puerto:</label>
                <input type="number"
                    class="form-control <?= session('errors-insert.port') ? 'is-invalid errors-insert' : '' ?>"
                    id="port" name="port" placeholder="587" 
                    value="<?= old('port', isset($stmp_config['port']) ? $stmp_config['port'] : '') ?>">
                <div class="invalid-feedback">
                    <?= session('errors-insert.port') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="username">Usuario SMTP:</label>
                <input type="email"
                    class="form-control <?= session('errors-insert.username') ? 'is-invalid errors-insert' : '' ?>"
                    id="username" name="username" placeholder="usuario@ejemplo.com" 
                    value="<?= old('username', isset($stmp_config['username']) ? $stmp_config['username'] : '') ?>">
                <div class="invalid-feedback">
                    <?= session('errors-insert.username') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="smtp_password">Contraseña:</label>
                <input type="password"
                    class="form-control <?= session('errors-insert.smtp_password') ? 'is-invalid errors-insert' : '' ?>"
                    id="smtp_password" name="smtp_password" placeholder="********">
                <div class="invalid-feedback">
                    <?= session('errors-insert.smtp_password') ?>
                </div>
            </div>

            <div class="form-group">
                <label for="tls_ssl">Selección de seguridad:</label><br>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" id="tls" name="security" value="tls" 
                        class="custom-control-input"
                        <?= (isset($stmp_config['security']) && $stmp_config['security'] == 'tls') ? 'checked' : '' ?>>
                    <label class="custom-control-label" for="tls">TLS</label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" id="ssl" name="security" value="ssl" 
                        class="custom-control-input"
                        <?= (isset($stmp_config['security']) && $stmp_config['security'] == 'ssl') ? 'checked' : '' ?>>
                    <label class="custom-control-label" for="ssl">SSL</label>
                </div>
                <div class="invalid-feedback">
                    <?= session('errors-insert.security') ?>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar Configuración SMTP</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tlsCheckbox = document.getElementById('tls');
        const sslCheckbox = document.getElementById('ssl');

        tlsCheckbox.addEventListener('change', function () {
            if (tlsCheckbox.checked) sslCheckbox.checked = false;
        });

        sslCheckbox.addEventListener('change', function () {
            if (sslCheckbox.checked) tlsCheckbox.checked = false;
        });

        toggleLoader(true, 1000);
    });
</script>

<style>
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #007bff;
        border-color: #007bff;
    }

    .custom-checkbox .custom-control-input:checked ~ .custom-control-label {
        color: #007bff;
    }

    .custom-checkbox .custom-control-label::before {
        border-radius: 0.25rem;
    }

    .form-group label {
        font-weight: bold;
    }

    .container-taps {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        padding: 10px;
    }

    .tabs {
        display: flex;
        justify-content: flex-start;
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
        padding: 10px 20px;
        border-radius: 10px;
    }

    .tabs .tab {
        padding: 10px 20px;
        background: transparent;
        color: #555;
        border: none;
        cursor: pointer;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .tabs .tab i {
        margin-right: 8px;
        font-size: 1.2rem;
    }

    .tabs .tab.active {
        color: #000;
        font-weight: bold;
        border-bottom: 3px solid #007bff;
    }

    .tab-content {
        display: block;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 0 10px 10px 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: -1px;
    }

    .tab-content h3 {
        font-size: 1.4rem;
        color: #333;
    }
</style>

<?= $this->endSection() ?>
