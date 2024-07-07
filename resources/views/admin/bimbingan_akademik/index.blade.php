@extends('layout.app')
@section('title', 'Bimbingan Akademik')
@section('css')
    <style>
        .card {
            color: #5a5c69;
        }
    </style>
    <style>
        .chat-search-box {
            -webkit-border-radius: 3px 0 0 0;
            -moz-border-radius: 3px 0 0 0;
            border-radius: 3px 0 0 0;
            padding: .75rem 1rem;
        }

        .chat-search-box .input-group .form-control {
            -webkit-border-radius: 2px 0 0 2px;
            -moz-border-radius: 2px 0 0 2px;
            border-radius: 2px 0 0 2px;
            border-right: 0;
        }

        .chat-search-box .input-group .form-control:focus {
            border-right: 0;
        }

        .chat-search-box .input-group .input-group-btn .btn {
            -webkit-border-radius: 0 2px 2px 0;
            -moz-border-radius: 0 2px 2px 0;
            border-radius: 0 2px 2px 0;
            margin: 0;
        }

        .chat-search-box .input-group .input-group-btn .btn i {
            font-size: 1.2rem;
            line-height: 100%;
            vertical-align: middle;
        }

        @media (max-width: 767px) {
            .chat-search-box {
                display: none;
            }
        }


        /************************************************
     ************************************************
             Users Container
     ************************************************
    ************************************************/

        .users-container {
            position: relative;
            padding: 1rem 0;
            border-right: 1px solid #e6ecf3;
            height: 100%;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
        }


        /************************************************
     ************************************************
               Users
     ************************************************
    ************************************************/

        .users {
            padding: 0;
        }

        .users .person {
            position: relative;
            width: 100%;
            padding: 10px 1rem;
            cursor: pointer;
            border-bottom: 1px solid #f0f4f8;
        }

        .users .person:hover {
            background-color: #ffffff;
            /* Fallback Color */
            background-image: -webkit-gradient(linear, left top, left bottom, from(#e9eff5), to(#ffffff));
            /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient(right, #e9eff5, #ffffff);
            /* Chrome 10+, Saf5.1+, iOS 5+ */
            background-image: -moz-linear-gradient(right, #e9eff5, #ffffff);
            /* FF3.6 */
            background-image: -ms-linear-gradient(right, #e9eff5, #ffffff);
            /* IE10 */
            background-image: -o-linear-gradient(right, #e9eff5, #ffffff);
            /* Opera 11.10+ */
            background-image: linear-gradient(right, #e9eff5, #ffffff);
        }

        .users .person.active-user {
            background-color: #ffffff;
            /* Fallback Color */
            background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f9fb), to(#ffffff));
            /* Saf4+, Chrome */
            background-image: -webkit-linear-gradient(right, #f7f9fb, #ffffff);
            /* Chrome 10+, Saf5.1+, iOS 5+ */
            background-image: -moz-linear-gradient(right, #f7f9fb, #ffffff);
            /* FF3.6 */
            background-image: -ms-linear-gradient(right, #f7f9fb, #ffffff);
            /* IE10 */
            background-image: -o-linear-gradient(right, #f7f9fb, #ffffff);
            /* Opera 11.10+ */
            background-image: linear-gradient(right, #f7f9fb, #ffffff);
        }

        .users .person:last-child {
            border-bottom: 0;
        }

        .users .person .user {
            display: inline-block;
            position: relative;
            margin-right: 10px;
        }

        .users .person .user img {
            width: 48px;
            height: 48px;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
        }

        .users .person .user .status {
            width: 10px;
            height: 10px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
            background: #e6ecf3;
            position: absolute;
            top: 0;
            right: 0;
        }

        .users .person .user .status.online {
            background: #9ec94a;
        }

        .users .person .user .status.offline {
            background: #c4d2e2;
        }

        .users .person .user .status.away {
            background: #f9be52;
        }

        .users .person .user .status.busy {
            background: #fd7274;
        }

        .users .person p.name-time {
            font-weight: 600;
            font-size: .85rem;
            display: inline-block;
        }

        .users .person p.name-time .time {
            font-weight: 400;
            font-size: .7rem;
            text-align: right;
            color: #8796af;
        }

        @media (max-width: 767px) {
            .users .person .user img {
                width: 30px;
                height: 30px;
            }

            .users .person p.name-time {
                display: none;
            }

            .users .person p.name-time .time {
                display: none;
            }
        }


        /************************************************
     ************************************************
             Chat right side
     ************************************************
    ************************************************/

        .selected-user {
            width: 100%;
            padding: 0 15px;
            min-height: 64px;
            line-height: 64px;
            border-bottom: 1px solid #e6ecf3;
            -webkit-border-radius: 0 3px 0 0;
            -moz-border-radius: 0 3px 0 0;
            border-radius: 0 3px 0 0;
        }

        .selected-user span {
            line-height: 100%;
        }

        .selected-user span.name {
            font-weight: 700;
        }

        .chat-container {
            position: relative;
            padding: 1rem;
        }

        .chat-container li.chat-left,
        .chat-container li.chat-right {
            display: flex;
            flex: 1;
            flex-direction: row;
            margin-bottom: 40px;
        }

        .chat-container li img {
            width: 48px;
            height: 48px;
            -webkit-border-radius: 30px;
            -moz-border-radius: 30px;
            border-radius: 30px;
        }

        .chat-container li .chat-avatar {
            margin-right: 20px;
        }

        .chat-container li.chat-right {
            justify-content: flex-end;
        }

        .chat-container li.chat-right>.chat-avatar {
            margin-left: 20px;
            margin-right: 0;
        }

        .chat-container li .chat-name {
            font-size: .75rem;
            color: #999999;
            text-align: center;
        }

        .chat-container li .chat-text {
            padding: .4rem 1rem;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            background: #ffffff;
            font-weight: 300;
            line-height: 150%;
            position: relative;
        }

        .chat-container li .chat-text:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            top: 10px;
            left: -20px;
            border: 10px solid;
            border-color: transparent #ffffff transparent transparent;
        }

        .chat-container li.chat-right>.chat-text {
            text-align: right;
        }

        .chat-container li.chat-right>.chat-text:before {
            right: -20px;
            border-color: transparent transparent transparent #ffffff;
            left: inherit;
        }

        .chat-container li .chat-hour {
            padding: 0;
            margin-bottom: 10px;
            font-size: .75rem;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin: 0 0 0 15px;
        }

        .chat-container li .chat-hour>span {
            font-size: 16px;
            color: #9ec94a;
        }

        .chat-container li.chat-right>.chat-hour {
            margin: 0 15px 0 0;
        }

        @media (max-width: 767px) {

            .chat-container li.chat-left,
            .chat-container li.chat-right {
                flex-direction: column;
                margin-bottom: 30px;
            }

            .chat-container li img {
                width: 32px;
                height: 32px;
            }

            .chat-container li.chat-left .chat-avatar {
                margin: 0 0 5px 0;
                display: flex;
                align-items: center;
            }

            .chat-container li.chat-left .chat-hour {
                justify-content: flex-end;
            }

            .chat-container li.chat-left .chat-name {
                margin-left: 5px;
            }

            .chat-container li.chat-right .chat-avatar {
                order: -1;
                margin: 0 0 5px 0;
                align-items: center;
                display: flex;
                justify-content: right;
                flex-direction: row-reverse;
            }

            .chat-container li.chat-right .chat-hour {
                justify-content: flex-start;
                order: 2;
            }

            .chat-container li.chat-right .chat-name {
                margin-right: 5px;
            }

            .chat-container li .chat-text {
                font-size: .8rem;
            }
        }

        .chat-form {
            padding: 15px;
            width: 100%;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ffffff;
            border-top: 1px solid white;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .card {
            border: 0;
            background: #f4f5fb;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
            margin-bottom: 2rem;
            box-shadow: none;
        }
    </style>
@endsection
@section('content')
    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div
            class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-chalkboard-teacher mr-1"></i> Bimbingan Akademik</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.bimbingan-akademik.index') }}" method="GET">
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="nama_dosen_pa" style="font-weight: 500">Nama Dosen
                        PA</label>
                    <div class="col-lg-6 input-group">
                        <select id="nama_dosen_pa" name="nama_dosen_pa" class="form-control">
                            <option value="" selected>- Semua -</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}" {{ $selected_dosen == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="status" style="font-weight: 500">Status</label>
                    <div class="col-lg-6 input-group">
                        <select id="status" name="status" class="form-control">
                            <option value="" {{ $selected_status == '' ? 'selected' : '' }}>- Semua -</option>
                            <option value="menunggu" {{ $selected_status == 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="disetujui" {{ $selected_status == 'disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="ditolak" {{ $selected_status == 'ditolak' ? 'selected' : '' }}>Ditolak </option>
                            <option value="selesai" {{ $selected_status == 'selesai' ? 'selected' : '' }}>Selesai </option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3 text-right">
                    <button class="btn text-white btn-sm mb-1" type="submit" style="background: #0CB7C2">
                        Cari <i class="fas fa-fw fa-search text-white"></i>
                    </button>
                    @if ($selected_dosen)
                        <br>
                        <a href="{{ route('admin.bimbingan-akademik.index') }}" class="btn btn-sm btn-danger">Reset</a>
                    @endif
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Nama Dosen PA</th>
                            <th>Topik</th>
                            <th>Waktu & Tanggal</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bimbinganAkedmik as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->mahasiswa->nama }}</td>
                                <td>{{ $item->mahasiswa->noreg }}</td>
                                <td>{{ $item->mahasiswa->nama_dosen_pa }}</td>
                                <td>{{ $item->topik }}</td>
                                <td>{{ $item->format_tgl_konsultasi }}</td>
                                <td class="text-center">
                                    @switch($item->status)
                                        @case('menunggu')
                                            <span class="badge badge-pill badge-warning">Menuggu</span>
                                        @break

                                        @case('disetujui')
                                            <span class="badge badge-pill badge-success">Disetujui</span>
                                        @break

                                        @case('ditolak')
                                            <span class="badge badge-pill badge-danger">Ditolak</span>
                                        @break

                                        @case('selesai')
                                            <span class="badge badge-pill badge-primary">Selesai</span>
                                        @break

                                        @default
                                            <span class="badge badge-pill badge-secondary">{{ $item->status }}</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @if ($item->status == 'menunggu')
                                        <div class="d-flex">
                                            <a href="#" class="btn btn-success btn-sm btn-circle mr-1"
                                                data-toggle="modal" data-target="#modalSetujui">
                                                <i class="fas fa-fw fa-check"></i></a>
                                            <a href="" class="btn btn-danger btn-sm btn-circle" data-toggle="modal"
                                                data-target="#modalTolak">
                                                <i class="fas fa-fw fa-times"></i></a>
                                            <!-- Modal Setujui -->
                                            <div class="modal fade" id="modalSetujui" tabindex="-1" role="dialog"
                                                aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog modal-sm" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title text-white">Setujui Bimbingan</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('admin.bimbingan-akademik.setujui') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="text" class="d-none" name="bimbingan_id"
                                                                value="{{ $item->id }}">
                                                            <div class="modal-body">
                                                                Apakah anda yakin setujui bimbingan ini?
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="submit"
                                                                    class="btn btn-success">Setujui</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Modal Tolak --}}
                                            <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog"
                                                aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title text-white">Tolak Bimbingan</h5>
                                                            <button type="button" class="close text-white"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('admin.bimbingan-akademik.tolak') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="text" class="d-none" name="bimbingan_id"
                                                                value="{{ $item->id }}">
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="text-dark">Keterangan Penolakan</label>
                                                                    <textarea class="form-control" name="keterangan" cols="30" rows="5" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="submit"
                                                                    class="btn btn-danger">Kirim</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'ditolak')
                                        {{ $item->keterangan }}
                                    @else
                                        <a href="" class="btn btn-secondary btn-sm text-wrap p-1">
                                            <small>Lihat Pesan</small>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--Table-->
                {{-- <div class="d-flex justify-content-center">
                    {{ $bimbinganAkedmik->links() }}
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="selected-user">
            <span>To: <span class="name">Emily Russell</span></span>
        </div>
        <div class="chat-container">
            <ul class="chat-box chatContainerScroll">
                <li class="chat-left">
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text">Hello, I'm Russell.
                        <br>How can I help you today?
                    </div>
                    <div class="chat-hour">08:55 <span class="fa fa-check-circle"></span></div>
                </li>
                <li class="chat-right">
                    <div class="chat-hour">08:56 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Hi, Russell
                        <br> I need more information about Developer Plan.
                    </div>
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                        <div class="chat-name">Sam</div>
                    </div>
                </li>
                <li class="chat-left">
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text">Are we meeting today?
                        <br>Project has been already finished and I have results to show you.
                    </div>
                    <div class="chat-hour">08:57 <span class="fa fa-check-circle"></span></div>
                </li>
                <li class="chat-right">
                    <div class="chat-hour">08:59 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Well I am not sure.
                        <br>I have results to show you.
                    </div>
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar5.png" alt="Retail Admin">
                        <div class="chat-name">Joyse</div>
                    </div>
                </li>
                <li class="chat-left">
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text">The rest of the team is not here yet.
                        <br>Maybe in an hour or so?
                    </div>
                    <div class="chat-hour">08:57 <span class="fa fa-check-circle"></span></div>
                </li>
                <li class="chat-right">
                    <div class="chat-hour">08:59 <span class="fa fa-check-circle"></span></div>
                    <div class="chat-text">Have you faced any problems at the last phase of the project?</div>
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar4.png" alt="Retail Admin">
                        <div class="chat-name">Jin</div>
                    </div>
                </li>
                <li class="chat-left">
                    <div class="chat-avatar">
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Retail Admin">
                        <div class="chat-name">Russell</div>
                    </div>
                    <div class="chat-text">Actually everything was fine.
                        <br>I'm very excited to show this to our team.
                    </div>
                    <div class="chat-hour">07:00 <span class="fa fa-check-circle"></span></div>
                </li>
            </ul>
            <div class="form-group mt-3 mb-0">
                <textarea class="form-control" rows="3" placeholder="Type your message here..."></textarea>
            </div>
        </div>
    </div>
@endsection
