<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List of users</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonUser" class="btn btn-primary" data-toggle="modal"
                    data-target="#addUserModal">
                <i class="fas fa-user-plus"></i> add user
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Nombre y apellido</th>
                    <th>Identificación</th>
                    <th>Correo</th>
                    <th>Perfil</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['name'] . ' ' . $user['last_name']) ?></td>
                        <td><?= esc($user['identification']) ?></td>
                        <td><?= esc($user['email']) ?></td>
                        <td><?= esc($user['role_name']) ?></td>
                        <td class="text-center">
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-<?= $user['id_user'] ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $user['id_user'] ?>" title="Editar user">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $user['id_user'] ?>" title="Eliminar user">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('security/UserManagement/modals/Create') ?>
<?= view('security/UserManagement/modals/Delete') ?>
<?= view('security/UserManagement/modals/Detail') ?>
<?= view('security/UserManagement/modals/Update') ?>


<?= $this->endSection() ?>