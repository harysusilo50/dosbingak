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
                                Total Mahasiswa Ilmu Komputer</div>
                            <h5 class="h3 font-weight-bold mb-1">{{ $totalMahasiswa }}</h5>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-3x text-gray-300"></i>

                        </div>
                    </div>
                </div>
                <a class="card-footer py-0 text-decoration-none text-center text-primary"
                    href="{{ route('admin.bimbingan-akademik.index') }}">
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
                                Total Dosen PA Ilmu Komputer</div>
                            <h5 class="h3 font-weight-bold mb-1">{{ $totalDosen }}</h5>
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
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h6 font-weight-bold text-info mb-1">
                                Total Bimbingan Akademik
                            </div>
                            <h5 class="h3 font-weight-bold mb-1">{{ $totalDosen }}</h5>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                        </div>
                    </div>
                   
                </div>
                <a class="card-footer py-0 text-decoration-none text-center text-info" href="">
                    <small class="my-auto font">More Info <i class="fas fa-fw fa-arrow-alt-circle-right"></i></small>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-12">
            <div class="card shadow">
                <div class="card-header h4 font-weight-bold p-3 text-primary">
                    Total Bimbingan Akademik Setiap Dosen
                </div>
                <div class="card-body">
                    @foreach ($chartBimbingan as $item)
                        @php
                            $faker = Faker\Factory::create();
                        @endphp
                        <div>
                            <label class="col-form-label font-weight-bold">{{ $item['nama_dosen'] }}</label>
                            <div class="text-left d-flex justify-content-end">
                                {{ $item['presentase'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
