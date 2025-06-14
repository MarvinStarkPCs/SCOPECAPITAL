<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">detailar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="location.reload();">
                    <span >&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('./admin/clientmanagement/update/') ?>" id="editForm" method="post"
                    class="detail-form">
                    <?= csrf_field() ?>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="detailTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-client" data-toggle="tab" href="#detail-client"
                                role="tab">Client</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-banking" data-toggle="tab" href="#detail-banking"
                                role="tab">Banking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-financial" data-toggle="tab" href="#detail-financial"
                                role="tab">Financial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-system" data-toggle="tab" href="#detail-system"
                                role="tab">System</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-agreement" data-toggle="tab" href="#detail-agreement"
                                role="tab">Agreement</a>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content pt-3" id="detailTabContent">
                        <!-- Tab 1: client -->
                        <div class="tab-pane fade show active" id="detail-client" role="tabpanel">
                            <h5 class="text-primary">Client Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                        class="form-control <?= session('errors-detail.name') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('name') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.name') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name"
                                        class="form-control <?= session('errors-detail.last_name') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('last_name') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.last_name') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>identification</label>
                                    <input type="text" name="identification"
                                        class="form-control <?= session('errors-detail.identification') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('identification') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.identification') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                        class="form-control <?= session('errors-detail.email') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('email') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.email') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone</label>
                                    <input type="tel" name="phone"
                                        class="form-control <?= session('errors-detail.phone') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('phone') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.phone') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Address</label>
                                    <textarea name="address"
                                        class="form-control <?= session('errors-detail.address') ? 'is-invalid errors-detail' : '' ?>"><?= old('address') ?></textarea>
                                    <div class="invalid-feedback"><?= session('errors-detail.address') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trust</label>
                                    <input type="text" name="trust"
                                        class="form-control <?= session('errors-detail.phone') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('trust') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.trust') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email Trust</label>
                                    <input type="email_del_trust" name="email_del_trust"
                                        class="form-control <?= session('errors-detail.email_del_trust') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('email_del_trust') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.email_del_trust') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>
                        <!-- Tab 2: banking -->
                        <div class="tab-pane fade" id="detail-banking" role="tabpanel">
                            <h5 class="text-primary">Banking Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Bank</label>
                                    <input type="text" name="bank"
                                        class="form-control <?= session('errors-detail.bank') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('bank') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.bank') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SWIFT</label>
                                    <input type="text" name="swift"
                                        class="form-control <?= session('errors-detail.swift') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('swift') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.swift') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ABA</label>
                                    <input type="text" name="aba"
                                        class="form-control <?= session('errors-detail.aba') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('aba') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.aba') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>IBAN</label>
                                    <input type="text" name="iban"
                                        class="form-control <?= session('errors-detail.iban') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('iban') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.iban') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Account</label>
                                    <input type="text" name="account"
                                        class="form-control <?= session('errors-detail.account') ? 'is-invalid errors-detail' : '' ?>"
                                        value="<?= old('account') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.account') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>
                        <!-- Tab 3: Fincial-->
                        <div class="tab-pane fade" id="detail-financial" role="tabpanel">
                            <h5 class="text-primary">Financial</h5>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="Principal">Principal</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.Principal') ? 'is-invalid errors-detail' : '' ?>"
                                      name="Principal" placeholder="Principal"
                                        value="<?= old('Principal') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.Principal') ?></div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputRate">Interest Rate</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.rate') ? 'is-invalid errors-detail' : '' ?>"
                                       name="rate" placeholder="Interest Rate"
                                        value="<?= old('rate') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.rate') ?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCompoundingPeriods">Periods</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.compoundingPeriods') ? 'is-invalid errors-detail' : '' ?>"
                                      name="compoundingPeriods"
                                        placeholder="Compounding Periods" value="<?= old('compoundingPeriods') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.compoundingPeriods') ?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputTime">Time (Years)</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.time') ? 'is-invalid errors-detail' : '' ?>"
                                        name="time" placeholder="Time in Years"
                                        value="<?= old('time') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.time') ?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputBalance">Formula</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.balance') ? 'is-invalid errors-detail' : '' ?>"
                                        name="balance" placeholder="Balance"
                                        value="<?= old('balance') ?>" readonly>
                                    <div class="invalid-feedback"><?= session('errors-detail.balance') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>

                        <!-- Tab 4: System-->
                        <div class="tab-pane fade" id="detail-system" role="tabpanel">
                            <h5 class="text-primary">System Access</h5>
                            <div class="form-row">
                               
                                <div class="form-group col-md-4">
                                    <label>Estado</label>
                                    <select name="status"
                                        class="form-control <?= session('errors-detail.status') ? 'is-invalid errors-detail' : '' ?>">
                                        <option value="">Selecciona estado</option>
                                        <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Activo
                                        </option>
                                        <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback"><?= session('errors-detail.status') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>
                        <!-- Tab 5: Agreement-->
                        <div class="tab-pane fade" id="detail-agreement" role="tabpanel">
                            <h5 class="text-info">Agreement Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputAgreement">Agreement</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.agreement') ? 'is-invalid errors-detail' : '' ?>"
                                        name="agreement" placeholder="Agreement"
                                        value="<?= old('agreement') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.agreement') ?></div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputNumber">Number</label>
                                    <input type="number"
                                        class="form-control <?= session('errors-detail.number') ? 'is-invalid errors-detail' : '' ?>"
                                        name="number" placeholder="Number"
                                        value="<?= old('number') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.number') ?></div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputLetter">Letter</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.letter') ? 'is-invalid errors-detail' : '' ?>"
                                         name="letter" placeholder="Letter"
                                        value="<?= old('letter') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.letter') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPolicy">Policy</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.policy') ? 'is-invalid errors-detail' : '' ?>"
                                         name="policy" placeholder="Policy"
                                        value="<?= old('policy') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.policy') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDateFrom">From</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-detail.date_from') ? 'is-invalid errors-detail' : '' ?>"
                                       name="date_from" value="<?= old('date_from') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.date_from') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDateTo">To</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-detail.date_to') ? 'is-invalid errors-detail' : '' ?>"
                                     name="date_to" value="<?= old('date_to') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.date_to') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApprovedBy">Approved By</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-detail.approved_by') ? 'is-invalid errors-detail' : '' ?>"
                                        name="approved_by" placeholder="Approved By"
                                        value="<?= old('approved_by') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.approved_by') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApprovedDate">Approved Date</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-detail.approved_date') ? 'is-invalid errors-detail' : '' ?>"
                                        name="approved_date" value="<?= old('approved_date') ?>">
                                    <div class="invalid-feedback"><?= session('errors-detail.approved_date') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Tabs -->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
    $(document).on('click', '.btn-edit', function (e) {
        e.preventDefault();
        const id_client = $(this).data('id');
        console.log(id_client);
        const url = '<?= base_url('admin/clientmanagement/getClient/') ?>' + id_client;
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data) {
                    // Populate the form fields with the user data
                    $('#editForm').find('input[name="name"]').val(data.name);
                    $('#editForm').find('input[name="last_name"]').val(data.last_name);
                    $('#editForm').find('input[name="identification"]').val(data.identification);
                    $('#editForm').find('input[name="email"]').val(data.email);
                    $('#editForm').find('input[name="phone"]').val(data.phone);
                    $('#editForm').find('textarea[name="address"]').val(data.address);
                    $('#editForm').find('input[name="trust"]').val(data.trust);
                    $('#editForm').find('input[name="email_del_trust"]').val(data.email_del_trust);
                    $('#editForm').find('input[name="bank"]').val(data.bank);
                    $('#editForm').find('input[name="swift"]').val(data.swift);
                    $('#editForm').find('input[name="aba"]').val(data.aba);
                    $('#editForm').find('input[name="iban"]').val(data.iban);
                    $('#editForm').find('input[name="account"]').val(data.account);
                    $('#editForm').find('input[name="Principal"]').val(data.Principal);
                    $('#editForm').find('input[name="rate"]').val(data.rate);
                    $('#editForm').find('input[name="compoundingPeriods"]').val(data.compoundingPeriods);
                    $('#editForm').find('input[name="time"]').val(data.time);
                    $('#editForm').find('input[name="balance"]').val(data.balance);
                    $('#editForm').find('select[name="status"]').val(data.status);
                    $('#editForm').find('input[name="agreement"]').val(data.agreement);
                    $('#editForm').find('input[name="number"]').val(data.number);
                    $('#editForm').find('input[name="letter"]').val(data.letter);
                    $('#editForm').find('input[name="policy"]').val(data.policy);
                    $('#editForm').find('input[name="date_from"]').val(data.date_from);
                    $('#editForm').find('input[name="date_to"]').val(data.date_to);
                    $('#editForm').find('input[name="approved_by"]').val(data.approved_by);
                    $('#editForm').find('input[name="approved_date"]').val(data.approved_date);
                    // Add more fields as necessary
                    // For example, if you have a field for the user's role:
                    // Continue for other fields...
                } else {
                    alert('Error loading user data');
                }
            },
            error: function () {
                alert('Error connecting to server');
            }
        });
    });
});

</script>