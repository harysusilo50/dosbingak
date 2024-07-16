@extends('layout.app')
@section('title', 'Data Dosen')
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }
    </style>
@endsection
@section('content')
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-bar-chart mr-1"></i> Data Dosen Ilmu Komputer</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Dosen</th>
                            <th>NIP</th>
                            <th class="text-center">Jumlah Mahasiswa Bimbingan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataDosen as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->noreg }}</td>
                                <td class="text-center">{{ $item->jumlah_mahasiswa_bimbingan ?? 0 }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
