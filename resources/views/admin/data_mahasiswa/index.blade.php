@extends('layout.app')
@section('title', 'Data Mahasiswa')
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }
    </style>
    <link href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-bar-chart mr-1"></i> Data Mahasiswa Bimbingan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.data-mahasiswa.index') }}" method="GET">
            <div class="form-group mb-3 row col-12">
                <label class="col-form-label text-dark col-lg-3" for="nama_dosen_pa" style="font-weight: 500">Nama Dosen
                    PA</label>
                <div class="col-lg-6 input-group">
                    <select id="nama_dosen_pa" name="nama_dosen_pa" class="form-control" {{ Auth::user()->role == 'dosen' ? 'disabled':'' }}>
                        <option value="" selected>- Semua -</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}" {{ $selected_dosen == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-group mb-3">
                    <a href="{{ route('admin.data-mahasiswa.report',['nama_dosen_pa'=>$selected_dosen]) }}" target="_blank" class="btn btn-danger btn-sm">
                        Cetak <i class="fa fa-download" aria-hidden="true"></i></a>
                </div>
                <div class="form-group mb-3 text-right">
                    <button class="btn text-white btn-sm mb-1" type="submit" style="background: #0CB7C2">
                        Cari <i class="fas fa-fw fa-search text-white"></i>
                    </button>
                    @if ($selected_dosen)
                        <br>
                        <a href="{{ route('admin.data-mahasiswa.index') }}" class="btn btn-sm btn-danger">Reset</a>
                    @endif
                </div>
            </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th class="text-center">Angkatan</th>
                            <th class="text-center">Validasi KRS <br> Semester Ini</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#dataTable').DataTable({
            data: @json($dataMahasiswa),
            columns: [{
                    data: null,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Display row number
                    }
                },
                {
                    data: 'nama'
                },
                {
                    data: 'noreg'
                },
                {
                    data: 'angkatan',
                    className: "text-center"
                },
                {
                    data: 'validasi',
                    className: "text-center"
                },
                {
                    data: 'bimbingan',
                    className: "text-center"
                }
            ]
        });
    </script>
@endsection
