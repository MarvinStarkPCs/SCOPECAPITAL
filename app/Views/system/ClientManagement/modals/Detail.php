<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('./admin/clientmanagement/update/') ?>" id="detailForm" method="post"
                    class="edit-form">
                    <?= csrf_field() ?>

                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="editTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-client" data-toggle="tab" href="#edit-client"
                                role="tab">Client</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-banking" data-toggle="tab" href="#edit-banking"
                                role="tab">Banking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-financial" data-toggle="tab" href="#edit-financial"
                                role="tab">Financial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-system" data-toggle="tab" href="#edit-system"
                                role="tab">System</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-agreement" data-toggle="tab" href="#edit-agreement"
                                role="tab">Agreement</a>
                        </li>
                    </ul>

                    <!-- Tabs Content -->
                    <div class="tab-content pt-3" id="editTabContent">
                        <!-- Tab 1: client -->
                        <div class="tab-pane fade show active" id="edit-client" role="tabpanel">
                            <h5 class="text-primary">Client Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Name</label>
                                    <input type="text" name="name"
                                        class="form-control <?= session('errors-edit.name') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('name') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.name') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name"
                                        class="form-control <?= session('errors-edit.last_name') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('last_name') ?>" readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.last_name') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>identification</label>
                                    <input type="text" name="identification"
                                        class="form-control <?= session('errors-edit.identification') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('identification') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.identification') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                        class="form-control <?= session('errors-edit.email') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('email') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.email') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone</label>
                                    <input type="tel" name="phone"
                                        class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('phone') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.phone') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Address</label>
                                    <textarea name="address"
                                        class="form-control <?= session('errors-edit.address') ? 'is-invalid errors-edit' : '' ?>"readonly><?= old('address') ?></textarea>
                                    <div class="invalid-feedback"><?= session('errors-edit.address') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trust</label>
                                    <input type="text" name="trust"
                                        class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('trust') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.trust') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email Trust</label>
                                    <input type="email_del_trust" name="email_del_trust"
                                        class="form-control <?= session('errors-edit.email_del_trust') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('email_del_trust') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.email_del_trust') ?></div>
                                </div>
                                  <div class="form-group col-md-4">
                                    <label>phone del trust</label>
                                    <input type="tel" name="telephone_del_trust"
                                        class="form-control <?= session('errors-edit.telephone_del_trust') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('telephone_del_trust') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.telephone_del_trust') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>
                        <!-- Tab 2: banking -->
                        <div class="tab-pane fade" id="edit-banking" role="tabpanel">
                            <h5 class="text-primary">Banking Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Bank</label>
                                    <input type="text" name="bank"
                                        class="form-control <?= session('errors-edit.bank') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('bank') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.bank') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SWIFT</label>
                                    <input type="text" name="swift"
                                        class="form-control <?= session('errors-edit.swift') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('swift') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.swift') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ABA</label>
                                    <input type="text" name="aba"
                                        class="form-control <?= session('errors-edit.aba') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('aba') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.aba') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>IBAN</label>
                                    <input type="text" name="iban"
                                        class="form-control <?= session('errors-edit.iban') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('iban') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.iban') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Account</label>
                                    <input type="text" name="account"
                                        class="form-control <?= session('errors-edit.account') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('account') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.account') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>
                        <!-- Tab 3: Fincial-->
                        <div class="tab-pane fade" id="edit-financial" role="tabpanel">
                            <h5 class="text-primary">Financial</h5>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="Principal">Principal</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.Principal') ? 'is-invalid errors-edit' : '' ?>"
                                        name="Principal" placeholder="Principal"
                                        value="<?= old('Principal') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.Principal') ?></div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputRate">Interest Rate</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.rate') ? 'is-invalid errors-edit' : '' ?>"
                                      name="rate" placeholder="Interest Rate"
                                        value="<?= old('rate') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.rate') ?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCompoundingPeriods">Periods</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.compoundingPeriods') ? 'is-invalid errors-edit' : '' ?>"
                                         name="compoundingPeriods"
                                        placeholder="Compounding Periods" value="<?= old('compoundingPeriods') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.compoundingPeriods') ?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputTime">Time (Years)</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.time') ? 'is-invalid errors-edit' : '' ?>"
                                       name="time" placeholder="Time in Years"
                                        value="<?= old('time') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.time') ?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputBalance">Formula</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.balance') ? 'is-invalid errors-edit' : '' ?>"
                                         name="balance" placeholder="Balance"
                                        value="<?= old('balance') ?>" readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.balance') ?></div>
                                </div>
                              
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>

                        <!-- Tab 4: System-->
                        <div class="tab-pane fade" id="edit-system" role="tabpanel">
                            <h5 class="text-primary">System Access</h5>
                            <div class="form-row">
                             
                                <div class="form-group col-md-4">
                                    <label>Estado</label>
                                    <select disabled name="status"
                                        class="form-control <?= session('errors-edit.status') ? 'is-invalid errors-edit' : '' ?>">
                                        <option value="">Selecciona estado</option>
                                        <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Activo
                                        </option>
                                        <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>
                                            Inactivo</option>
                                    </select >
                                    <div class="invalid-feedback"><?= session('errors-edit.status') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <button type="button" class="btn btn-primary next-tab">Next</button>
                            </div>
                        </div>
                        <!-- Tab 5: Agreement-->
                        <div class="tab-pane fade" id="edit-agreement" role="tabpanel">
                            <h5 class="text-info">Agreement Information</h5>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputAgreement">Agreement</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.agreement') ? 'is-invalid errors-edit' : '' ?>"
                                        name="agreement" placeholder="Agreement"
                                        value="<?= old('agreement') ?>" readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.agreement') ?></div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputNumber">Number</label>
                                    <input type="number"
                                        class="form-control <?= session('errors-edit.number') ? 'is-invalid errors-edit' : '' ?>"
                                         name="number" placeholder="Number"
                                        value="<?= old('number') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.number') ?></div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputLetter">Letter</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.letter') ? 'is-invalid errors-edit' : '' ?>"
                                       name="letter" placeholder="Letter"
                                        value="<?= old('letter') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.letter') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPolicy">Policy</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.policy') ? 'is-invalid errors-edit' : '' ?>"
                                         name="policy" placeholder="Policy"
                                        value="<?= old('policy') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.policy') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDateFrom">From</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-edit.date_from') ? 'is-invalid errors-edit' : '' ?>"
                                        name="date_from" value="<?= old('date_from') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.date_from') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDateTo">To</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-edit.date_to') ? 'is-invalid errors-edit' : '' ?>"
                                         name="date_to" value="<?= old('date_to') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.date_to') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApprovedBy">Approved By</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.approved_by') ? 'is-invalid errors-edit' : '' ?>"
                                      name="approved_by" placeholder="Approved By"
                                        value="<?= old('approved_by') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.approved_by') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApprovedDate">Approved Date</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-edit.approved_date') ? 'is-invalid errors-edit' : '' ?>"
                                       name="approved_date" value="<?= old('approved_date') ?>"readonly>
                                    <div class="invalid-feedback"><?= session('errors-edit.approved_date') ?></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
   $(document).on('click', '.btn-detail', function (e) {
        e.preventDefault();
        const id_client = $(this).data('id');
     
        const url = '<?= base_url('admin/clientmanagement/getClient/') ?>' + id_client;
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data) {
                    // Populate the form fields with the user data
                    $('#detailForm').find('input[name="name"]').val(data.name);
                    $('#detailForm').find('input[name="last_name"]').val(data.last_name);
                    $('#detailForm').find('input[name="identification"]').val(data.identification);
                    $('#detailForm').find('input[name="email"]').val(data.email);
                    $('#detailForm').find('input[name="phone"]').val(data.phone);
                    $('#detailForm').find('textarea[name="address"]').val(data.address);
                    $('#detailForm').find('input[name="trust"]').val(data.trust);
                    $('#detailForm').find('input[name="email_del_trust"]').val(data.email_del_trust);
                    $('#detailForm').find('input[name="telephone_del_trust"]').val(data.telephone_del_trust);
                    $('#detailForm').find('input[name="bank"]').val(data.bank);
                    $('#detailForm').find('input[name="swift"]').val(data.swift);
                    $('#detailForm').find('input[name="aba"]').val(data.aba);
                    $('#detailForm').find('input[name="iban"]').val(data.iban);
                    $('#detailForm').find('input[name="account"]').val(data.account);
                    $('#detailForm').find('input[name="Principal"]').val(data.principal);
                    $('#detailForm').find('input[name="rate"]').val(data.rate);
                    $('#detailForm').find('input[name="compoundingPeriods"]').val(data.compoundingPeriods);
                    $('#detailForm').find('input[name="time"]').val(data.time);
                    $('#detailForm').find('input[name="balance"]').val(data.balance);
                    $('#detailForm').find('select[name="status"]').val(data.status);
                    $('#detailForm').find('input[name="agreement"]').val(data.agreement);
                    $('#detailForm').find('input[name="number"]').val(data.number);
                    $('#detailForm').find('input[name="letter"]').val(data.letter);
                    $('#detailForm').find('input[name="policy"]').val(data.policy);
                    $('#detailForm').find('input[name="date_from"]').val(data.date_from);
                    $('#detailForm').find('input[name="date_to"]').val(data.date_to);
                    $('#detailForm').find('input[name="approved_by"]').val(data.approved_by);
                    $('#detailForm').find('input[name="approved_date"]').val(data.approved_date);
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