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
         
            {{-- <div class="table-responsive">
                <!--Table-->
                <table class="table table-striped" id="dataTable" cellspacing="0">

                    <!--Table head-->
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>
                <!--Table-->
            </div> --}}
        </div>
    </div>

@endsection

