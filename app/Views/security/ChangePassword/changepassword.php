<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Agregar Font Awesome -->

<style>
    .container {
        margin-top: 80px;
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
        border-radius: 8px; /* Bordes redondeados */
    }
    .form-control {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid #ddd;
        color: #333;
        border-radius: 8px; /* Bordes redondeados */
        transition: border-color 0.3s ease;
    }
    .form-control:focus {
        background: rgba(0, 0, 0, 0.08);
        border: 1px solid #FEC659;
        box-shadow: none;
        border-radius: 8px; /* Bordes redondeados */
    }
    .btn-primary {
        background: #FEC659;
        border: none;
        color: #333;
        font-weight: bold;
        transition: background 0.3s ease-in-out;
        border-radius: 8px; /* Bordes redondeados */
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
            <div class="mb-3 position-relative">
                <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="conf1                    <span class="toggle-password" data-target="confirm_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <p id="password_error" class="text-danger text-center" style="display: none;">
                    Las contraseñas no coinciden o no cumplen los requisitos.
                </p>
            </div>
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save"></i> Actualizar Contraseña</button>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll(".toggle-password").forEach(button => {
        button.addEventListener("click", function() {
            let input = document.getElementById(this.getAttribute("data-target"));
            let icon = this.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });
</script>

<?= $this->endSection() ?>
