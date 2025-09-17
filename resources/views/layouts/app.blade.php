<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Desa - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <style>
        
    
    
        @media (max-width: 991.98px) {
/* Sidebar overlapping (fixed position, tidak mendorong konten) */
.sidebar {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040; /* Di atas konten, tapi di bawah modal (1050+) */
            height: 100vh;
            width: 250px !important;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        /* Menampilkan teks di samping ikon */
        .nav-item {
            display: block;
        }

        .nav-link {
            padding: 1rem 1.5rem !important;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            white-space: normal;
            word-wrap: break-word;
            text-align: left;
        }

        .nav-link span {
            margin-left: 0.5rem;
            font-size: 0.9rem;
            color: #fff;
            display: inline-block;
            /* min-width: 100px; */
            /* overflow: hidden; */
            /* text-overflow: ellipsis; */
            white-space: nowrap;
        }

        /* Jika ingin ikon tetap besar */
        .nav-link i {
            font-size: 1.2rem;
        }
    
/* Overlay untuk menutup sidebar di mobile */
.sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1039; /* tepat di bawah sidebar (1040) */
    }

    .sidebar-overlay.active {
        display: block;
    }

        /* Saat sidebar ditoggle (tertutup), geser ke kiri hingga tidak terlihat */
        .sidebar.toggled {
            transform: translateX(-100%);
        }
    
        /* Konten utama tidak perlu margin-left saat sidebar terbuka */
        #content-wrapper {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }
        
            body.sidebar-toggled::before {
                display: block;
            }
        }
    
        /* Pastikan topbar tidak tertutup sidebar */
        #content-wrapper #content #navbar {
            z-index: 1041;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body id="page-top" class="sidebar-toggled">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <div class="sidebar-overlay"></div>

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layouts.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/logout" method="post">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Anda yakin keluar?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Logout</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    {{-- <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script>

    <script>
      $(document).ready(function() {
    const $overlay = $('.sidebar-overlay');

    // Sidebar tetap terbuka di desktop
    if ($(window).width() >= 992) {
        $('body').removeClass('sidebar-toggled');
        $('.sidebar').removeClass('toggled');
    }

    function openSidebar() {
        $('body').addClass('sidebar-open');
        $('.sidebar').removeClass('toggled'); // buka sidebar
        $overlay.addClass('active');
    }

    function closeSidebar() {
        $('body').removeClass('sidebar-open');
        $('.sidebar').addClass('toggled'); // tutup sidebar
        $overlay.removeClass('active');
    }

    // Toggle sidebar via tombol
    $('#sidebarToggleTop, #sidebarToggle').on('click', function() {
        if ($(window).width() < 992) {
            if ($('.sidebar').hasClass('toggled')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        }
    });

    // Klik overlay untuk menutup sidebar
    $overlay.on('click', function() {
        closeSidebar();
    });

    // Pastikan di desktop sidebar selalu terbuka
    $(window).on('resize', function() {
        if ($(window).width() >= 992) {
            $('body').removeClass('sidebar-open');
            $('.sidebar').removeClass('toggled');
            $overlay.removeClass('active');
        } else {
            closeSidebar(); // pastikan tertutup default saat mobile
        }
    });
});


        
    </script>

</body>

</html>