<!-- Modal de Agregar user actualizado -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="./clientmanagement/add" method="post" id="addUserForm">
        <?= csrf_field() ?>
        <input type="hidden" name="id_role" value="2">
        <div class="modal-body">
          <ul class="nav nav-tabs" id="userTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="client-tab" data-toggle="tab" href="#client" role="tab">Client</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="banking-tab" data-toggle="tab" href="#banking" role="tab">Banking</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="system-tab" data-toggle="tab" href="#system" role="tab">System</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="financial-tab" data-toggle="tab" href="#financial" role="tab">Financial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="agreement-tab" data-toggle="tab" href="#agreement" role="tab">Agreement</a>
            </li>
          </ul>

          <div class="tab-content pt-3">
            <!-- CLIENT TAB -->
            <div class="tab-pane fade show active" id="client" role="tabpanel">
              <h5 class="text-primary">Client Information</h5>
              <div class="row">
                 <div class="form-group col-md-4">
                  <label for="inputLastname">Name</label>
                  <input type="text"
                    class="form-control <?= session('errors-insert.name') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputname" name="name" placeholder="Name" value="<?= old('name') ?>">
                  <?php if (session('errors-insert.name')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.name') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputLastname">Last Name</label>
                  <input type="text"
                    class="form-control <?= session('errors-insert.last_name') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputLastname" name="last_name" placeholder="Last Name" value="<?= old('last_name') ?>">
                  <?php if (session('errors-insert.last_name')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.last_name') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputIdentity">Identification</label>
                  <input type="number"
                    class="form-control <?= session('errors-insert.identification') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputIdentity" name="identification" placeholder="ID" value="<?= old('identification') ?>">
                  <?php if (session('errors-insert.identification')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.identification') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputEmail">Email</label>
                  <input type="email"
                    class="form-control <?= session('errors-insert.email') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputEmail" name="email" placeholder="Email" value="<?= old('email') ?>">
                  <?php if (session('errors-insert.email')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.email') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputPhone">Phone</label>
                  <input type="text"
                    class="form-control <?= session('errors-insert.phone') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputPhone" name="phone" placeholder="Phone" value="<?= old('phone') ?>">
                  <?php if (session('errors-insert.phone')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.phone') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputAddress">Address</label>
                  <input type="text"
                    class="form-control <?= session('errors-insert.address') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputAddress" name="address" placeholder="Address" value="<?= old('address') ?>">
                  <?php if (session('errors-insert.address')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.address') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputTrust">Trust</label>
                  <input type="text"
                    class="form-control <?= session('errors-insert.trust') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputTrust" name="trust" placeholder="Trust" value="<?= old('trust') ?>">
                  <?php if (session('errors-insert.trust')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.trust') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputTrustEmail">Trust Email</label>
                  <input type="email"
                    class="form-control <?= session('errors-insert-edit.email_del_trust') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputTrustEmail" name="email_del_trust" placeholder="Trust Email"
                    value="<?= old('email_del_trust') ?>">
                  <?php if (session('errors-insert.email_del_trust')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.email_del_trust') ?></div>
                  <?php endif; ?>
                </div>

                <div class="form-group col-md-4">
                  <label for="inputTrustPhone">Trust Phone</label>
                  <input type="text"
                    class="form-control <?= session('errors-insert.telephone_del_trust') ? 'is-invalid errors-insert-insert' : '' ?>"
                    id="inputTrustPhone" name="telephone_del_trust" placeholder="Trust Phone"
                    value="<?= old('telephone_del_trust') ?>">
                  <?php if (session('errors-insert.telephone_del_trust')): ?>
                    <div class="invalid-feedback"><?= session('errors-insert.telephone_del_trust') ?></div>
                  <?php endif; ?>
                </div>

              </div>
              <div class="text-right">
                <button type="button" class="btn btn-primary next-tab">Next</button>
              </div>
            </div>

            <!-- BANKING TAB -->
            <div class="tab-pane fade" id="banking" role="tabpanel">
              <h5 class="text-primary">Banking Information</h5>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="inputBank">Bank</label>
                  <input type="text" class="form-control" id="inputBank" name="bank" placeholder="Bank"
                    value="<?= old('bank') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputSwift">SWIFT</label>
                  <input type="text" class="form-control" id="inputSwift" name="swift" placeholder="SWIFT"
                    value="<?= old('swift') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputAba">ABA</label>
                  <input type="text" class="form-control" id="inputAba" name="aba" placeholder="ABA"
                    value="<?= old('aba') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputIban">IBAN</label>
                  <input type="text" class="form-control" id="inputIban" name="iban" placeholder="IBAN"
                    value="<?= old('iban') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputAccount">Account</label>
                  <input type="text" class="form-control" id="inputAccount" name="account" placeholder="Account"
                    value="<?= old('account') ?>">
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                <button type="button" class="btn btn-primary next-tab">Next</button>
              </div>
            </div>

            <!-- SYSTEM TAB -->
            <div class="tab-pane fade" id="system" role="tabpanel">
              <h5 class="text-primary">System Access</h5>
              <div class="row">
                
                <div class="form-group col-md-4">
                  <label for="selectStatus">Status</label>
                  <select class="form-control" id="selectStatus" name="status">
                    <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                <button type="button" class="btn btn-primary next-tab">Next</button>
              </div>
            </div>

            <!-- FINANCIAL TAB -->
           <div class="tab-pane fade" id="financial" role="tabpanel">
  <h5 class="text-warning">Financial Information</h5>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputPrincipal">Principal</label>
      <input type="text" class="form-control <?= session('errors-insert.principal') ? 'is-invalid  financial' : '' ?>" id="inputPrincipal" name="principal" placeholder="E.g. 5,000,000.00" value="<?= old('principal') ?>">
      <?php if(session('errors-insert.principal')): ?>
        <div class="invalid-feedback"><?= esc(session('errors-insert.principal')) ?></div>
      <?php endif; ?>
    </div>
    <div class="form-group col-md-3">
      <label for="inputRate">Interest Rate</label>
      <input type="text" class="form-control <?= session('errors-insert.rate') ? 'is-invalid  financial' : '' ?>" id="inputRate" name="rate" placeholder="E.g. 12.50" value="<?= old('rate') ?>">
      <?php if(session('errors-insert.rate')): ?>
        <div class="invalid-feedback"><?= esc(session('errors-insert.rate')) ?></div>
      <?php endif; ?>
    </div>
    <div class="form-group col-md-3">
      <label for="inputCompounding">Periods</label>
      <input type="number" class="form-control <?= session('errors-insert.compoundingPeriods') ? 'is-invalid  financial' : '' ?>" id="inputCompounding" name="compoundingPeriods" placeholder="E.g. 12" value="<?= old('compoundingPeriods') ?>">
      <?php if(session('errors-insert.compoundingPeriods')): ?>
        <div class="invalid-feedback"><?= esc(session('errors-insert.compoundingPeriods')) ?></div>
      <?php endif; ?>
    </div>
    <div class="form-group col-md-3">
      <label for="inputTime">Time (years)</label>
      <input type="number" class="form-control <?= session('errors-insert.time') ? 'is-invalid  financial' : '' ?>" id="inputTime" name="time" placeholder="E.g. 5" value="<?= old('time') ?>">
      <?php if(session('errors-insert.time')): ?>
        <div class="invalid-feedback"><?= esc(session('errors-insert.time')) ?></div>
      <?php endif; ?>
    </div>
  </div>
    <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                <button type="button" class="btn btn-primary next-tab">Next</button>
              </div>
</div>


            <!-- AGREEMENT TAB -->
            <div class="tab-pane fade" id="agreement" role="tabpanel">
              <h5 class="text-info">Agreement Information</h5>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputAgreement">Agreement</label>
                  <input type="text" class="form-control" id="inputAgreement" name="agreement" placeholder="Agreement"
                    value="<?= old('agreement') ?>">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputNumber">Number</label>
                  <input type="number" class="form-control" id="inputNumber" name="number" placeholder="Number"
                    value="<?= old('number') ?>">
                </div>
                <div class="form-group col-md-2">
                  <label for="inputLetter">Letter</label>
                  <input type="text" class="form-control" id="inputLetter" name="letter" placeholder="Letter"
                    value="<?= old('letter') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputPolicy">Policy</label>
                  <input type="text" class="form-control" id="inputPolicy" name="policy" placeholder="Policy"
                    value="<?= old('policy') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputDateFrom">From</label>
                  <input type="date" class="form-control" id="inputDateFrom" name="date_from"
                    value="<?= old('date_from') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputDateTo">To</label>
                  <input type="date" class="form-control" id="inputDateTo" name="date_to" value="<?= old('date_to') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputApprovedBy">Approved By</label>
                  <input type="text" class="form-control" id="inputApprovedBy" name="approved_by"
                    placeholder="Approved By" value="<?= old('approved_by') ?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputApprovedDate">Approved Date</label>
                  <input type="date" class="form-control" id="inputApprovedDate" name="approved_date"
                    value="<?= old('approved_date') ?>">
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
                <div>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save User</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Botón oculto para abrir el modal si hay errores -->
<button id="openModalButtonUser" type="button" class="d-none" data-toggle="modal" data-target="#addUserModal"></button>



<!-- JS para cambiar pestañas -->
<script>


  document.addEventListener('DOMContentLoaded', function () {
    const nextButtons = document.querySelectorAll('.next-tab');
    const prevButtons = document.querySelectorAll('.prev-tab');

    nextButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        const activeTab = document.querySelector('.nav-tabs .nav-link.active');
        const nextTab = activeTab.parentElement.nextElementSibling;
        if (nextTab) {
          nextTab.querySelector('.nav-link').click();
        }
      });
    });

    prevButtons.forEach(btn => {
      btn.addEventListener('click', function () {
        const activeTab = document.querySelector('.nav-tabs .nav-link.active');
        const prevTab = activeTab.parentElement.previousElementSibling;
        if (prevTab) {
          prevTab.querySelector('.nav-link').click();
        }
      });
    });

    // Abrir automáticamente el modal si hay errores
    let input = document.querySelector('input.errors-insert-insert, select.errors-insert-insert, textarea.errors-insert-insert');
        let inputFinancial = document.querySelector('input.financial');

    if (input) {

      document.getElementById('openModalButtonUser').click();
    }else if (inputFinancial) {
      // Si hay errores en el tab financiero, abrir el modal
      document.getElementById('openModalButtonUser').click();
      // Cambiar a la pestaña financiera
      const financialTab = document.querySelector('#financial-tab');
      if (financialTab) {
        financialTab.click();
      }
    }

    // Funciones para formatear moneda en estilo dólar estadounidense
    const formatCurrency = (number) => {
      return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      }).format(number);
    };

    const parseCurrency = (value) => {
      // Limpiamos el formato dólar para poder convertir a número
      // Ejemplo: "$1,234.56" -> "1234.56"
      const cleaned = value.replace(/[^0-9.-]+/g, '');
      return parseFloat(cleaned);
    };

    function applyMoneyFormat(input) {
      input.addEventListener("blur", function () {
        const value = parseCurrency(this.value);
        if (!isNaN(value)) this.value = formatCurrency(value);
      });

      input.addEventListener("focus", function () {
        const value = parseCurrency(this.value);
        if (!isNaN(value)) this.value = value.toString();
      });
    }

    const inputPrincipal = document.getElementById("inputPrincipal");
    if (inputPrincipal) applyMoneyFormat(inputPrincipal);


  });
</script>