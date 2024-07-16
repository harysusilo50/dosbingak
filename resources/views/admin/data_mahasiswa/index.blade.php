@extends('layout.app')
@section('title', 'Data Mahasiswa')
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
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-bar-chart mr-1"></i> Data Mahasiswa Bimbingan</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.data-mahasiswa.index') }}" method="GET">
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="angkatan" style="font-weight: 500">Angkatan</label>
                    <div class="col-lg-6 input-group">
                        <select id="angkatan" name="angkatan" class="form-control">
                            <option value="" selected>- Semua -</option>
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
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="semester"
                        style="font-weight: 500">Semester</label>
                    <div class="col-lg-6 input-group">
                        <select id="semester" name="semester" class="form-control">
                            <option value="" selected>- Semua -</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="jumlah_bimbingan_akademik"
                        style="font-weight: 500">Bimbingan Akademik</label>
                    <div class="col-lg-6 input-group">
                        <select id="jumlah_bimbingan_akademik" name="jumlah_bimbingan_akademik" class="form-control">
                            <option value="" selected>- Semua -</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 d-flex justify-content-end text-left">
                    <div class="col-lg-9">
                        <button class="btn text-white btn-sm mb-1" type="submit" style="background: #43D100">
                            Filter Data
                        </button>
                        @if ($selected_status)
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
                            <th class="text-center">Semester</th>
                            <th class="text-center">Validasi KRS</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataMahasiswa as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->mahasiswa->nama }}</td>
                                <td>{{ $item->mahasiswa->noreg }}</td>
                                <td class="text-center">{{ $item->mahasiswa->angkatan }}</td>
                                <td class="text-center">{{ $item->semester }}</td>
                                <td class="text-center">
                                    @if ($item->status == 'disetujui')
                                        <span class="badge badge-pill badge-success">Sudah</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Belum</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($item->jumlah_bimbingan))
                                        {{ $item->jumlah_bimbingan }} x bimbingan
                                        @else
                                        belum bimbingan
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
