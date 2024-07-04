<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @include('layout.css')
    <link rel="icon" href="{{ asset('img/unj.png') }}" type="image/x-icon">
    <title>@yield('title') | Sistem Informasi Dosen Pembimbing Akademik</title>
</head>

<body style="background: #DBF8FF" id="page-top">
    @include('sweetalert::alert')
    <div id="content-wrapper">
        <div class="" id="content">
            <div class="px-lg-3 px-1 pt-1 pt-lg-3">
                @include('layout.navbar')
            </div>
            <div class="px-1 px-lg-3" id="wrapper">
                @include('layout.sidebar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Universitas Negeri Jakarta</span>
                </div>
            </div>
        </footer>
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
            <div class="modal-content">
                <div class="modal-header  text-white bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel">Sign Out
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                    </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger" type="submit">
                            Logout
                        </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    @include('layout.js')
</body>

</html>
