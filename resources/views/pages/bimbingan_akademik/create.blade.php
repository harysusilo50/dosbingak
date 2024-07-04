@extends('layout.app')
@section('title', 'Tambah Bimbingan Akademik')
@section('content')

    <div class="card mb-4"style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-chalkboard-teacher mr-1"></i> Tambah Bimbingan
                Akademik </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('bimbingan-akademik.store') }}" method="POST">
                @csrf
                <ul class="list-group">
                    <li class="list-group-item p-1">
                        <div class="form-group row col-12 my-auto">
                            <label class="col-form-label text-dark col-lg-3" style="font-weight: 500">Semester</label>
                            <div class="col-form-label text-dark col-lg-3">
                                {{ $semesterNow }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-1">
                        <div class="form-group row col-12 my-auto">
                            <label class="col-form-label text-dark col-lg-3" style="font-weight: 500">Mahasiswa</label>
                            <div class="col-form-label text-dark col-lg-3">
                                {{ $user->nama }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-1">
                        <div class="form-group row col-12 my-auto">
                            <label class="col-form-label text-dark col-lg-3" style="font-weight: 500">Pembimbing</label>
                            <div class="col-form-label text-dark col-lg-3">
                                {{ $user->nama_dosen_pa }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-1">
                        <div class="form-group mb-3 row col-12 my-auto">
                            <label class="col-form-label text-dark col-lg-3" for="tgl_konsultasi" style="font-weight: 500">Tanggal
                                Konsultasi <span class="text-red font-weight-bold">*</span></label>
                            <div class="col-lg-6 input-group">
                                <input type="date" class="form-control" id="tgl_konsultasi" name="tgl_konsultasi" required>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-1">
                        <div class="form-group mb-3 row col-12 my-auto">
                            <label class="col-form-label text-dark col-lg-3" for="topik" style="font-weight: 500">Topik
                                <span class="text-red font-weight-bold">*</span></label>
                            <div class="col-lg-6 input-group">
                                <input type="text" class="form-control" id="topik" name="topik" required>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item p-1">
                        <div class="form-group mb-3 row col-12 my-auto">
                            <label class="col-form-label text-dark col-lg-3" for="pesan" style="font-weight: 500">Pesan
                                <span class="text-red font-weight-bold">*</span></label>
                            <div class="col-lg-6 input-group">
                                <textarea class="form-control" id="pesan" name="pesan" required></textarea>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-success" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>

@endsection
