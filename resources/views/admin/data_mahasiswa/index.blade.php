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
                            @foreach ($angkatan as $item)
                                <option value="{{ $item }}" {{ $item == $selected_angkatan ? 'selected':'' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="persetujuan_krs" style="font-weight: 500">Persetujuan KRS</label>
                    <div class="col-lg-6 input-group">
                        <select id="persetujuan_krs" name="persetujuan_krs" class="form-control">
                            <option value="" {{ $selected_persetujuan_krs == '' ? 'selected' : '' }}>- Semua -</option>
                            <option value="belum" {{ $selected_persetujuan_krs == 'belum' ? 'selected' : '' }}>Belum
                            </option>
                            <option value="selesai" {{ $selected_persetujuan_krs == 'selesai' ? 'selected' : '' }}>Sudah </option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="jumlah_bimbingan_akademik"
                        style="font-weight: 500">Bimbingan Akademik</label>
                    <div class="col-lg-6 input-group">
                        <select id="jumlah_bimbingan_akademik" name="jumlah_bimbingan_akademik" class="form-control">
                            <option value="" selected>- Semua -</option>
                            <option value="belum" >Belum Pernah Bimbingan</option>
                            <option value="pernah" >1x Bimbingan</option>
                            <option value="lebih" >Lebih dari 1x Bimbingan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 d-flex justify-content-end text-left">
                    <div class="col-lg-9">
                        <button class="btn text-white btn-sm mb-1" type="submit" style="background: #43D100">
                            Filter Data
                        </button>
                        @if ($selected_angkatan || $selected_persetujuan_krs)
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
                        @foreach ($dataMahasiswa as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->noreg }}</td>
                                <td class="text-center">{{ $item->angkatan }}</td>
                                <td class="text-center">
                                    @if ($item->validasi_krs_semester > 0)
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
