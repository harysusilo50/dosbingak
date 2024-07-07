@extends('layout.app')
@section('title', 'Bimbingan Akademik')
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }
    </style>
@endsection
@section('content')
    @if (!$checkBimbinganSemester)
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px">
        <h5 class="alert-heading font-weight-bold"> <i class="fas fa-fw fa-bullhorn"></i> Perhatian</h5>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        Anda belum melakukan bimbingan akademik di semester {{ $semesterNow }} 
    </div>
    @endif
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-chalkboard-teacher mr-1"></i> Bimbingan Akademik</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="text-right mb-3">
                <a href="{{ route('bimbingan-akademik.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i>
                    Tambah</a>
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
                            <th>Nama Dosen PA</th>
                            <th>Topik</th>
                            <th>Waktu & Tanggal</th>
                            <th class="text-center">Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bimbinganAkedmik as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->mahasiswa->noreg }}</td>
                            <td>{{ $item->mahasiswa->nama_dosen_pa }}</td>
                            <td>{{ $item->topik }}</td>
                            <td>{{ $item->format_tgl_konsultasi }}</td>
                            <td class="text-center">
                                @switch($item->status)
                                    @case('menunggu')
                                        <span class="badge badge-pill badge-warning">Menuggu</span>
                                        @break
                                    @case('disetujui')
                                        <span class="badge badge-pill badge-success">Disetujui</span>
                                        @break
                                    @case('ditolak')
                                        <span class="badge badge-pill badge-danger">Ditolak</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge badge-pill badge-primary">Selesai</span>
                                        @break
                                    @default
                                    <span class="badge badge-pill badge-secondary">{{ $item->status }}</span>
                                    @break
                                        
                                @endswitch
                            </td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--Table-->
                {{-- <div class="d-flex justify-content-center">
                    {{ $bimbinganAkedmik->links() }}
                </div> --}}
            </div>
        </div>
    </div>
@endsection
