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
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
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

            <!-- Nav Item - Profile -->
            <li class="nav-item {{ Route::is('profil.*') ? 'active' : '' }}">
                <a class="nav-link" href="/profil/create">
                    <i class="fas fa-cogs"></i>
                    <span class="d-none d-md-inline">Profile</span>
                </a>
            </li>

            @if (auth()->user()->role == 'dokter')
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Data Master</div>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                        data-target="#collapseDataKlinik" aria-expanded="true" aria-controls="collapseDataKlinik">
                        <i class="fas fa-clinic-medical"></i>
                        <span class="d-none d-md-inline">Data Klinik</span>
                    </a>
                    <div id="collapseDataKlinik" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/obat/create">Tambah Obat</a>
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
                        <i class="fas fa-clinic-medical"></i>
                        <span class="d-none d-md-inline">Data Klinik</span>
                    </a>
                    <div id="collapseDataKlinik" class="collapse">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="/obat">Data Obat</a>
                            <a class="collapse-item" href="/mahasiswa">Data Mahasiswa</a>
                        </div>
                    </div>
                </li>
            @endif

            @if (auth()->user()->role == 'mahasiswa' || auth()->user()->role == 'dokter' || auth()->user()->role == 'admin' )
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
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
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
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/profil/create">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
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
                        <span>Copyright &copy; {{ env('APP_NAME') }} 2024</span>
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
