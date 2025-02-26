<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonUser" class="btn btn-primary" data-toggle="modal"
                    data-target="#addUserModal">
                <i class="fas fa-user-plus"></i> Add User
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Identification</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                            <?php if ($user['status'] == 'active'): ?>
                                <span class="badge badge-success">Active</span>
                                <button class="btn btn-sm btn-success ml-2" title="User is active">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            <?php else: ?>
                                <span class="badge badge-danger">Inactive</span>
                                <button class="btn btn-sm btn-danger ml-2" title="User is inactive">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            <?php endif; ?>
                        </td>

                        <td class="text-center">
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-<?= $user['id_user'] ?>" title="View Details">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $user['id_user'] ?>" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $user['id_user'] ?>" title="Delete User">
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
