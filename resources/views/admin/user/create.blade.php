@extends('layout.app')
@section('title', 'Tambah Pengguna')
@section('content')
    <div class="card mb-4" style="border-radius: 10px">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
            style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-user-plus mr-1"></i> Tambah User </h6>
        </div>
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
                <form method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="form-group mb-1">
                        <label class="col-form-label text-dark" for="nama" style="font-weight: 500">Nama</label>
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukan Nama Lengkap" name="nama" value="{{ old('nama') }}" required
                            autocomplete="nama" autofocus>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label class="col-form-label text-dark" for="email" style="font-weight: 500">Email</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukan Email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label class="col-form-label text-dark" for="password" style="font-weight: 500">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Buat Password" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label class="col-form-label text-dark" for="" style="font-weight: 500">Role</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="dosen_role" value="dosen" />
                            <label class="form-check-label" for="dosen_role">
                                Dosen
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="mahasiswa_role"
                                value="user" checked />
                            <label class="form-check-label" for="mahasiswa_role">
                                Mahasiswa
                            </label>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label class="col-form-label text-dark" for="noreg" id="noreg_label"
                            style="font-weight: 500">NIM</label>
                        <input id="noreg" type="text"
                            class="form-control @error('noreg') is-invalid @enderror" placeholder="Masukan NIM"
                            name="noreg" value="{{ old('noreg') }}" required autocomplete="noreg" autofocus>
                        @error('noreg')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div id="mahasiswa">
                        <div class="form-group mb-1">
                            <label class="col-form-label text-dark" for="nama_dosen_pa" style="font-weight: 500">Nama
                                Dosen PA</label>
                            <select class="form-control" name="nama_dosen_pa" id="nama_dosen_pa" required>
                                <option selected value="">-Pilih Dosen PA-</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->nama }}"
                                        {{ old('noreg') == $item->nama ? 'selected' : '' }}>
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
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
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary col-lg-6 col-12 mb-1" style="font-weight: 500"
                            type="submit">Simpan</button>
                            <a href="{{ route('user.all') }}" class="btn btn-light text-danger col-lg-6 col-12 fw-bold">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
     $(document).ready(function () {
    // Sembunyikan form dosen dan mahasiswa saat halaman dimuat
    $('#dosen').hide();
    $('#mahasiswa').show();

    function toggleRequired(selector, required) {
        $(selector).prop('required', required);
    }

    $('input[name="role"]').change(function () {
        if ($('#dosen_role').is(':checked')) {
            $('#dosen').slideDown();
            $('#mahasiswa').slideUp();
            toggleRequired('#dosen input, #dosen select', true);
            toggleRequired('#mahasiswa input, #mahasiswa select', false);
            $('#noreg_label').text('NIP');
            $('#noreg').attr('placeholder', 'Masukan NIP Dosen');
        } else {
            $('#mahasiswa').slideDown();
            $('#dosen').slideUp();
            toggleRequired('#mahasiswa input, #mahasiswa select', true);
            toggleRequired('#dosen input, #dosen select', false);
            $('#noreg_label').text('NIM');
            $('#noreg').attr('placeholder', 'Masukan NIM Mahasiswa');
        }
    });
});

    </script>
@endsection
