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
                        <img class="img-profile rounded-circle" style="width: 100px"
                            src="{{ $user->profile_pic ? asset($user->profile_pic) : asset('img/user.png') }}">
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
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp"
                                value="{{ $user->no_hp }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat"
                                value="{{ $user->alamat }}">
                        </div>
                        <div class="form-group">
                            <label for="image-dropify" class="col-form-label" style="font-weight: 500">Ubah Foto
                                Profil</label>
                            <input id="image-dropify" type="file" class="form-control dropify" data-width="200"
                                data-height="200" accept="image/*" data-max-file-size="2M">
                            <p class="text-danger text-small font-weight-bold m-0">*Ukuran gambar max 2MB</p>
                            <div class="modal " tabindex="-1" data-backdrop="static" data-keyboard="false" id="myModal"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success text-white text-center">
                                            <h5 class="modal-title ">Sesuaikan Gambar <i class="fas fa-crop-alt"></i></h5>
                                        </div>
                                        <div class="modal-body">
                                            <div id="cropie-demo"></div>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" id="crop"
                                                class="btn btn-success col-6">Potong</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <textarea id="image-dropify-send" class="d-none" name="image"></textarea>
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
@section('js')
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        });
        var uploadCrop = $('#cropie-demo').croppie({
            viewport: {
                width: 250,
                height: 250
            },
            boundary: {
                width: 450,
                height: 300
            },
        });
        $('#image-dropify').on('change', function() {
            $('#myModal').modal('show');
            var reader = new FileReader();
            reader.onload = function(e) {
                uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    $('.dropify-render').empty();
                    $('.dropify-render').append(
                        '<div class="text-center mt-3"><div class="spinner-grow" style="width: 4rem; height: 4rem;" role="status"><span class="sr-only">Loading...</span></div><h1>Loading...</h1></div>'
                    );
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
        $('#crop').on('click', function() {
            var result = uploadCrop.croppie('result', {
                type: 'base64',
                size: {
                    width: 400,
                    height: 400
                }
            }).then(function(blob) {
                $('#myModal').modal('hide');
                $('.dropify-render').empty();
                $('.dropify-render').append('<img src="' + blob + '">');
                $('#image-dropify-send').val(blob);
            });
        });
    </script>
@endsection
