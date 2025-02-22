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
    }

    .profile-details ul li strong {
        color: #333;
    }

    .edit-btn {
        background: #FEC659;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        transition: background 0.3s ease;
    }

    .edit-btn:hover {
        background: #FFA500;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="<?= base_url('img/undraw_profile.svg'); ?>" alt="Foto de Perfil">
                    <h3><?= esc($user['name'] .' '. $user['last_name']?? 'Usuario Desconocido') ?></h3>
                    <p><?= esc($user['role_name'] ?? 'No especificado') ?></p>
                </div>
                <div class="profile-details">
                    <ul>
                        <li><strong>Identificación:</strong> <?= esc($user['identification'] ?? 'No disponible') ?></li>
                        <li><strong>Correo:</strong> <?= esc($user['email'] ?? 'No disponible') ?></li>
                        <li><strong>Teléfono:</strong> <?= esc($user['phone'] ?? 'No registrado') ?></li>
                        
                        <li><strong>Fecha de Registro:</strong> <?= esc($user['date_registration'] ?? 'No disponible') ?></li>
                        <li><strong>Dirección:</strong> <?= esc($user['address'] ?? 'No proporcionada') ?></li>

                    </ul>

                    <div class="text-center">
                        <button class="edit-btn mt-3">Editar Perfil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
