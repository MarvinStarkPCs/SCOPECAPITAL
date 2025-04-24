<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Estilos personalizados -->
<style>
    .container {
        margin-top: 80px;
        margin-bottom: 100px; /* Separa del footer */
    }
    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        color: #333;
    }
    .input-group-text {
        background: #FEC659;
        border: none;
        color: #333;
        cursor: pointer;
        font-size: 1.1rem;
        padding: 0.5rem;
        border-radius: 8px;
    }
    .form-control {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid #ddd;
        color: #333;
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        background: rgba(0, 0, 0, 0.08);
        border: 1px solid #FEC659;
        box-shadow: none;
        border-radius: 8px;
    }
    .btn-primary {
        background: #FEC659;
        border: none;
        color: #333;
        font-weight: bold;
        transition: background 0.3s ease-in-out;
        border-radius: 8px;
    }
    .btn-primary:hover {
        background: #e0a500;
        color: #fff;
    }
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: #aaa;
        cursor: pointer;
    }
    .toggle-password i {
        pointer-events: none;
    }
</style>

<div class="container d-flex justify-content-center align-items-start">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h4 class="text-center mb-4"><i class="fas fa-key"></i> Cambiar Contraseña</h4>
        <form id="changePasswordForm" method="POST" action="./changepassword/update">
            <?= csrf_field() ?>

            <!-- Contraseña actual -->
            <div class="mb-3 position-relative">
                <label for="current_password" class="form-label">Contraseña Actual</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="current_password" name="current_password" value="<?= old('current_password') ?>" required>
                    <span class="toggle-password" data-target="current_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Nueva contraseña -->
            <div class="mb-3 position-relative">
                <label for="new_password" class="form-label">Nueva Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="new_password" name="new_password" value="<?= old('new_password') ?>" required>
                    <span class="toggle-password" data-target="new_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <small class="text-muted">Mínimo 8 caracteres, incluir una mayúscula y un número.</small>
            </div>

            <!-- Confirmar nueva contraseña -->
            <div class="mb-3 position-relative">
                <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= old('confirm_password') ?>" required>
                    <span class="toggle-password" data-target="confirm_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Mensaje de error -->
            <div class="mb-3">
                <p id="password_error" class="text-danger text-center" style="display: none;">
                    Las contraseñas no coinciden o no cumplen los requisitos.
                </p>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-save"></i> Actualizar Contraseña
            </button>
        </form>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseñas -->
<script>
    document.querySelectorAll(".toggle-password").forEach(button => {
        button.addEventListener("click", function() {
            let input = document.getElementById(this.getAttribute("data-target"));
            let icon = this.querySelector("i");

            // Verifica si el input está de tipo password o text
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }

            // Opcional: Esto hace que el input pierda el foco para mejorar la experiencia del usuario
            input.blur();
        });
    });

    // Validación de contraseñas antes de enviar
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorText = document.getElementById('password_error');

        const valid = /^(?=.*[A-Z])(?=.*\d).{8,}$/.test(newPassword);

        if (newPassword !== confirmPassword || !valid) {
            e.preventDefault();
            errorText.style.display = 'block';
        } else {
            errorText.style.display = 'none';
        }
    });
</script>


<?= $this->endSection() ?>
