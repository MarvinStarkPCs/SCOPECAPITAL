<nav class="navbar navbar-expand navbar-light bg-dark-blue topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                $session = session();
                $nombreUsuario = $session->get('name') . ' ' . $session->get('last_name') ?? 'Invitado';
                $role_id = $session->get('role_id');
                ?>
                <span class="text-black mr-2 d-none d-lg-inline small">
                    <?= esc($nombreUsuario); ?>
                </span> 
                <img class="img-profile rounded-circle" src="<?= base_url('img/undraw_profile.svg'); ?>">
            </a>
           

                <?php if ($role_id == 1): // Si es administrador ?>
                     <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('admin/profile'); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                    <a class="dropdown-item" href="<?= base_url('admin/setting'); ?>">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                <?php endif; ?>


                <?php if ($role_id == 2): // Si es administrador ?>
                     <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?= base_url('client/profile'); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
    
                <?php endif; ?>

                <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
