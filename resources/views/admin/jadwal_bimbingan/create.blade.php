@extends('layout.app')
@section('title', 'Tambah Data Jadwal Konsultasi')
@section('content')
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
            style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-calendar-plus mr-1"></i>Tambah Jadwal Konsultasi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('jadwal-bimbingan.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="nama_dosen_pa" style="font-weight: 500">Nama Dosen
                        PA</label>
                    <div class=" col-lg-6 input-group">
                        <select id="nama_dosen_pa" name="nama_dosen_pa" class="form-control" required
                            {{ Auth::user()->role == 'dosen' ? 'readonly' : '' }}>
                            <option value="" selected>- Pilih Dosen Pembimbing -</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}" {{ $selected_dosen == $item->id ? 'selected' : 'disabled' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="tanggal" style="font-weight: 500">Tanggal Konsultasi</label>
                    <div class=" col-lg-6 input-group">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="start_at" style="font-weight: 500">Jam Mulai</label>
                    <div class=" col-lg-6 input-group">
                        <input type="time" class="form-control" id="start_at" name="start_at" required>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="end_at" style="font-weight: 500">Jam Berakhir</label>
                    <div class=" col-lg-6 input-group">
                        <input type="time" class="form-control" id="end_at" name="end_at" required>
                    </div>
                </div>
                <div class="d-lg-flex justify-content-lg-end">
                    <button class="btn btn-success btn-sm">Tambah Jadwal</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
            style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-calendar-alt mr-1"></i>Daftar Jadwal Konsultasi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Dosen</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Waktu Mulai</th>
                            <th class="text-center">Waktu Berakhir</th>
                            @if (Auth::user()->role == 'admin')
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $item)
                            <tr>
                                <td class="text-center" style="width:5%">
                                    {{ $jadwal->firstItem() + $loop->index }}</td>
                                <td>
                                    {{ $item->dosen->nama }}
                                </td>
                                <td class="text-center">
                                    {{ $item->format_tanggal }}
                                </td>
                                <td class="text-center">
                                    {{ $item->format_start_at }}
                                </td>
                                <td class="text-center">
                                    {{ $item->format_end_at }}
                                </td>
                                @if (Auth::user()->role == 'admin')
                                    <td class="text-center" style="width: 10%">
                                        <div class="d-flex row justify-content-center">
                                            <a class="btn btn-success btn-sm col-8 m-1"
                                                href="#">
                                                Edit <i class="bi bi-pencil ms-2"></i>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm col-8 m-1"
                                                data-toggle="modal" data-target="#model_delete{{ $item->id }}">
                                                Delete <i class="bi bi-trash3-fill ms-2"></i>
                                            </button>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="model_delete{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('jadwal-bimbingan.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">Peringatan!</h5>
                                                            <button type="button" class="btn btn-close bg-light"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body border-0">
                                                            Apakah anda yakin ingin menghapus data ini?
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center border-0">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $jadwal->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
