@extends('layout.app')
@section('title', 'Konsultasi Bimbingan Akademik')
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

        .selected-user {
            width: 100%;
            padding: 0 15px;
            min-height: 64px;
            line-height: 64px;
            border-bottom: 1px solid #5a5c69;
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

        .chat-container li .chat-text-dosen {
            padding: .4rem 1rem;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            background: #dddaff;
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

        .chat-container li .chat-text-dosen:before {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            top: 10px;
            left: -20px;
            border: 10px solid;
            border-color: transparent #dddaff transparent transparent;
        }

        .chat-container li.chat-right>.chat-text {
            text-align: right;
        }

        .chat-container li.chat-right>.chat-text:before {
            right: -20px;
            border-color: transparent transparent transparent #ffffff;
            left: inherit;
        }

        .chat-container li.chat-right>.chat-text-dosen {
            text-align: right;
        }

        .chat-container li.chat-right>.chat-text-dosen:before {
            right: -20px;
            border-color: transparent transparent transparent #dddaff;
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

            .chat-container li .chat-text-dosen {
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
    </style>
@endsection
@section('content')
    <div class="row">
        <div class=" col-12 col-lg-4">
            <div class="card mb-4" style="border-radius: 10px">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between"style="border-radius: 10px 10px 0px 0px">
                    <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-chalkboard-teacher mr-1"></i> Bimbingan
                        Akademik
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td>Mahasiswa</td>
                                <td>{{ $konsultasi->mahasiswa->nama }}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td>{{ $konsultasi->mahasiswa->noreg }}</td>
                            </tr>
                            <tr>
                                <td>Dosen PA</td>
                                <td>{{ $konsultasi->mahasiswa->nama_dosen_pa }}</td>
                            </tr>
                            <tr>
                                <td>Topik</td>
                                <td>{{ $konsultasi->topik }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>{{ $konsultasi->format_tgl_konsultasi }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @switch($konsultasi->status)
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
                            </tr>
                        </table>
                    </div>
                    @if ($konsultasi->status != 'selesai' && $konsultasi->status != 'ditolak')
                        <div class="d-flex justify-content-center text-center">
                            <a href="{{ route('admin.bimbingan-akademik.selesai', $konsultasi->id) }}"
                                class="btn btn-success btn-sm">Selesaikan Bimbingan</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="selected-user">
                    <span>To: <span class="name">{{ $konsultasi->mahasiswa->nama }}</span></span>
                </div>
                <div class="chat-container vh-100 overflow-auto" id="chat-container"
                    style="background-size: contain;background-image:url({{ url('img/bg-chat.jpg') }})">
                    <ul class="chat-box" id="chat-box">
                        @php
                            $tgl_chat = [];
                        @endphp
                        @foreach ($konsultasi->konsultasi_bimbingan_akademik as $chat)
                            @if (!in_array($chat->format_tgl_chat, $tgl_chat))
                                @php
                                    $tgl_chat[] = $chat->format_tgl_chat;
                                @endphp
                                <div class="text-center mb-3">
                                    <span class="badge badge-pill badge-primary">{{ $chat->format_tgl_chat }}</span>
                                </div>
                            @endif
                            @if ($konsultasi->mahasiswa->id == $chat->user_id)
                                <li class="chat-left konsul" id="konsul_{{ $chat->id }}">
                                    <div class="chat-avatar">
                                        <img
                                            src="{{ $konsultasi->mahasiswa->profile_pic ? asset($konsultasi->mahasiswa->profile_pic) : asset('img/user.png') }}">
                                        <div class="chat-name text-white text-wrap text-left">
                                            {{ $konsultasi->mahasiswa->format_nama_chat }}</div>
                                    </div>
                                    <div class="chat-text">{{ $chat->pesan }}
                                    </div>
                                    <div class="chat-hour text-white">{{ $chat->format_jam_chat }}</div>
                                </li>
                            @elseif (App\Models\User::where('id', $chat->user_id)->value('role') == 'admin')
                                <li class="chat-right konsul" id="konsul_{{ $chat->id }}">
                                    <div class="chat-hour text-white">{{ $chat->format_jam_chat }}</div>
                                    <div class="chat-text-dosen">{{ $chat->pesan }}
                                    </div>
                                    <div class="chat-avatar">
                                        <img src="{{ asset('img/admin.png') }}">
                                        <div class="chat-name text-white text-wrap text-right">
                                            Admin</div>
                                    </div>
                                </li>
                            @else
                                <li class="chat-right konsul" id="konsul_{{ $chat->id }}">
                                    <div class="chat-hour text-white">{{ $chat->format_jam_chat }}</div>
                                    <div class="chat-text-dosen">{{ $chat->pesan }}
                                    </div>
                                    <div class="chat-avatar">
                                        <img
                                            src="{{ $konsultasi->dosen->profile_pic ? asset($konsultasi->dosen->profile_pic) : asset('img/dosen.png') }}">
                                        <div class="chat-name text-white text-wrap text-right">
                                            {{ $konsultasi->dosen->format_nama_chat }}</div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @if ($konsultasi->status != 'selesai' && $konsultasi->status != 'ditolak')
                    <form action="{{ route('admin.konsultasi-bimbingan-akademik.store') }}" method="POST">
                        @csrf
                        <div class="card-footer">
                            <div class="row mt-3 mb-0">
                                <input type="number" name="bimbingan_id" class="d-none" value="{{ $konsultasi->id }}">
                                <textarea class="form-control col-10 col-lg-11" rows="3" name="pesan" placeholder="Type your message here..."></textarea>
                                <div class="col-2 col-lg-1 mx-auto px-1 text-center">
                                    <button class="btn btn-primary text-center" type="submit">
                                        <i class="fas fa-fw fa-paper-plane m-auto"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#chat-container').animate({
                scrollTop: $('#chat-container')[0].scrollHeight
            }, 1000);

            function getUrl() {
                $.ajax({
                    url: "{{ route('admin.konsultasi-bimbingan-akademik.get_latest_chat') }}",
                    data: {
                        bimbingan_id: "{{ $konsultasi->id }}"
                    },
                    type: 'GET',
                    success: function(data) {
                        var konsulElements = $('.konsul');
                        if (konsulElements.last().attr('id') != `konsul_${data.id}`) {
                            var audio = new Audio("{{ asset('img/notif.mp3') }}");
                            audio.autoplay = true;
                            audio.play();
                            $('#chat-container').animate({
                                scrollTop: $('#chat-container')[0].scrollHeight
                            }, 1000);
                            var image = "";
                            if (data.profile_pic) {
                                var tempProfile = data.profile_pic
                                image = "{{ url('/') }}" + "public/" + tempProfile
                            } else {
                                if (data.role == 'dosen') {
                                    image = "{{ asset('img/dosen.png') }}"
                                } else if (data.role == 'admin') {
                                    image = "{{ asset('img/admin.png') }}"
                                } else {
                                    image = "{{ asset('img/user.png') }}"
                                }
                            }
                            var leftRight = ""
                            if (data.role != "user") {
                                leftRight = "chat-right"
                            } else {
                                leftRight = "chat-left"
                            }
                            if (data.role != "user") {
                                var pesan = `
                              <li class="chat-right konsul" id="konsul_${data.id}">
                                    <div class="chat-hour text-white">${data.format_jam_chat}</div>
                                    <div class="chat-text-dosen">${data.pesan}
                                    </div>
                                    <div class="chat-avatar">
                                        <img src="${image}">
                                        <div class="chat-name text-white text-wrap text-right">
                                        ${data.nama}</div>
                                    </div>
                                </li>
                            `;
                            } else {
                                var pesan = `
                            <li class="chat-left konsul" id="konsul_${data.id}">
                            <div class="chat-avatar">
                                <img src="${image}">
                                <div class="chat-name text-white text-wrap text-right">
                                ${data.nama}</div>
                            </div>
                            <div class="chat-text">${data.pesan}
                            </div>
                            <div class="chat-hour text-white">${data.format_jam_chat}</div>
                                </li>
                            `;
                            }
                            $('.chat-box').append(pesan)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            setInterval(getUrl, 5000);

        });
    </script>
@endsection
