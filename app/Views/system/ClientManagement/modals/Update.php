<?php 
foreach ($users as $user): ?>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editModal-<?= $user['id_user'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel-<?= $user['id_user'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-<?= $user['id_user'] ?>">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="location.reload();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('./admin/clientmanagement/update/' . $user['id_user']) ?>"
                        id="editForm-<?= $user['id_user'] ?>" method="post" class="edit-form">
                        <?= csrf_field() ?>

                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs" id="editTab-<?= $user['id_user'] ?>" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-client-<?= $user['id_user'] ?>" data-toggle="tab"
                                    href="#edit-client-<?= $user['id_user'] ?>" role="tab">Client</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-banking-<?= $user['id_user'] ?>" data-toggle="tab"
                                    href="#edit-banking-<?= $user['id_user'] ?>" role="tab">Banking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-system-<?= $user['id_user'] ?>" data-toggle="tab"
                                    href="#edit-system-<?= $user['id_user'] ?>" role="tab">System</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-agreement-<?= $user['id_user'] ?>" data-toggle="tab"
                                    href="#edit-agreement-<?= $user['id_user'] ?>" role="tab">Agreement</a>
                            </li>
                        </ul>

                        <!-- Tabs Content -->
                        <div class="tab-content pt-3" id="editTabContent-<?= $user['id_user'] ?>">
                            <!-- Tab 1: client -->
                            <div class="tab-pane fade show active" id="edit-client-<?= $user['id_user'] ?>" role="tabpanel">
                                                        <h5 class="text-primary">Client Information</h5>    
                            <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Name</label>
                                        <input type="text" name="name"
                                            class="form-control <?= session('errors-edit.name') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('name', esc($user['name'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.name') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name"
                                            class="form-control <?= session('errors-edit.last_name') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('last_name', esc($user['last_name'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.last_name') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>identification</label>
                                        <input type="text" name="identification"
                                            class="form-control <?= session('errors-edit.identification') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('identification', esc($user['identification'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.identification') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-control <?= session('errors-edit.email') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('email', esc($user['email'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.email') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Phone</label>
                                        <input type="tel" name="phone"
                                            class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('phone', esc($user['phone'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.phone') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Address</label>
                                        <textarea name="address"
                                            class="form-control <?= session('errors-edit.address') ? 'is-invalid errors-edit' : '' ?>"><?= old('address', esc($user['address'])) ?></textarea>
                                        <div class="invalid-feedback"><?= session('errors-edit.address') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Trust</label>
                                        <input type="text" name="trust"
                                            class="form-control <?= session('errors-edit.phone') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('trust', esc($user['trust'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.trust') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Email Trust</label>
                                        <input type="email_del_trust" name="email_del_trust"
                                            class="form-control <?= session('errors-edit.email_del_trust') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('email_del_trust', esc($user['email_del_trust'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.email_del_trust') ?></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                    <button type="button" class="btn btn-primary next-tab">Next</button>
                                </div>
                            </div>
                            <!-- Tab 2: banking -->
                            <div class="tab-pane fade" id="edit-banking-<?= $user['id_user'] ?>" role="tabpanel">
                                <h5 class="text-primary">Banking Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Bank</label>
                                        <input type="text" name="bank"
                                            class="form-control <?= session('errors-edit.bank') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('bank', esc($user['bank'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.bank') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>SWIFT</label>
                                        <input type="text" name="swift"
                                            class="form-control <?= session('errors-edit.swift') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('swift', esc($user['swift'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.swift') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>ABA</label>
                                        <input type="text" name="aba"
                                            class="form-control <?= session('errors-edit.aba') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('aba', esc($user['aba'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.aba') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>IBAN</label>
                                        <input type="text" name="iban"
                                            class="form-control <?= session('errors-edit.iban') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('iban', esc($user['iban'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.iban') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Account</label>
                                        <input type="text" name="account"
                                            class="form-control <?= session('errors-edit.account') ? 'is-invalid errors-edit' : '' ?>"
                                            value="<?= old('account', esc($user['account'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.account') ?></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                    <button type="button" class="btn btn-primary next-tab">Next</button>
                                </div>
                            </div>
                            <!-- Tab 3: System-->
                            <div class="tab-pane fade" id="edit-system-<?= $user['id_user'] ?>" role="tabpanel">
                                <h5 class="text-primary">System Access</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputPassword">Password</label>
                                        <input type="password" class="form-control" id="inputPassword" name="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Estado</label>
                                        <select name="status"
                                            class="form-control <?= session('errors-edit.status') ? 'is-invalid errors-edit' : '' ?>">
                                            <option value="">Selecciona estado</option>
                                            <option value="active" <?= old('status', $user['status']) == 'active' ? 'selected' : '' ?>>Activo</option>
                                            <option value="inactive" <?= old('status', $user['status']) == 'inactive' ? 'selected' : '' ?>>Inactivo</option>
                                        </select>
                                        <div class="invalid-feedback"><?= session('errors-edit.status') ?></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                                    <button type="button" class="btn btn-primary next-tab">Next</button>
                                </div>
                            </div>
                            <!-- Tab 4: Agreement-->
                            <div class="tab-pane fade" id="edit-agreement-<?= $user['id_user'] ?>" role="tabpanel">
                                <h5 class="text-info">Agreement Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputAgreement">Agreement</label>
                                        <input type="text"
                                            class="form-control <?= session('errors-edit.agreement') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputAgreement" name="agreement" placeholder="Agreement"
                                            value="<?= old('agreement', esc($user['agreement'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.agreement') ?></div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="inputNumber">Number</label>
                                        <input type="number"
                                            class="form-control <?= session('errors-edit.number') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputNumber" name="number" placeholder="Number"
                                            value="<?= old('number', esc($user['number'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.number') ?></div>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputLetter">Letter</label>
                                        <input type="text"
                                            class="form-control <?= session('errors-edit.letter') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputLetter" name="letter" placeholder="Letter"
                                            value="<?= old('letter', esc($user['letter'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.letter') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputPolicy">Policy</label>
                                        <input type="text"
                                            class="form-control <?= session('errors-edit.policy') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputPolicy" name="policy" placeholder="Policy"
                                            value="<?= old('policy', esc($user['policy'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.policy') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputDateFrom">From</label>
                                        <input type="date"
                                            class="form-control <?= session('errors-edit.date_from') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputDateFrom" name="date_from"
                                            value="<?= old('date_from', esc($user['date_from'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.date_from') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputDateTo">To</label>
                                        <input type="date"
                                            class="form-control <?= session('errors-edit.date_to') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputDateTo" name="date_to"
                                            value="<?= old('date_to', esc($user['date_to'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.date_to') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputApprovedBy">Approved By</label>
                                        <input type="text"
                                            class="form-control <?= session('errors-edit.approved_by') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputApprovedBy" name="approved_by" placeholder="Approved By"
                                            value="<?= old('approved_by', esc($user['approved_by'])) ?>">
                                        <div class="invalid-feedback"><?= session('errors-edit.approved_by') ?></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputApprovedDate">Approved Date</label>
                                        <input type="date"
                                            class="form-control <?= session('errors-edit.approved_date') ? 'is-invalid errors-edit' : '' ?>"
                                            id="inputApprovedDate" name="approved_date"
                                            value="<?= old('approved_date', esc($user['approved_date'])) ?>">
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
        document.addEventListener('DOMContentLoaded', function () {

              // Al hacer clic en "Next"
        document.querySelectorAll(".next-tab").forEach(button => {
            button.addEventListener("click", function () {
                let tabPane = this.closest(".tab-pane");
                if (!tabPane) return;

                let nextTabPane = tabPane.nextElementSibling;
                while (nextTabPane && !nextTabPane.classList.contains("tab-pane")) {
                    nextTabPane = nextTabPane.nextElementSibling;
                }

                if (nextTabPane) {
                    let nextTabId = "#" + nextTabPane.id;
                    document.querySelector(`a[href="${nextTabId}"]`).click();
                }
            });
        });

        // Al hacer clic en "Previous"
        document.querySelectorAll(".prev-tab").forEach(button => {
            button.addEventListener("click", function () {
                let tabPane = this.closest(".tab-pane");
                if (!tabPane) return;

                let prevTabPane = tabPane.previousElementSibling;
                while (prevTabPane && !prevTabPane.classList.contains("tab-pane")) {
                    prevTabPane = prevTabPane.previousElementSibling;
                }

                if (prevTabPane) {
                    let prevTabId = "#" + prevTabPane.id;
                    document.querySelector(`a[href="${prevTabId}"]`).click();
                }
            });
        });

        // Selecciona todos los formularios con la clase 'edit-form'
        let forms = document.getElementsByClassName('edit-form');
console.log(forms);
        // Recorre cada formulario para buscar inputs con errores
        Array.from(forms).forEach(form => {
            let inputWithError = form.querySelector('input.errors-edit, select.errors-edit, textarea.errors-edit');

            if (inputWithError) {
                let target = localStorage.getItem("data_target");
                if (target) {
                    const tabButton = document.querySelector(`[data-target="${target}"]`);
                    if (tabButton) tabButton.click();
                }
            }
        });

        // Al hacer clic en un botón de edición, guarda el data-target
        document.querySelectorAll('#editButton').forEach(button => {
            button.addEventListener('click', function () {
                const dataTargetValue = this.getAttribute('data-target');
                localStorage.setItem("data_target", dataTargetValue);
            });
        });
    });   
         
       


    </script>
<?php endforeach; ?>