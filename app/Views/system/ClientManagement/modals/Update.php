<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">detailar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onclick="location.reload();">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" class="detail-form">
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
                                        class="form-control <?= session('errors-edit.name') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('name') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.name') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name"
                                        class="form-control <?= session('errors-edit.last_name') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('last_name') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.last_name') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>identification</label>
                                    <input type="text" name="identification"
                                        class="form-control <?= session('errors-edit.identification') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('identification') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.identification') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                        class="form-control <?= session('errors-edit.email') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('email') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.email') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone</label>
                                    <input type="tel" name="phone"
                                        class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('phone') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.phone') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Address</label>
                                    <textarea name="address"
                                        class="form-control <?= session('errors-edit.address') ? 'is-invalid errors-edit' : '' ?>"><?= old('address') ?></textarea>
                                    <div class="invalid-feedback"><?= session('errors-edit.address') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Trust</label>
                                    <input type="text" name="trust"
                                        class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('trust') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.trust') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email Trust</label>
                                    <input type="email_del_trust" name="email_del_trust"
                                        class="form-control <?= session('errors-edit.email_del_trust') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('email_del_trust') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.email_del_trust') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>phone del trust</label>
                                    <input type="tel" name="telephone_del_trust"
                                        class="form-control <?= session('errors-edit.telephone_del_trust') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('telephone_del_trust') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.telephone_del_trust') ?>
                                    </div>
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
                                        class="form-control <?= session('errors-edit.bank') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('bank') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.bank') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>SWIFT</label>
                                    <input type="text" name="swift"
                                        class="form-control <?= session('errors-edit.swift') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('swift') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.swift') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ABA</label>
                                    <input type="text" name="aba"
                                        class="form-control <?= session('errors-edit.aba') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('aba') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.aba') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>IBAN</label>
                                    <input type="text" name="iban"
                                        class="form-control <?= session('errors-edit.iban') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('iban') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.iban') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Account</label>
                                    <input type="text" name="account"
                                        class="form-control <?= session('errors-edit.account') ? 'is-invalid errors-edit' : '' ?>"
                                        value="<?= old('account') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.account') ?></div>
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
                                    <label for="principal">Principal</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.principal') ? 'is-invalid errors-edit financial' : '' ?>"
                                        name="principal" placeholder="principal" value="<?= old('principal') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.principal') ?></div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputRate">Interest Rate</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.rate') ? 'is-invalid errors-edit financial' : '' ?>"
                                        name="rate" placeholder="Interest Rate" value="<?= old('rate') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.rate') ?></div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputCompoundingPeriods">Periods</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.compoundingPeriods') ? 'is-invalid errors-edit financial' : '' ?>"
                                        name="compoundingPeriods" placeholder="Compounding Periods"
                                        value="<?= old('compoundingPeriods') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.compoundingPeriods') ?></div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputTime">Time (Years)</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.time') ? 'is-invalid errors-edit financial' : '' ?>"
                                        name="time" placeholder="Time in Years" value="<?= old('time') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.time') ?></div>
                                </div>

                                <!-- Fila para Formula + Botón Recalcular -->
                                <div class="form-row">
                                    <!-- Campo Fórmula -->
                                    <div class="form-group col-md-4">
                                        <label for="inputBalance">Fórmula</label>
                                        <input type="text"
                                            class="form-control <?= session('errors-edit.balance') ? 'is-invalid errors-edit' : '' ?>"
                                            name="balance" placeholder="Balance" value="<?= old('balance') ?>" readonly>
                                        <div class="invalid-feedback"><?= session('errors-edit.balance') ?></div>
                                    </div>

                                    <!-- Botón Recalcular perfectamente alineado -->
                                    <div class="form-group col-md-2 d-flex align-items-end">
                                        <button type="button" id="calculateInterestBtn"
                                            class="btn btn-warning">Recalcular</button>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-between mt-3">
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
                                        class="form-control <?= session('errors-edit.status') ? 'is-invalid errors-edit' : '' ?>">
                                        <option value="">Selecciona estado</option>
                                        <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Activo
                                        </option>
                                        <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>
                                            Inactivo</option>
                                    </select>
                                    <div class="invalid-feedback"><?= session('errors-edit.status') ?></div>
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
                                        class="form-control <?= session('errors-edit.agreement') ? 'is-invalid errors-edit' : '' ?>"
                                        name="agreement" placeholder="Agreement" value="<?= old('agreement') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.agreement') ?></div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputNumber">Number</label>
                                    <input type="number"
                                        class="form-control <?= session('errors-edit.number') ? 'is-invalid errors-edit' : '' ?>"
                                        name="number" placeholder="Number" value="<?= old('number') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.number') ?></div>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="inputLetter">Letter</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.letter') ? 'is-invalid errors-edit' : '' ?>"
                                        name="letter" placeholder="Letter" value="<?= old('letter') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.letter') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputPolicy">Policy</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.policy') ? 'is-invalid errors-edit' : '' ?>"
                                        name="policy" placeholder="Policy" value="<?= old('policy') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.policy') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDateFrom">From</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-edit.date_from') ? 'is-invalid errors-edit' : '' ?>"
                                        name="date_from" value="<?= old('date_from') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.date_from') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputDateTo">To</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-edit.date_to') ? 'is-invalid errors-edit' : '' ?>"
                                        name="date_to" value="<?= old('date_to') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.date_to') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApprovedBy">Approved By</label>
                                    <input type="text"
                                        class="form-control <?= session('errors-edit.approved_by') ? 'is-invalid errors-edit' : '' ?>"
                                        name="approved_by" placeholder="Approved By" value="<?= old('approved_by') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.approved_by') ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputApprovedDate">Approved Date</label>
                                    <input type="date"
                                        class="form-control <?= session('errors-edit.approved_date') ? 'is-invalid errors-edit' : '' ?>"
                                        name="approved_date" value="<?= old('approved_date') ?>">
                                    <div class="invalid-feedback"><?= session('errors-edit.approved_date') ?></div>
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


        function fillOutTheForm(id_client) {

            const url = '<?= base_url('admin/clientmanagement/getClient/') ?>' + id_client;
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        console.log('User data:', data);
                        // Populate the form fields with the user data
                        $('#editForm').find('input[name="name"]').val(data.name);
                        $('#editForm').find('input[name="last_name"]').val(data.last_name);
                        $('#editForm').find('input[name="id_role"]').val(data.id_role);
                        $('#editForm').find('input[name="identification"]').val(data.identification);
                        $('#editForm').find('input[name="email"]').val(data.email);
                        $('#editForm').find('input[name="phone"]').val(data.phone);
                        $('#editForm').find('textarea[name="address"]').val(data.address);
                        $('#editForm').find('input[name="trust"]').val(data.trust);
                        $('#editForm').find('input[name="email_del_trust"]').val(data.email_del_trust);
                        $('#editForm').find('input[name="telephone_del_trust"]').val(data.telephone_del_trust);
                        $('#editForm').find('input[name="bank"]').val(data.bank);
                        $('#editForm').find('input[name="swift"]').val(data.swift);
                        $('#editForm').find('input[name="aba"]').val(data.aba);
                        $('#editForm').find('input[name="iban"]').val(data.iban);
                        $('#editForm').find('input[name="account"]').val(data.account);
                        $('#editForm').find('input[name="principal"]').val(data.principal);
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
                        $('#editForm').attr('action', '<?= base_url('admin/clientmanagement/update/') ?>' + data.id_user);
                        // Show the modal
                        $('#editModal').modal('show');
                        // Scroll to the top of the modal
                        $('#editModal').on('shown.bs.modal', function () {
                            $(this).scrollTop(0);
                        });
                    } else {
                        alert('Error loading user data');
                    }
                },
                error: function () {
                    alert('Error connecting to server');
                }
            });

        }
        // Selecciona todos los formularios con la clase 'edit-form'
        let forms = $('.edit-form');

        // Recorre cada formulario para buscar inputs con errores
        forms.each(function () {
            let inputWithError = $(this).find('input.errors-edit, select.errors-edit, textarea.errors-edit');
            let financialError = $(this).find('input.financial');



            if (inputWithError.length > 0) {
                $('#editModalClient').click();
            } else if (financialError.length > 0) {
                $('#editModalClient').click();
                $('#detail-financial').click();
            }
        });
        $('#calculateInterestBtn').on('click', function () {
            // Obtener datos del formulario por name
            const principal = $('#editForm').find('input[name="principal"]').val();
            const rate = $('#editForm').find('input[name="rate"]').val();
            const compoundingPeriods = $('#editForm').find('input[name="compoundingPeriods"]').val();
            const time = $('#editForm').find('input[name="time"]').val();


            // Mostrar los datos antes de enviarlos (solo para depuración)
            const payload = {
                principal: principal,
                rate: rate,
                compoundingPeriods: compoundingPeriods,
                time: time
            };
            console.log('Datos del formulario:', payload);
            // Imprimir JSON en pantalla

            // Enviar datos al servidor
            $.ajax({
                url: '<?= base_url('/admin/clientmanagement/recalculateCompoundInterest') ?>',
                method: 'POST',
                data: payload,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Actualizar el campo "balance" con el resultado
                        $('input[name="balance"]').val(response.finalAmount);
                    } else {
                        alert('Error en el cálculo');
                    }
                },
                error: function () {
                    alert('Error al conectar con el servidor.');
                }
            });
        });



        // Al hacer clic en el botón de editar
        $(document).on('click', '.btn-edit', function (e) {
            e.preventDefault();
            const id_client = $(this).data('id');
            localStorage.setItem(id_client, 'id_client');
            fillOutTheForm(id_client);
        });







        // Al hacer clic en "Next"
        $('.next-tab').on('click', function () {
            let tabPane = $(this).closest('.tab-pane');
            if (tabPane.length === 0) return;

            let nextTabPane = tabPane.nextAll('.tab-pane').first();

            if (nextTabPane.length > 0) {
                let nextTabId = "#" + nextTabPane.attr('id');
                $(`a[href="${nextTabId}"]`).click();
            }
        });

        // Al hacer clic en "Previous"
        $('.prev-tab').on('click', function () {
            let tabPane = $(this).closest('.tab-pane');
            if (tabPane.length === 0) return;

            let prevTabPane = tabPane.prevAll('.tab-pane').first();

            if (prevTabPane.length > 0) {
                let prevTabId = "#" + prevTabPane.attr('id');
                $(`a[href="${prevTabId}"]`).click();
            }
        });

    });



</script>