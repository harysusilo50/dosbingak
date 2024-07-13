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
        <div class="col-xl-3 col-md-6 mb-4">
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
                    href="{{ route('admin.bimbingan-akademik.index') }}">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 font-weight-bold text-success mb-1">
                                Total Dosen PA Ilmu Komputer</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a class="card-footer py-0 text-decoration-none text-center text-success" href="">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h6 font-weight-bold text-info mb-1">
                                Total Mahasiswa yang Bimbingan Akademik
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-middle text-center" style="height: 24px">
                        <p class="h5 font-weight-bold align-middle">{{ $presentasi }}%</p>
                        <div class="progress w-75 my-auto" >
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                                aria-valuenow="{{ $presentasi }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $presentasi }}%"></div>
                        </div>
                    </div>
                </div>
                <a class="card-footer py-0 text-decoration-none text-center text-info" href="">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

        </div>
    </div>
@endsection
