<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="h3 mb-2 text-gray-800">User Management</h1>
<p class="mb-4">Here you can manage the system users.</p>

<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
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
                        <th>ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Identification</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id_user'] ?></td>
                            <td><?= $usuario['name'] ?></td>
                            <td><?= $usuario['last_name'] ?></td>
                            <td><?= $usuario['identification'] ?></td>
                            <td><?= $usuario['phone'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['role_name'] ?></td>
                            <td><?= isset($usuario['status']) ? $usuario['status'] : 'N/A' ?></td>
                            <td>
                            <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-<?= $usuario['id_user'] ?>" title="Ver detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $usuario['id_user'] ?>" title="Editar usuario">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $usuario['id_user'] ?>" title="Eliminar usuario">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                        </tr>

                        <!-- Modal to view user details -->
                        <div class="modal fade" id="detailsModal-<?= $usuario['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel-<?= $usuario['id_user'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailsModalLabel-<?= $usuario['id_user'] ?>">User Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>ID:</strong> <?= $usuario['id_user'] ?></p>
                                        <p><strong>Name:</strong> <?= $usuario['name'] ?></p>
                                        <p><strong>Last Name:</strong> <?= $usuario['last_name'] ?></p>
                                        <p><strong>Identification:</strong> <?= $usuario['identification'] ?></p>
                                        <p><strong>Phone:</strong> <?= $usuario['phone'] ?></p>
                                        <p><strong>Email:</strong> <?= $usuario['email'] ?></p>
                                        <p><strong>Role:</strong> <?= $usuario['role_name'] ?></p>
                                        <p><strong>Status:</strong> <?= isset($usuario['status']) ? $usuario['status'] : 'N/A' ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal to edit user -->
                        <div class="modal fade" id="editModal-<?= $usuario['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?= $usuario['id_user'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="post" action="<?= base_url('cgestionusuarios/updateusuario/' . $usuario['id_user']) ?>">
                                        <?= csrf_field() ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-<?= $usuario['id_user'] ?>">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?= $usuario['name'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?= $usuario['last_name'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="identification">Identification</label>
                                                <input type="text" class="form-control" id="identification" name="identification" value="<?= $usuario['identification'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="<?= $usuario['phone'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="role_id">Role</label>
                                                <select class="form-control" id="role_id" name="role_id" required>
                                                    <?php foreach ($perfiles as $perfil): ?>
                                                        <option value="<?= esc($perfil['id_role']) ?>" <?= $usuario['role_id'] == $perfil['id_role'] ? 'selected' : '' ?>>
                                                            <?= esc($perfil['role_name']) ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status" required>
                                                    <option value="active" < ?= $usuario['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                                    <option value="inactive" < ?= $usuario['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal to delete user -->
                        <div class="modal fade" id="deleteModal-<?= $usuario['id_user'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel-<?= $usuario['id_user'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel-<?= $usuario['id_user'] ?>">Delete User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this user?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="<?= base_url('cgestionusuarios/deleteusuario/' . $usuario['id_user']) ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal to add user -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?= base_url('cgestionusuarios/addusuario') ?>">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-group">
                        <label for="identification">Identification</label>
                        <input type="text" class="form-control" id="identification" name="identification" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role_id">Role</label>
                        <select class="form-control" id="role_id" name="role_id" required>
                            <?php foreach ($perfiles as $perfil): ?>
                                <option value="<?= esc($perfil['id_role']) ?>"><?= esc($perfil['role_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>