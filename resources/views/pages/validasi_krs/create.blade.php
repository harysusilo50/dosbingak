@extends('layout.app')
@section('title', 'Upload KRS')
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }
    </style>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="mb-2">{{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </li>
                @endforeach
            </ul>

        </div>
    @endif
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-list mr-1"></i> Upload KRS</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('validasi-krs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-12 col-lg-6">
                    <label for="semester" class="col-form-label text-dark " style="font-weight: 500">Semester</label>
                    <select class="form-control" name="semester" id="semester" required>
                        @for ($i = $semesterNow; $i > $semesterNow - 14; $i--)
                            <option value="{{ $i }}" {{ $i == $semesterNow ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-12 col-lg-6 form-group">
                    <label for="file_krs" class="col-form-label text-dark " style="font-weight: 500">Unggah KRS</label>
                    <input type="file" class="form-control-file form-control" name="file_krs" id="file_krs"
                        aria-describedby="d" required>
                    <small id="d" class="form-text text-danger">*Max 2MB</small>
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn col-lg-4 col-12 text-white" style="background-color: #0CB7C2;">
                        <i class="fas fa-fw fa-upload"></i> Unggah KRS</button>
                </div>
            </form>
        </div>
    </div>
@endsection
