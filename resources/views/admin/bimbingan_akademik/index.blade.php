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
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-chalkboard-teacher mr-1"></i> Bimbingan Akademik</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.bimbingan-akademik.index') }}" method="GET">
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
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="status" style="font-weight: 500">Status</label>
                    <div class="col-lg-6 input-group">
                        <select id="status" name="status" class="form-control">
                            <option value="" {{ $selected_status == '' ? 'selected' : '' }}>- Semua -</option>
                            <option value="menunggu" {{ $selected_status == 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="disetujui" {{ $selected_status == 'disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="ditolak" {{ $selected_status == 'ditolak' ? 'selected' : '' }}>Ditolak </option>
                            <option value="selesai" {{ $selected_status == 'selesai' ? 'selected' : '' }}>Selesai </option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group mb-3">
                        <a href="{{ route('bimbingan-akademik.report',['selected_dosen'=>$selected_dosen]) }}" target="_blank" class="btn btn-danger btn-sm"> Cetak <i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="form-group mb-3 text-right">
                        <button class="btn text-white btn-sm mb-1" type="submit" style="background: #0CB7C2">
                            Cari <i class="fas fa-fw fa-search text-white"></i>
                        </button>
                        @if ($selected_dosen)
                            <br>
                            <a href="{{ route('admin.bimbingan-akademik.index') }}" class="btn btn-sm btn-danger">Reset</a>
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
                            <th>Nama Dosen PA</th>
                            <th>Topik</th>
                            <th>Waktu & Tanggal</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                            <th class="text-center">Keterangan</th>
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
                                <td>
                                    @if ($item->status == 'menunggu')
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-success btn-sm btn-circle mr-1"
                                                data-toggle="modal" data-target="#modalSetujui">
                                                <i class="fas fa-fw fa-check"></i></a>
                                            <a href="" class="btn btn-danger btn-sm btn-circle" data-toggle="modal"
                                                data-target="#modalTolak">
                                                <i class="fas fa-fw fa-times"></i></a>
                                            <!-- Modal Setujui -->
                                            <div class="modal fade" id="modalSetujui" tabindex="-1" role="dialog"
                                                aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title text-white">Setujui Bimbingan</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('admin.bimbingan-akademik.setujui') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="text" class="d-none" name="bimbingan_id"
                                                                value="{{ $item->id }}">
                                                            <div class="modal-body">
                                                                Apakah anda yakin setujui bimbingan ini?
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="submit"
                                                                    class="btn btn-success">Setujui</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Modal Tolak --}}
                                            <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog"
                                                aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title text-white">Tolak Bimbingan</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('admin.bimbingan-akademik.tolak') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="text" class="d-none" name="bimbingan_id"
                                                                value="{{ $item->id }}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="text-dark">Keterangan Penolakan</label>
                                                                    <textarea class="form-control" name="keterangan" cols="30" rows="5" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="submit"
                                                                    class="btn btn-danger">Kirim</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'ditolak')
                                        {{ $item->keterangan }}
                                    @else
                                        <a href="{{ route('admin.konsultasi-bimbingan-akademik.index', ['bimbingan_id' => $item->id]) }}"
                                            class="btn btn-secondary btn-sm text-wrap p-1">
                                            <small>Lihat Pesan</small>
                                        </a>
                                    @endif
                                </td>
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
