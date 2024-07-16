@extends('layout.app')
@section('title', 'Dashboard')
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 font-weight-bold text-primary mb-1">
                                Profile Mahasiswa</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-circle fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a class="card-footer py-0 text-decoration-none text-center" href="{{ route('profile.index') }}">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 font-weight-bold text-success mb-1">
                                Bimbingan Akademik</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a class="card-footer py-0 text-decoration-none text-center text-success"
                    href="{{ route('bimbingan-akademik.index') }}">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 font-weight-bold text-secondary mb-1">
                                Validasi KRS</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a class="card-footer py-0 text-decoration-none text-center text-secondary"
                    href="{{ route('validasi-krs.index') }}">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="text-danger font-weight-bold mb-4"> <i class="fas fa-fw fa-bullhorn"></i> Perhatian !!!</h4>
            <p class="text-justify">"Setiap mahasiswa diwajibkan untuk menjalani sesi bimbingan akademik paling tidak satu kali dalam seminggu.
                Hal ini bertujuan untuk memberikan dukungan dan bimbingan yang konsisten agar mahasiswa dapat meraih potensi
                akademiknya secara maksimal. Dengan mengintegrasikan bimbingan rutin ini, diharapkan mahasiswa dapat
                mengidentifikasi tantangan, menyelesaikan masalah akademik, dan meningkatkan pencapaian studi. Keterlibatan
                aktif dalam bimbingan akademik ini akan membantu membentuk mahasiswa menjadi individu yang mandiri dan
                sukses dalam perjalanan akademik mereka."</p>
        </div>
    </div>
@endsection
