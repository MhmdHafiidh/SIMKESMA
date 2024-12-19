<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="{{ asset('sbadmin2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/medilab/assets/img/simm.png" rel="icon" type="image/png">
    <style>
        .bg-gradient-primary {
            background-color: #2980b9 !important;
            background-image: none !important;
        }

        .sidebar-dark .navbar-nav .nav-item .nav-link {
            color: white;
        }

        .sidebar-dark .navbar-nav .nav-item.active .nav-link {
            color: #ffffff !important;
            background-color: #21618c !important;
        }

        .btn-primary {
            background-color: #2980b9 !important;
            border-color: #2980b9 !important;
        }

        .btn-primary:hover {
            background-color: #21618c !important;
            border-color: #21618c !important;
        }

        .topbar {
            background-color: #2980b9 !important;
        }

        .topbar .nav-link {
            color: white !important;
        }

        .topbar .dropdown-menu {
            border-color: #2980b9 !important;
        }

        footer.bg-white {
            background-color: #f8f9fc;
        }

        footer span {
            color: #2980b9;
        }

        .topbar .text-gray-600 {
            color: white !important;
        }

        .bg-gradient-primary {
            background-color: #2980b9 !important;
            background-image: linear-gradient(135deg, #2980b9, #21618c) !important;
        }

        .sidebar-logo {
            width: 50px;
            height: 50px;
            margin-right: 5px;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <img src="{{ asset('medilab/assets/img/logoo.png') }}" alt="Logo Simkesma" class="sidebar-logo">
                <div class="sidebar-brand-text mx-1">SIMKESMA</div>
            </a>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Route::is('home*') ? 'active' : '' }}">
                <a class="nav-link" href="/home">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="d-none d-md-inline">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 'dokter')
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Data Master</div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseDataKlinik" aria-expanded="true" aria-controls="collapseDataKlinik">
                        <i class="fas fa-pills"></i>
                        <span class="d-none d-md-inline">Obat</span>
                    </a>
                    <div id="collapseDataKlinik" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/obat">Data Obat</a>
                        </div>
                    </div>
                </li>
            @endif
            @if (auth()->user()->role == 'admin')
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseDataKlinik" aria-expanded="true" aria-controls="collapseDataKlinik">
                        <i class="fas fa-pills"></i>
                        <span class="d-none d-md-inline">Obat</span>
                    </a>
                    <div id="collapseDataKlinik" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/obat">Data Obat</a>
                            <a class="collapse-item" href="/obat/create">Tambah Obat</a>
                        </div>
                    </div>
                </li>
            @endif
            @if (auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                        <i class="fas fa-user"></i>
                        <span class="d-none d-md-inline">Data Mahasiswa</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 'mahasiswa' || auth()->user()->role == 'dokter' || auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('chat.index') }}">
                        <i class="fas fa-comments"></i>
                        <span>Chat</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'dokter')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dokter.panduan.index') }}">
                        <i class="fas fa-book-medical"></i>
                        <span>Kelola Panduan</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'mahasiswa')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mahasiswa.panduan.index') }}">
                        <i class="fas fa-book-medical"></i>
                        <span>Lihat Panduan</span>
                    </a>
                </li>
            @endif

            <hr class="sidebar-divider">
            <!-- Sidebar Toggler -->
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
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('sbadmin2/img/undraw_profile.svg') }}">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <!-- Trigger Modal Logout -->
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="#"
                                   data-toggle="modal" data-target="#logoutModal" style="transition: all 0.3s ease;">
                                    <span class="d-flex align-items-center">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-danger"></i>
                                        <span class="text-danger font-weight-bold">Logout</span>
                                    </span>
                                    <i class="fas fa-chevron-right text-muted"></i>
                                </a>
                            </div>


                            <!-- Modal Logout -->
                            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header bg-gradient-primary text-white">
                                            <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Modal Body -->
                                        <div class="modal-body text-center">
                                            <i class="fas fa-exclamation-circle fa-3x text-warning mb-3"></i>
                                            <p>Apakah Anda yakin ingin keluar dari aplikasi?</p>
                                        </div>
                                        <!-- Modal Footer -->
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                <i class="fas fa-times"></i> Batal
                                            </button>
                                            <a class="btn btn-danger" href="/logout">
                                                <i class="fas fa-sign-out-alt"></i> Keluar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @include('flash::message')
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIMKESMA KELOMPOK 4</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin2') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('sbadmin2') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2') }}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2') }}/js/sb-admin-2.min.js"></script>
    <script src="{{ asset('sbadmin2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('sbadmin2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>

</html>
