@extends('layout.app')
@section('title', 'Profile Mahasiswa ' . $user->nama)
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }

        td {
            font-size: 18px;
        }
    </style>
@endsection
@section('content')
    <div class="card mb-4" style="border-radius: 10px">
        <div class="card-body">
            <div class="text-right">
                <a href="#" data-toggle="modal" data-target="#editProfile" class="btn btn-sm text-white"
                    style="background-color: #0CB7C2"><i class="fas fa-fw fa-pencil-alt"></i> Edit</a>
            </div>
            <div class="row">
                <div class="col-12 col-lg-2 mb-3 mb-lg-0">
                    <div class="text-center">
                        <img class="img-profile rounded-circle" style="width: 100px" src="{{ asset('img/user.png') }}">
                    </div>
                </div>
                <div class="col-12 col-lg-10 my-auto">
                    <table class="table-borderless table" style="width: 100%">
                        <tr>
                            <td class="p-1 ">Nama</td>
                            <td class="p-1 text-dark">{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">NIM</td>
                            <td class="p-1 text-dark">{{ $user->noreg }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row px-3">
                <div class="col-12 col-lg-6 my-auto">
                    <table class="table-borderless table" style="width: 100%">
                        <tr>
                            <td class="p-1 ">Fakultas</td>
                            <td class="p-1 text-dark">FMIPA</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">Program Studi</td>
                            <td class="p-1 text-dark">Ilmu Komputer</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">Angkatan</td>
                            <td class="p-1 text-dark">{{ $user->angkatan }}</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">Jenjang</td>
                            <td class="p-1 text-dark">S1</td>
                        </tr>
                    </table>
                </div>
                <div class="col-12 col-lg-6 my-auto">
                    <table class="table-borderless table" style="width: 100%">
                        <tr>
                            <td class="p-1 ">Dosen PA</td>
                            <td class="p-1 text-dark">{{ $user->nama_dosen_pa }}</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">Alamat</td>
                            <td class="p-1 text-dark">{{ $user->alamat ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">No HP</td>
                            <td class="p-1 text-dark">{{ $user->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-1 ">Email</td>
                            <td class="p-1 text-dark">{{ $user->email ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="no_hp">No HP</label>
                          <input type="text" class="form-control" name="no_hp" id="no_hp" required value="{{ $user->no_hp }}">
                        </div>
                        <div class="form-group">
                          <label for="alamat">Alamat</label>
                          <input type="text" class="form-control" name="alamat" id="alamat" required value="{{ $user->alamat }}">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
