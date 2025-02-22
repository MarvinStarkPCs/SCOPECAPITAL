<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('img/logo.ico'); ?>" alt="">
        </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Interfaces
    </div>
    <!-- Nav Item - Sistema -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i> <!-- Icono de sistema -->
            <span>System</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">SYSTEM MANAGEMENT</h6>

                <a class="collapse-item" href='pqrs'>
                    <i class="fas fa-fw fa-cog"></i>
                    PQRS Management
                </a>

                <a class="collapse-item" href='transactions'>
                    <i class="fas fa-exchange-alt"></i>
                    Transactions
                </a>
                <!-- 
                    <a class="collapse-item" href='asignar-articulo'>
                        <i class="fas fa-hand-holding"></i> 
                        Asignar Artículos
                    </a>

                   -->

                <a class="collapse-item" href="extrasmanagement">
                    <i class="fas fa-tools"></i>
                    Gestión de Extras
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Historia (nueva sección) -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistory"
            aria-expanded="true" aria-controls="collapseHistory">
            <i class="fas fa-fw fa-history"></i> <!-- Icono de historia -->
            <span>History</span>
        </a>
        <div id="collapseHistory" class="collapse" aria-labelledby="headingHistory" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">HISTORY OF THE SYSTEM:</h6>
                <a class="collapse-item" href="./historytransactions">
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
    <!-- Nav Item - Seguridad -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-shield-alt"></i> <!-- Icono de seguridad -->
            <span>segurity</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">SECURITY SETTINGS:</h6>
                <a class="collapse-item" href="usermanagement">
                    <i class="fas fa-users-cog"></i> <!-- Icono de gestión de usuarios -->
                    User Management </a>
                <a class="collapse-item" href="changepassword">
                    <i class="fas fa-key"></i> <!-- Icono de cambio de contraseña -->
                    Change Password
                </a>

            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>