<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">


    <title>SCOOPECAPITAL - Dashboard</title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"> -->

    <!-- CSS de Select2 (si lo usas) -->
    <link href="<?= base_url('assets/select2/dist/css/select2.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url(relativePath: 'css/partials/loader.css') ?>" rel="stylesheet">
    <link href="<?= base_url(relativePath: 'css/partials/alert.css') ?>" rel="stylesheet">


<!-- jQuery -->
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>

    <style>
        .table thead th {
            background-color: #f1c40f;
            /* Color de fondo para las celdas del encabezado */
            color: #192229;
            /* Color del texto para contraste */
        }

        /* Style for the scrollbar track */
        ::-webkit-scrollbar {
            width: 12px;
            /* Set width for vertical scrollbar */
            height: 12px;
            /* Set height for horizontal scrollbar */
        }

        /* Style for the scrollbar thumb */
        ::-webkit-scrollbar-thumb {
            background-color: #888;
            /* Color of the scrollbar thumb */
            border-radius: 6px;
            /* Roundness of the scrollbar thumb */
            border: 3px solid transparent;
            /* Add padding around thumb for spacing */
        }

        /* Hover effect for the scrollbar thumb */
        ::-webkit-scrollbar-thumb:hover {
            background-color: #555;
            /* Darken color when hovering */
        }

        /* Optional: Style for the scrollbar track (background) */
        ::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            /* Color of the scrollbar track */
            border-radius: 6px;
            /* Roundness of the scrollbar track */
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
            background-color: #FEC659;
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

       
    </style>
</head>
<body id="page-top" class="sidebar-toggled">
    <div class="sidebar-toggled" id="wrapper">
    <?= view('partials/loader') ?>

        <!-- Sidebar -->
        <?= view(name: 'layouts/aside') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= view('layouts/header') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- alertas -->
                    <?= view('partials/alert') ?>
                    <!-- End of alertas -->

                    <!-- logoutmodal -->
                    <?= view('partials/logoutmodal') ?>
                    <!-- End of logoutmodal -->


                    <!-- Page content here -->
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= view(name: 'layouts/footer') ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Scripts -->
    <script src="<?= base_url('js/toggleloader.js') ?>"></script>

    

    <script src="<?= base_url('assets/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

    <script src="<?= base_url('assets/select2/dist/js/select2.min.js') ?>"></script>

    <!-- Select2 JavaScript (si lo usas) -->

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript -->
    <script src="<?= base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages -->
    <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

    <!-- DataTables -->
    <script src="<?= base_url('assets/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/datatables/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('js/demo/datatables-demo.js') ?>"></script>

    <!-- Custom alerts -->
    <script src="<?= base_url('js/demo/alert_custom.js') ?>"></script>

    <script>
        // Tu código que usa jQuery aquí
        $(document).ready(function() {
            console.log("jQuery está cargado!");
            // Aquí va tu código que utiliza jQuery
        });
    </script>
</body>

</html>