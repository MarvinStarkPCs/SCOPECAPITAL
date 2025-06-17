<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('img/logo.ico'); ?>" alt="">
        </div>
    </a>

  

    <!-- Verificamos el role_id -->
    <?php if (session()->get('role_id') == 1): ?>
          <!-- Divider -->
    <hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?= base_url('admin/dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
        <!-- Items para Administrador -->
        <div class="sidebar-heading">Interfaces</div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true"
                aria-controls="collapseSystem">
                <i class="fas fa-fw fa-cog"></i>
                <span>System</span>
            </a>
            <div id="collapseSystem" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SYSTEM MANAGEMENT</h6>
                    <a class="collapse-item" href="<?= base_url('admin/pqrsmanagement'); ?>">
                        <i class="fas fa-fw fa-cog"></i> PQRS Management
                    </a>
                    <a class="collapse-item" href="<?= base_url('admin/transactions'); ?>">
                        
                        <i class="fas fa-university"></i> Pay
                    </a>
                    <a class="collapse-item" href="<?= base_url('admin/clientmanagement'); ?>">
                        <i class="fas fa-users"></i> clients
                    </a>
                    <!-- <a class="collapse-item" href="<?= base_url('admin/extrasmanagement'); ?>">
                        <i class="fas fa-tools"></i> Gestión de Extras
                    </a> -->
                </div>
            </div>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory"
            aria-expanded="true" aria-controls="collapseHistory">
            <i class="fas fa-fw fa-history"></i> <!-- Icono de historia -->
            <span>History</span>
        </a>
        <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">HISTORY OF THE SYSTEM:</h6>
                <a class="collapse-item" href="<?= base_url('admin/historytransactions'); ?>" >
                        <i class="fas fa-tasks"></i> History de transactions
                    </a>
                <!--
                    <a class="collapse-item" href="< ?= base_url('asignaciones'); ?>">
                        <i class="fas fa-calendar-alt"></i> Historial de asignaciones
                    </a>

                    <a class="collapse-item" href="< ?= base_url('dados-de-baja'); ?>">
                        <i class="fas fa-trash-alt"></i> Historial Dados de Baja
                    </a> -->
            </div>

        </div>
    </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSecurity"
                aria-expanded="true" aria-controls="collapseSecurity">
                <i class="fas fa-fw fa-shield-alt"></i>
                <span>Security</span>
            </a>
            <div id="collapseSecurity" class="collapse" aria-labelledby="headingSecurity" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SECURITY SETTINGS:</h6>
                    <a class="collapse-item" href="<?= base_url('admin/usermanagement'); ?>">
                        <i class="fas fa-users-cog"></i> User Management
                    </a>
                    <a class="collapse-item" href="<?= base_url('admin/changepassword'); ?>">
                        <i class="fas fa-key"></i> Change Password
                    </a>
                </div>
            </div>
        </li>

    <?php elseif (session()->get('role_id') == 2): ?>
        <hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?= base_url('client/dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">
         <!-- Items para Administrador -->
         <div class="sidebar-heading">Interfaces</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true"
        aria-controls="collapseSystem">
        <i class="fas fa-fw fa-cog"></i>
        <span>System</span>
    </a>
    <div id="collapseSystem" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">SYSTEM MANAGEMENT</h6>
            <a class="collapse-item" href="<?= base_url('client/pqrs-sent/view'); ?>">
                <i class="fas fa-fw fa-cog"></i> PQRS
            </a>
            <a class="collapse-item" href="<?= base_url('client/historytransactions/detail/' . session('id_user')); ?>">
    <i class="fas fa-exchange-alt"></i> Transactions
</a>

        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSecurity"
        aria-expanded="true" aria-controls="collapseSecurity">
        <i class="fas fa-fw fa-shield-alt"></i>
        <span>Security</span>
    </a>
    <div id="collapseSecurity" class="collapse" aria-labelledby="headingSecurity" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">SECURITY SETTINGS:</h6>
           
            <a class="collapse-item" href="<?= base_url('client/changepassword'); ?>">
                <i class="fas fa-key"></i> Change Password
            </a>
        </div>
    </div>
</li>

    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
