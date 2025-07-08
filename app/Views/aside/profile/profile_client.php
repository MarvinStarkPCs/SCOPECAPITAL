<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .profile-card {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
    }

    .profile-header {
        background: linear-gradient(135deg, #FEC659, #FFA500);
        padding: 30px;
        text-align: center;
        color: white;
    }

    .profile-header img {
        border: 4px solid #fff;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .profile-header img:hover {
        transform: scale(1.05);
    }

    .profile-header h3 {
        margin-top: 10px;
        font-weight: bold;
    }

    .profile-header p {
        opacity: 0.8;
    }

    .profile-details {
        padding: 20px;
    }

    .profile-details ul {
        padding: 0;
        list-style: none;
    }

    .profile-details ul li {
        padding: 10px 0;
        border-bottom: 1px solid #f1f1f1;
        color: #555;
        position: relative;
    }

    .profile-details ul li strong {
        color: #333;
    }

    .input-edit {
        gap: 10px;
    }
input[type="number"] {
        text-align: center;
    }
    input[type="text"] {
        text-align: center;
    }
    input[type="email"] {
        text-align: center;
    }
    input[type="file"] {
        text-align: center;
    }


    /* Transiciones suaves para el cambio entre vista y edición */
    .text-display,
    .input-edit {
        transition: all 0.4s ease;
        opacity: 1;
        transform: translateX(0);
    }

    .text-display.hidden {
        opacity: 0;
        transform: translateX(-10px);
        pointer-events: none;
    }

    .input-edit.hidden {
        opacity: 0;
        transform: translateX(10px);
        pointer-events: none;
        height: 0;
        margin: 0;
        padding: 0;
        border: none;
        overflow: hidden;
    }

    .input-edit:not(.hidden) {
        opacity: 1;
        transform: translateX(0);
        margin-top: 5px;
    }

    /* Estilo para los inputs en modo edición */
    .input-edit .form-control {
        border: 2px solid #FEC659;
        border-radius: 8px;
        transition: all 0.3s ease;
        background: rgba(254, 198, 89, 0.05);
    }

    .input-edit .form-control:focus {
        border-color: #FFA500;
        box-shadow: 0 0 0 0.2rem rgba(255, 165, 0, 0.25);
        background: rgba(254, 198, 89, 0.1);
    }

    /* Transición para los botones */
    .edit-btn,
    .save-btn,
    .cancel-btn {
        background: #FEC659;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
        margin: 5px;
        opacity: 1;
        transform: scale(1);
    }

    .edit-btn:hover,
    .save-btn:hover,
    .cancel-btn:hover {
        background: #FFA500;
        transform: scale(1.05);
    }

    .cancel-btn {
        background: #6c757d;
    }

    .cancel-btn:hover {
        background: #5a6268;
    }

    .hidden {
        opacity: 0 !important;
        transform: scale(0.8) !important;
        pointer-events: none;
        margin: 0 !important;
    }

    .preview-img {
        margin-top: 10px;
        max-width: 100px;
        border-radius: 10px;
        border: 2px solid #eee;
        transition: all 0.3s ease;
    }

    /* Efecto de entrada suave para elementos que aparecen */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Indicador visual de modo edición */
    .profile-card.edit-mode {
        border: 2px solid #FEC659;
        box-shadow: 0 6px 12px rgba(254, 198, 89, 0.3);
    }

    .profile-card.edit-mode .profile-header {
        background: linear-gradient(135deg, #f1f1f1, #f1f1f1);
    }

    /* Estilo para el contenedor de campos */
    .field-container {
        position: relative;
        min-height: 40px;
        display: flex;
        align-items: center;
    }

    .field-container .text-display {
        position: absolute;
        width: 100%;
        left: 0;
    }

    .field-container .input-edit {
        position: absolute;
        width: 100%;
        left: 0;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="post" action="<?= base_url('client/profile/update') ?>" enctype="multipart/form-data">
                <div class="profile-card" id="profileCard">
                    <div class="profile-header">
<?php
    // Ruta por defecto de la carpeta donde guardas las imágenes subidas
    $folder = 'upload/profile_images/';

    // Nombre de la imagen en BD (puede venir vacío o null)
    $profileImage = $user['profile_image'] ?? '';
echo "<!-- Ruta de la imagen: $profileImage -->"; // Para depuración
    // Construimos la ruta absoluta en el servidor
    $fullPath = FCPATH . $folder . $profileImage;

    // Si existe nombre y archivo, usamos la imagen del usuario; si no, la SVG por defecto
    $imagen = (! empty($profileImage))
        ? base_url($folder . $profileImage)
        : base_url('upload/profile_images/undraw_profile.svg');
?>
<img id="foto-preview" src="<?= $imagen ?>" alt="Foto de Perfil">


                        <!-- Etiqueta fuera del contenedor editable -->

                        <label class="w-100 mt-3 mb-1" style="color: black; font-weight: bold;">Nombre completo:</label>

                        <!-- Contenedor editable -->
                        <div class="field-container mb-2">
                            <span class="text-display text-white" id="nombre-display"><?= esc($user['name'] . ' ' . $user['last_name'] ?? 'Usuario Desconocido') ?></span>
                            <div class="input-edit hidden d-flex flex-wrap gap-2 w-100">
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nombre" value="<?= esc($user['name']) ?>" style="flex:1;"required>
                                <input type="text" name="last_name" class="form-control form-control-sm" placeholder="Apellido" value="<?= esc($user['last_name']) ?>" style="flex:1;"required>
                            </div>
                        </div>
                        <!-- Rol -->
                        <p class="mt-1"><?= esc($user['role_name'] ?? 'No especificado') ?></p>
                    </div>

                    <div class="profile-details">
                        <ul>
                            <li>
                                <strong>Identification:</strong>
                                <div class="field-container">
                                    <span class="text-display"><?= esc($user['identification']) ?></span>
                                    <div class="input-edit hidden">
                                        <input type="number" name="identification" class="form-control form-control-sm" value="<?= esc($user['identification']) ?>" required>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <strong>Email:</strong>
                                <div class="field-container">
                                    <span class="text-display"><?= esc($user['email']) ?></span>
                                    <div class="input-edit hidden">
                                        <input type="email" name="email" class="form-control form-control-sm" value="<?= esc($user['email']) ?>" required>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <strong>Phone:</strong>
                                <div class="field-container">
                                    <span class="text-display"><?= esc($user['phone']) ?></span>
                                    <div class="input-edit hidden">
                                        <input type="text" name="phone" class="form-control form-control-sm" value="<?= esc($user['phone']) ?>" required>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <strong>Registration Date:</strong>
                                <span><?= esc($user['date_registration']) ?></span>
                            </li>

                            <li>
                                <strong>Address:</strong>
                                <div class="field-container">
                                    <span class="text-display"><?= esc($user['address']) ?></span>
                                    <div class="input-edit hidden">
                                        <input type="text" name="address" class="form-control form-control-sm" value="<?= esc($user['address']) ?>" required>
                                    </div>
                                </div>
                            </li>

                            <li class="hidden input-edit" id="photoField">
                                <strong>Foto:</strong>
                                <input type="file" name="profile_image" accept="image/*" class="form-control form-control-sm" onchange="previewFoto(event)" >
                            </li>
                        </ul>

                        <div class="text-center">
                            <button type="button" class="edit-btn" id="editBtn">Edit profile</button>
                            <button type="submit" class="save-btn hidden" id="saveBtn">Guardar</button>
                            <button type="button" class="cancel-btn hidden" id="cancelBtn">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const profileCard = document.getElementById('profileCard');
    const photoField = document.getElementById('photoField');
    const inputs = document.querySelectorAll('.input-edit');
    const texts = document.querySelectorAll('.text-display');

    // Función para cambiar a modo edición
    function enterEditMode() {
        // Añadir clase de modo edición
        profileCard.classList.add('edit-mode');

        // Transición suave con delays escalonados
        texts.forEach((text, index) => {
            setTimeout(() => {
                text.classList.add('hidden');
            }, index * 50);
        });

        setTimeout(() => {
            inputs.forEach((input, index) => {
                setTimeout(() => {
                    input.classList.remove('hidden');
                    input.classList.add('fade-in');
                }, index * 50);
            });
        }, 200);

        // Cambiar botones
        setTimeout(() => {
            editBtn.classList.add('hidden');
            saveBtn.classList.remove('hidden');
            cancelBtn.classList.remove('hidden');
        }, 300);
    }

    // Función para salir del modo edición
    function exitEditMode() {
        // Quitar clase de modo edición
        profileCard.classList.remove('edit-mode');

        // Transición suave inversa
        inputs.forEach((input, index) => {
            setTimeout(() => {
                input.classList.add('hidden');
                input.classList.remove('fade-in');
            }, index * 50);
        });

        setTimeout(() => {
            texts.forEach((text, index) => {
                setTimeout(() => {
                    text.classList.remove('hidden');
                }, index * 50);
            });
        }, 200);

        // Cambiar botones
        setTimeout(() => {
            saveBtn.classList.add('hidden');
            cancelBtn.classList.add('hidden');
            editBtn.classList.remove('hidden');
        }, 300);
    }

    // Event listeners
    editBtn.addEventListener('click', enterEditMode);
    cancelBtn.addEventListener('click', exitEditMode);

    // Función para previsualizar foto
    function previewFoto(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('foto-preview');
            output.src = reader.result;
            output.style.transform = 'scale(1.1)';
            setTimeout(() => {
                output.style.transform = 'scale(1)';
            }, 300);
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // Añadir efectos de focus en inputs
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });

        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
</script>

<?= $this->endSection() ?>