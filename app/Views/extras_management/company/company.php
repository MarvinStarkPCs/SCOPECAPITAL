<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- DataTable -->
<div class="card shadow mb-4">
<div class="card-header py-3 bg-dark-blue d-flex align-items-center">
    <a href="<?= base_url('admin/extrasmanagement') ?>" class="btn btn-outline-light rounded-circle shadow-sm p-1 mr-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-arrow-left fa-lg"></i>
    </a>
        <h6 class="m-0 font-weight-bold text-primary">List of companys</h6>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <button type="button" id="openModalButtoncompany" class="btn btn-primary" data-toggle="modal"
                data-target="#addcompanyModal">
                <i class="fas fa-building"></i> Add company
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>


                        <th>Name</th>
                        <th>Address</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Representative</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($companies as $company): ?>
                        <tr>
                            <td><?= !empty($company['name']) ? esc($company['name']) : 'Not applicable' ?></td>
                            <td><?= !empty($company['address']) ? esc($company['address']) : 'Not applicable' ?></td>
                            <td><?= !empty($company['telephone']) ? esc($company['telephone']) : 'Not applicable' ?></td>
                            <td><?= !empty($company['email']) ? esc($company['email']) : 'Not applicable' ?></td>
                            <td><?= !empty($company['representative']) ? esc($company['representative']) : 'Not applicable' ?></td>
                            <td class="text-center">
                                <!-- <button class="btn btn-icon btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#detailsModal-< ?= $company['id_company'] ?>" title="View Details">
                                    <i class="fas fa-info-circle"></i>
                                </button> -->
                                <button class="btn btn-icon btn-info btn-sm" data-toggle="modal" id="editButton"
                                    data-target="#editModal-<?= $company['id_company'] ?>" title="Edit company">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-icon btn-danger btn-sm" data-toggle="modal"
                                    data-target="#deleteModal-<?= $company['id_company'] ?>" title="Delete company">
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
<?= view('extras_management/company/modals/Create') ?>
<?= view('extras_management/company/modals/Delete') ?>
<?= view('extras_management/company/modals/Update') ?> 

<!-- 
< ?= view('security/companyManagement/modals/Detail') ?> -->

<?= $this->endSection() ?>