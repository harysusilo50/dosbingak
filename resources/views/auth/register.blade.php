@extends('auth.layout')
@section('title', 'Register')
@section('content')
    <div class="row w-100 d-flex justify-content-center mb-5">
        <div class="col-lg-5">
            <div class="text-center mt-5 mb-3">
                <h1 class="h4 font-weight-bold text-dark" style="font-weight: 500">Buat Akun Mahasiswa</h1>
            </div>
            <div class="card o-hidden border-0 rounded-lg shadow-lg ">
                <div class="card-body p-0">
                    <div class="px-5 py-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-1">
                                <label class="col-form-label text-dark" for="nama" style="font-weight: 500">Nama</label>
                                <input id="nama" type="text"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukan Nama Lengkap" name="nama" value="{{ old('nama') }}" required
                                    autocomplete="nama" autofocus>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label text-dark" for="email"
                                    style="font-weight: 500">Email</label>
                                <input id="email" type="text"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Masukan Email"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label text-dark" for="noreg" style="font-weight: 500">NIM</label>
                                <input id="noreg" type="text"
                                    class="form-control @error('noreg') is-invalid @enderror" placeholder="Masukan NIM"
                                    name="noreg" value="{{ old('noreg') }}" required autocomplete="noreg" autofocus>
                                @error('noreg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label text-dark" for="nama_dosen_pa" style="font-weight: 500">Nama
                                    Dosen PA</label>
                                <select class="form-control" name="nama_dosen_pa" id="nama_dosen_pa" required>
                                    <option disabled selected>-Pilih Dosen PA-</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->nama }}" {{ old('noreg') == $item->name ? 'selected' : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label text-dark" for="angkatan"
                                    style="font-weight: 500">Angkatan</label>
                                <input id="angkatan" type="text"
                                    class="form-control @error('angkatan') is-invalid @enderror"
                                    placeholder="Tahun masuk kuliah" name="angkatan" value="{{ old('angkatan') }}" required
                                    autocomplete="angkatan" autofocus>
                                @error('angkatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label text-dark" for="password"
                                    style="font-weight: 500">Password</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Buat Password"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label text-dark" for="password-confirm"
                                    style="font-weight: 500">Konfirmasi
                                    Password</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    placeholder="Konfirmasi Password" name="password_confirmation" required
                                    autocomplete="new-password">
                            </div>
                            <button class="btn btn-primary btn-block" style="font-weight: 500"
                                type="submit">Daftar</button>
                        </form>
                        <hr>
                        <div class="text-left small">
                            <span> Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></span> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
