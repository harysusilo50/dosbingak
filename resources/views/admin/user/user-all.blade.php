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
                            <th>Aksi</th>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--Table-->
            </div>
        </div>
    </div>

@endsection
