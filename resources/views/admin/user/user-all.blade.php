@extends('layout.app')
@section('title', 'List All User')
@section('content')

    <div class="card mb-4"style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-user mr-1"></i> List All User </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="d-lg-flex justify-content-lg-between mb-3 d-block">
                <div class="my-2">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">
                        New
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <!--Table-->
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">

                    <!--Table head-->
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama</th>
                            <th class="text-center">Role</th>
                            <th>Noreg</th>
                            <th>Email</th>
                            <th class="text-center">Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td class="text-center" style="width: 3%">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">
                                    @switch($item->role)
                                        @case('admin')
                                            <span class="badge badge-pill badge-primary">Administrator</span>
                                        @break

                                        @case('dosen')
                                            <span class="badge badge-pill badge-success">Dosen</span>
                                        @break

                                        @case('user')
                                            <span class="badge badge-pill badge-info">Mahasiswa</span>
                                        @break

                                        @default
                                            <span class="badge badge-pill badge-info">{{ $item->role }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $item->noreg }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center">
                                    @if (!empty($item->email_verified_at))
                                        <span class="badge badge-pill badge-primary">Aktif</span>
                                    @else
                                        <span class="badge badge-pill badge-warning">Menunggu verifikasi</span>
                                    @endif
                                </td>
                                <td class="text-center" style="width: 10%">
                                    <div class="d-flex row justify-content-center">
                                        <a class="btn btn-success btn-sm col-8 m-1"
                                            href="{{ route('user.edit', $item->id) }}">
                                            Edit <i class="bi bi-pencil ms-2"></i>
                                        </a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-sm col-8 m-1" data-toggle="modal"
                                            data-target="#model_delete{{ $item->id }}">
                                            Delete <i class="bi bi-trash3-fill ms-2"></i>
                                        </button>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="model_delete{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('user.destroy', $item->id) }}" method="POST">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--Table-->
                <div class="d-flex justify-content-center">
                    {{ $user->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
