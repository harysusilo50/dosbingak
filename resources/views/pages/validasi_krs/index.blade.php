@extends('layout.app')
@section('title', 'Persetujuan KRS')
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
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-list mr-1"></i> Persetujuan KRS</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="text-right mb-3">
                <a href="{{ route('validasi-krs.create') }}" class="btn btn-success btn-sm"><i class="fas fa-upload"></i>
                    Upload</a>
            </div>
            <div class="table-responsive">
                <!--Table-->
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">

                    <!--Table head-->
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Semester</th>
                            <th class="text-center">Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($validasiKrs as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->mahasiswa->nama }}</td>
                                <td>{{ $item->mahasiswa->noreg }}</td>
                                <td>{{ $item->mahasiswa->angkatan }}</td>
                                <td>{{ $item->semester }}</td>
                                <td class="text-center">
                                    @switch($item->status)
                                        @case('menunggu')
                                            <span class="badge badge-pill badge-warning">Menuggu Persetujuan</span>
                                        @break

                                        @case('disetujui')
                                            <span class="badge badge-pill badge-success">Disetujui</span>
                                        @break

                                        @case('ditolak')
                                            <span class="badge badge-pill badge-danger">Ditolak</span>
                                        @break

                                        @default
                                            <span class="badge badge-pill badge-secondary">{{ $item->status }}</span>
                                        @break
                                    @endswitch
                                    <br>
                                    <a class="text-small text-danger" target="_blank" href="{{ url('/') . '/' . $item->file_krs }}">
                                        <i class="fas fa-fw fa-file-pdf"></i> Lihat Dokumen</a>
                                </td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--Table-->
                {{-- <div class="d-flex justify-content-center">
                    {{ $validasiKrs->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
