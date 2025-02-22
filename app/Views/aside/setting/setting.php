<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container container-taps">
    <div class="tabs">
        <div class="tab active" data-target="sistema">
            <i class="fas fa-shield-alt"></i> Opciones de Seguridad
        </div>
        <div class="tab" data-target="smtp">
            <i class="fas fa-envelope"></i> SMTP
        </div>
    </div>

    <!-- Opciones de Seguridad -->
    <div class="tab-content active" id="sistema">
        <h3>Opciones de Seguridad</h3>
        <form id="formSeguridad">
            <div class="row">
                <!-- Columna 1 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="autenticacion_2fa">Autenticación de Dos Factores:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="autenticacion_2fa">
                            <label class="custom-control-label" for="autenticacion_2fa">Activar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notificaciones_seguridad">Notificaciones de Seguridad:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="notificaciones_seguridad">
                            <label class="custom-control-label" for="notificaciones_seguridad">Activar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bloqueo_intentos">Bloqueo por Intentos Fallidos:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="bloqueo_intentos">
                            <label class="custom-control-label" for="bloqueo_intentos">Activar</label>
                        </div>
                    </div>
                </div>
                <!-- Columna 2 -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="verificacion_correo">Verificación por Correo:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="verificacion_correo">
                            <label class="custom-control-label" for="verificacion_correo">Activar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contraseña_compleja">Requiere Contraseña Compleja:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="contraseña_compleja">
                            <label class="custom-control-label" for="contraseña_compleja">Activar</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sesion_expirada">Sesión Expirada Automáticamente:</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="sesion_expirada">
                            <label class="custom-control-label" for="sesion_expirada">Activar</label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


   <!-- SMTP -->
<div class="tab-content" id="smtp">
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
               id="smtp_password" name="smtp_password" placeholder="********" 
               >
        <div class="invalid-feedback">
            <?= session('errors-insert.smtp_password') ?>
        </div>
    </div>
  <!-- Checkboxes para TLS y SSL -->
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
    const form = document.getElementById('smtp-form');
console.log(form)   

    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    // Handle tab switching
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            toggleLoader(true, 800)

            const target = tab.getAttribute('data-target');
            localStorage.setItem('activeTab', target);
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(target).classList.add('active');
        });
    });

// Detectar cuando se envíe el formulario

document.addEventListener('DOMContentLoaded', function() {
    const tlsCheckbox = document.getElementById('tls');
        const sslCheckbox = document.getElementById('ssl');

        tlsCheckbox.addEventListener('change', function () {
            if (tlsCheckbox.checked) {
                sslCheckbox.checked = false;
            }
        });

        sslCheckbox.addEventListener('change', function () {
            if (sslCheckbox.checked) {
                tlsCheckbox.checked = false;
            }
        });
    toggleLoader(true, 1000)
    localStorage.getItem('activeTab') ? document.querySelector(`.tab[data-target="${localStorage.getItem('activeTab')}"]`).click() : tabs[0].click();
});


    

    // Handle the change of switch states and send AJAX request
    document.querySelectorAll('.custom-control-input').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const seguridadOptions = {
                autenticacion_2fa: document.getElementById('autenticacion_2fa').checked,
                notificaciones_seguridad: document.getElementById('notificaciones_seguridad').checked,
                bloqueo_intentos: document.getElementById('bloqueo_intentos').checked,
                verificacion_correo: document.getElementById('verificacion_correo').checked,
                contraseña_compleja: document.getElementById('contraseña_compleja').checked,
                sesion_expirada: document.getElementById('sesion_expirada').checked
            };

            // Send the updated security settings to the server using AJAX
            for (const [key, value] of Object.entries(seguridadOptions)) {
                saveSecuritySetting(key, value);
            }
        });
    });

    
</script>


<style>
    .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #007bff;  /* Cambia el color del check al seleccionar */
        border-color: #007bff;
    }

    .custom-checkbox .custom-control-input:checked ~ .custom-control-label {
        color: #007bff;
    }

    .custom-checkbox .custom-control-label::before {
        border-radius: 0.25rem;  /* Hace los bordes del checkbox más redondeados */
    }

    .form-group label {
        font-weight: bold; /* Hace que las etiquetas se vean más prominentes */
    }
    .container-taps {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px; /* Limitar el ancho máximo del contenedor */
        padding: 10px; /* Reducir el padding */
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
        transition: color 0.3s;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        margin-right: 15px;
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

    .tabs .tab:hover {
        color: #000;
    }

    .tab-content {
        display: none;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 0 10px 10px 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin-top: -1px;
    }

    .tab-content.active {
        display: block;
    }

    .tab-content h3 {
        font-size: 1.4rem;
        color: #333;
    }
</style>

<?= $this->endSection() ?>
