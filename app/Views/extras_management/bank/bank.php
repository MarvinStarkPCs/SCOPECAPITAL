<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- DataTable -->
<div class="card shadow mb-4">
<div class="card-header py-3 bg-dark-blue d-flex align-items-center">
    <a href="<?= base_url('admin/extrasmanagement') ?>" class="btn btn-outline-light rounded-circle shadow-sm p-1 mr-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left fa-lg"></i>
    </a>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonbank" class="btn btn-primary" data-toggle="modal"
                data-target="#addbankModal">
                <i class="fas fa-university"></i> Add bank
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>


                        <th>Name</th>
                        <th>Address</th>
                        <th>Account Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($banks as $bank): ?>
                        <tr>
                            <td><?= !empty($bank['name']) ? esc($bank['name']) : 'Not applicable' ?></td>
                            <td><?= !empty($bank['address']) ? esc($bank['address']) : 'Not applicable' ?></td>
                            <td><?= !empty($bank['account_name']) ? esc($bank['account_name']) : 'Not applicable' ?></td>


                            <td class="text-center">
                                <!-- <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-< ?= $bank['id_bank'] ?>" title="View Details">
                                    <i class="fas fa-info-circle"></i>
                                </button> -->
                                <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $bank['id_bank'] ?>" title="Edit bank">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $bank['id_bank'] ?>" title="Delete bank">
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
<?= view('extras_management/bank/modals/Create') ?>
<?= view('extras_management/bank/modals/Update') ?> 
<?= view('extras_management/bank/modals/Delete') ?>

<!-- < ?= view('security/bankManagement/modals/Delete') ?>
< ?= view('security/bankManagement/modals/Detail') ?> -->

<?= $this->endSection() ?>