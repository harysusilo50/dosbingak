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
