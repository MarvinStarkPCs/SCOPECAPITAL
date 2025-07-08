<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Estilos personalizados -->
<style>
    .container {
        margin-top: 80px;
        margin-bottom: 100px;
    }

    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        color: #333;
    }

    .input-group-text {
        background: #FEC659;
        border: none;
        color: #333;
        font-size: 1.1rem;
        padding: 0.5rem;
        border-radius: 12px;
    }

    .form-control {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid #ddd;
        color: #333;
        border-radius: 12px !important;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        background: rgba(0, 0, 0, 0.08);
        border: 1px solid #FEC659;
        box-shadow: none;
    }

    .btn-primary {
        background: #FEC659;
        border: none;
        color: #333;
        font-weight: bold;
        transition: background 0.3s ease-in-out;
        border-radius: 12px;
    }

    .btn-primary:hover {
        background: #e0a500;
        color: #fff;
    }

    .toggle-password {
        cursor: pointer;
        background: transparent;
        border: none;
        padding: 0 0.75rem;
        color: #aaa;
        border-radius: 12px;
    }

    .toggle-password i {
        pointer-events: none;
    }

    .input-group > .form-control,
    .input-group > .input-group-text {
        border-radius: 12px !important;
    }
</style>

<div class="container d-flex justify-content-center align-items-start">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h4 class="text-center mb-4"><i class="fas fa-key"></i> Change password</h4>
        <form id="changePasswordForm" method="POST" action="./changepassword/update">
            <?= csrf_field() ?>

            <!-- Contraseña actual -->
            <div class="mb-3">
                <label for="current_password" class="form-label">Current password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="current_password" name="current_password" value="<?= old('current_password') ?>" required>
                    <span class="input-group-text toggle-password" data-target="current_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Nueva contraseña -->
            <div class="mb-3">
                <label for="new_password" class="form-label">New password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="new_password" name="new_password" value="<?= old('new_password') ?>" required>
                    <span class="input-group-text toggle-password" data-target="new_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <small class="text-muted">Minimum 8 characters, including one uppercase letter and one number.</small>
            </div>

            <!-- Confirmar nueva contraseña -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm new password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="<?= old('confirm_password') ?>" required>
                    <span class="input-group-text toggle-password" data-target="confirm_password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>

            <!-- Mensaje de error -->
            <div class="mb-3">
                <p id="password_error" class="text-danger text-center" style="display: none;">
                    Make sure both passwords match and meet the requirements.
                </p>
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-save"></i> Change password
            </button>
        </form>
    </div>
</div>

<!-- Script para mostrar/ocultar contraseñas y validar -->
<script>
    document.querySelectorAll(".toggle-password").forEach(button => {
        button.addEventListener("click", function () {
            const input = document.getElementById(this.getAttribute("data-target"));
            const icon = this.querySelector("i");

            if (input.type === "password") {
                input.type = "text";
                icon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.replace("fa-eye-slash", "fa-eye");
            }

            input.blur();
        });
    });

    document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
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
