<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SCOOPECAPITAL - Dashboard</title>

    <!-- Custom fonts for this template -->
    <link href="./assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet"> -->

    <!-- CSS de Select2 (si lo usas) -->
    <link href="./assets/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./css/loader.css" rel="stylesheet">


    <style>
         .table thead th {
            background-color: #f1c40f; /* Color de fondo para las celdas del encabezado */
            color:#192229; /* Color del texto para contraste */
        }
        /* Style for the scrollbar track */
        ::-webkit-scrollbar {
            width: 12px;              /* Set width for vertical scrollbar */
            height: 12px;             /* Set height for horizontal scrollbar */
        }

        /* Style for the scrollbar thumb */
        ::-webkit-scrollbar-thumb {
            background-color: #888;    /* Color of the scrollbar thumb */
            border-radius: 6px;        /* Roundness of the scrollbar thumb */
            border: 3px solid transparent; /* Add padding around thumb for spacing */
        }

        /* Hover effect for the scrollbar thumb */
        ::-webkit-scrollbar-thumb:hover {
            background-color: #555;    /* Darken color when hovering */
        }

        /* Optional: Style for the scrollbar track (background) */
        ::-webkit-scrollbar-track {
            background-color: #f1f1f1; /* Color of the scrollbar track */
            border-radius: 6px;        /* Roundness of the scrollbar track */
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .sidebar-brand-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color:#FEC659;
            width: 60px;
            height: 60px;
            margin-right: 0.5rem;
            overflow: hidden;
        }

        .sidebar-brand-icon img {
            width: 84%;
            height: 84%;
            object-fit: cover;
        }

        /* Estilo para el mensaje de alerta */
        .alert {
            position: fixed;
            top: -100px; /* Posición inicial fuera de la pantalla */
            right: 20px; /* A la derecha de la pantalla */
            width: 50%; /* Ancho del mensaje */
            max-width: 300px; /* Tamaño máximo del mensaje */
            z-index: 9999;
            transition: top 0.5s ease-in-out, opacity 0.5s ease-in-out;
        }

        .alert.show {
            top: 95px; /* Ajusta este valor para moverlo más abajo */
        }

        .alert.hide {
            top: -100px; /* Desaparece fuera de la pantalla hacia arriba */
            opacity: 0;
        }

        /* Estilo para la barra de progreso */
        .progress {
            height: 5px;
            background-color: #f1f1f1;
            margin-top: 10px;
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            transition: width 5s linear;
        }

        /* Diferentes colores para la barra según el tipo de mensaje */
        .alert-success .progress-bar {
            background-color: #28a745; /* Verde para éxito */
        }

        .alert-danger .progress-bar {
            background-color: #dc3545; /* Rojo para error */
        }
      
    </style>
</head>

<body id="page-top" class="sidebar-toggled">



<div class="sidebar-toggled" id="wrapper">
<div id="loader-overlay">
    <div class="loader">
      <div class="reflection"></div>
      <div class="logo"></div>
    </div>
  </div>
    <!-- Sidebar -->
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
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
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

                   <a class="collapse-item" href="gestion-extras">
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
                    <!-- <a class="collapse-item" href="< ?= base_url('inventarios-anteriores'); ?>">
                        <i class="fas fa-tasks"></i> Historial de Inventario
                    </a>
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
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">SECURITY SETTINGS:</h6>
                    <a class="collapse-item" href="<?= base_url('gestion-usuarios'); ?>">
                        <i class="fas fa-users-cog"></i> <!-- Icono de gestión de usuarios -->
                        User Management                    </a>

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
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->

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
                            $nombreUsuario = $session->get('name').' '.$session->get('last_name') ?? 'Invitado';
                            ?>
                            <span class="text-black mr-2 d-none d-lg-inline  small">
    <?= esc($nombreUsuario); ?>
</span>                            <img class="img-profile rounded-circle" src="<?= base_url('img/undraw_profile.svg'); ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="<?= base_url('clogin/logout'); ?>" data-toggle="modal"
                               data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Mostrar mensajes de exito -->
                <?php if (session()->get('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->get('success') ?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Mostrar mensajes de error -->
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->get('error') ?>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Mostrar mensajes largos -->
                <?php if (session()->get('mensaje')): ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Atención!</strong> <?= session()->get('mensaje') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Page content here -->
                <?= $this->renderSection('content') ?>
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-dark-blue">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- Loader superpuesto -->


<script>
    function toggleLoader(show) {
        const loaderOverlay = document.getElementById('loader-overlay');

        if (show) {
            loaderOverlay.style.display = 'flex'; // Mostrar el loader
        } else {
            loaderOverlay.style.display = 'none'; // Ocultar el loader
        }
    }

    // Ejemplo de uso:
    // // Mostrar el loader
    // setTimeout(() => toggleLoader(true), 1000); // Mostrar el loader después de 1 segundo
    //
    // // Ocultar el loader
    // setTimeout(() => toggleLoader(false), 5000); // Ocultar el loader después de 5 segundos
</script><!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('clogin/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="./js/toggleloader.js"></script>


<!-- jQuery -->
<script src="./assets/jquery/jquery.min.js"></script>

<script src="./assets/sweetalert2/dist/sweetalert2.all.min.js" ></script>

<script src="./assets/select2/dist/js/select2.min.js" ></script>

<!-- Select2 JavaScript (si lo usas) -->


<!-- Bootstrap core JavaScript -->
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript -->
<script src="./assets/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages -->
<script src="./js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="./assets/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="./js/demo/chart-area-demo.js"></script>
<script src="./js/demo/chart-pie-demo.js"></script>

<!-- DataTables -->
<script src="./assets/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/datatables/dataTables.bootstrap4.min.js"></script>
<script src="./js/demo/datatables-demo.js"></script>

<script src="./js/selectInventario.js"></script>
<script src="./js/AsignarArticulo.js"></script>

<script src="./js/AsignarxSerial.js"></script>



<!-- Custom alerts -->
<script src="./js/demo/alert_custom.js"></script>

</body>

</html>
