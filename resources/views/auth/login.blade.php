@extends('auth.layout')
@section('title', 'Login')
@section('content')
    <div class="row w-100">
        <div class="col-lg-6 d-none d-lg-block">
            <img class="w-100 vh-100" src="{{ asset('img/Rektorat-dan-GDS 1.png') }}">
        </div>
        <div class="col-12 col-lg-6 d-flex align-items-center mt-5 mt-lg-0">
            <div class="m-auto ">
                <div class="text-center text-md-left">
                    <h1 class="h4 text-primary mb-3 text-center font-weight-bold">SISTEM PEMBIMBING AKADEMIK <br>ILMU
                        KOMPUTER <br>UNIVERSITAS NEGERI JAKARTA</h1>
                </div>
                <div class="card o-hidden border-0 shadow-lg my-lg-5 my-2">
                    <div class="card-body p-0">
                        <div class="p-3">
                            <form class="mb-2" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-1">
                                    <label class="col-form-label text-dark" for="email" style="font-weight: 500">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" required placeholder="Masukan Email">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label text-dark" for="password" style="font-weight: 500">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required placeholder="Masukan Password">
                                </div>
                                <button class="btn btn-primary btn-block" style="font-weight: 500"
                                    type="submit">Masuk</button>
                            </form>
                            <div class="text-center small">
                                <span> Belum punya akun? <a href="{{ route('register') }}">Mendaftar</a></span> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
