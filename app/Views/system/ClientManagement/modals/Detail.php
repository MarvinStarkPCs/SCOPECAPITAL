<!-- User Details Modal with Tabs -->
<?php foreach ($users as $user): ?>
  <div class="modal fade" id="detailsModal-<?= $user['id_user'] ?>" tabindex="-1" role="dialog"
       aria-labelledby="detailsModalLabel-<?= $user['id_user'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel-<?= $user['id_user'] ?>">User Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!-- Tabs -->
          <ul class="nav nav-tabs" id="detailsTabs-<?= $user['id_user'] ?>" role="tablist">
            <li class="nav-item"><a class="nav-link active" id="client-tab-<?= $user['id_user'] ?>" data-toggle="tab" href="#client-<?= $user['id_user'] ?>" role="tab">Client</a></li>
            <li class="nav-item"><a class="nav-link" id="bank-tab-<?= $user['id_user'] ?>" data-toggle="tab" href="#bank-<?= $user['id_user'] ?>" role="tab">Banking</a></li>
            <li class="nav-item"><a class="nav-link" id="security-tab-<?= $user['id_user'] ?>" data-toggle="tab" href="#security-<?= $user['id_user'] ?>" role="tab">System</a></li>
            <li class="nav-item"><a class="nav-link" id="finance-tab-<?= $user['id_user'] ?>" data-toggle="tab" href="#finance-<?= $user['id_user'] ?>" role="tab">Financial</a></li>
            <li class="nav-item"><a class="nav-link" id="agreement-tab-<?= $user['id_user'] ?>" data-toggle="tab" href="#agreement-<?= $user['id_user'] ?>" role="tab">Agreement</a></li>
          </ul>

          <!-- Tab Content -->
          <div class="tab-content pt-3">

            <!-- CLIENT -->
            <div class="tab-pane fade show active" id="client-<?= $user['id_user'] ?>" role="tabpanel">
                                 <h5 class="text-primary">Client Information</h5>

              <div class="row">
                <?php
                  $client_fields = [
                    'First Name' => 'name', 'Last Name' => 'last_name', 'Identification' => 'identification',
                    'Email' => 'email', 'Phone' => 'phone', 'Address' => 'address',
                    'Trust' => 'trust', 'Trust Email' => 'email_del_trust', 'Trust Phone' => 'telephone_del_trust'
                  ];
                  foreach ($client_fields as $label => $key):
                ?>
                  <div class="form-group col-md-4">
                    <label><?= $label ?></label>
                    <input type="text" class="form-control" value="<?= esc($user[$key]) ?>" readonly>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- BANKING -->
            <div class="tab-pane fade" id="bank-<?= $user['id_user'] ?>" role="tabpanel">
                                 <h5 class="text-primary">Banking Information</h5>

              <div class="row">
                <?php
                  $bank_fields = ['Bank' => 'bank', 'SWIFT' => 'swift', 'ABA' => 'aba', 'IBAN' => 'iban', 'Account' => 'account'];
                  foreach ($bank_fields as $label => $key):
                ?>
                  <div class="form-group col-md-4">
                    <label><?= $label ?></label>
                    <input type="text" class="form-control" value="<?= esc($user[$key]) ?>" readonly>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- SYSTEM -->
            <div class="tab-pane fade" id="security-<?= $user['id_user'] ?>" role="tabpanel">
                                 <h5 class="text-primary">System Access</h5>

              <div class="row">
                <?php
                  $system_fields = [
                    'Status' => 'status', 'Login Attempts' => 'login_attempts',
                    'Last Attempt' => 'last_login_attempt', 'Registration Date' => 'date_registration', 'Role' => 'role_name'
                  ];
                  foreach ($system_fields as $label => $key):
                ?>
                  <div class="form-group col-md-3">
                    <label><?= $label ?></label>
                    <input type="text" class="form-control" value="<?= esc($user[$key]) ?>" readonly>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- FINANCIAL -->
            <div class="tab-pane fade" id="finance-<?= $user['id_user'] ?>" role="tabpanel">
                 <h5 class="text-primary">Financial Information</h5>
              <div class="row">
                <?php
                  $finance_fields = [
                    'Balance' => 'balance', 'Principal' => 'principal',
                    'Interest Rate' => 'rate', 'Periods' => 'compoundingPeriods', 'Term (years)' => 'time'
                  ];
                  foreach ($finance_fields as $label => $key):
                ?>
                  <div class="form-group col-md-3">
                    <label><?= $label ?></label>
                    <input type="text" class="form-control" value="<?= esc($user[$key]) ?>" readonly>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- AGREEMENT -->
            <div class="tab-pane fade" id="agreement-<?= $user['id_user'] ?>" role="tabpanel">
              <h5 class="text-primary">Agreement Information</h5>
              <div class="row">
                <?php
                  $agreement_fields = [
                    'Agreement' => 'agreement', 'Number' => 'number', 'Letter' => 'letter', 'Policy' => 'policy',
                    'From' => 'date_from', 'To' => 'date_to',
                    'Approved By' => 'approved_by', 'Approved Date' => 'approved_date'
                  ];
                  foreach ($agreement_fields as $label => $key):
                ?>
                  <div class="form-group col-md-3">
                    <label><?= $label ?></label>
                    <input type="text" class="form-control" value="<?= esc($user[$key]) ?>" readonly>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

          </div> <!-- end tab-content -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
