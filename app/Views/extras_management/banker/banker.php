<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- DataTable -->
<div class="card shadow mb-4">
<div class="card-header py-3 bg-dark-blue d-flex align-items-center">
    <a href="<?= base_url('admin/extrasmanagement') ?>" class="btn btn-outline-light rounded-circle shadow-sm p-1 mr-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left fa-lg"></i>
    </a>
        <h6 class="m-0 font-weight-bold text-primary">List of bankers</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonbanker" class="btn btn-primary" data-toggle="modal"
                data-target="#addbankerModal">
                <i class="fas fa-user-tie"></i> Add banker
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>


                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($bankers as $banker): ?>
                        <tr>
                            <td><?= !empty($banker['name']) ? esc($banker['name']) : 'Not applicable' ?></td>
                            <td><?= !empty($banker['email']) ? esc($banker['email']) : 'Not applicable' ?></td>
                            <td><?= !empty($banker['telephone']) ? esc($banker['telephone']) : 'Not applicable' ?></td>


                            <td class="text-center">
                                <!-- <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-< ?= $banker['id_banker'] ?>" title="View Details">
                                    <i class="fas fa-info-circle"></i>
                                </button> -->
                                <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $banker['id_banker'] ?>" title="Edit banker">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $banker['id_banker'] ?>" title="Delete banker">
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
<?= view('extras_management/banker/modals/Create') ?>
<?= view('extras_management/banker/modals/Update') ?> 
<?= view('extras_management/banker/modals/Delete') ?>

<!-- < ?= view('security/bankerManagement/modals/Delete') ?>
< ?= view('security/bankerManagement/modals/Detail') ?> -->

<?= $this->endSection() ?>