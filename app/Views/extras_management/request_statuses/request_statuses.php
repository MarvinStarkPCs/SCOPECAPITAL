<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- DataTable -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-dark-blue d-flex align-items-center">
        <a href="<?= base_url('admin/extrasmanagement') ?>" 
           class="btn btn-outline-light rounded-circle shadow-sm p-1 mr-2" 
           style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-arrow-left fa-lg"></i>
        </a>
    </div>

    <div class="card-body">
        <!-- <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtonbank" class="btn btn-primary" data-toggle="modal"
                data-target="#addbankModal">
                <i class="fas fa-clipboard-list" ></i> Add Bank
            </button>
        </div> -->

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>description</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($request_statuses as $request_status): ?>
                        <tr>
                            <td><?= !empty($request_status['name']) ? esc($request_status['name']) : 'Not applicable' ?></td>
                            <td><?= !empty($request_status['description']) ? esc($request_status['description']) : 'Not applicable' ?></td>

                            <td class="text-center">
                                <button class="btn btn-icon btn-info btn-sm" data-toggle="modal"
                                    data-target="#editModal-<?= $request_status['id_status'] ?>" title="Edit bank">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-< ?= $request_status['id_status'] ?>" title="Delete bank">
                                    <i class="fas fa-trash-alt"></i>
                                </button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
