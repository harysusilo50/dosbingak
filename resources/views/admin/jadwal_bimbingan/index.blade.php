@extends('layout.app')
@section('title', 'Jadwal Konsultasi')
@section('content')

    <div class="card mb-4" style="border-radius: 10px">
        <div class="card-body">
            <form action="{{ route('jadwal-bimbingan.index') }}" method="GET">
                <div class="form-group mb-3 row col-12">
                    <label class="col-form-label text-dark col-lg-3" for="nama_dosen_pa" style="font-weight: 500">Nama Dosen
                        PA</label>
                    <div class=" col-lg-6 input-group">
                        <select id="nama_dosen_pa" name="nama_dosen_pa" class="form-control" required>
                            <option value="" selected>- Pilih Dosen Pembimbing -</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}" {{ $selected_dosen == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn" type="submit" style="background: #0CB7C2">
                                <i class="fas fa-fw fa-search text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="form-group text-lg-right">
                <a href="{{ route('jadwal-bimbingan.create', ['id_dosen' => $selected_dosen]) }}"
                    class="btn text-white btn-sm" style="background: #0CB7C2">
                    <i class="fas fa-pencil-alt"></i> Edit</a>
            </div>
        </div>
    </div>

    <div class="card mb-4" style="border-radius: 10px">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"
            style="border-radius: 10px 10px 0px 0px">
            <h6 class="m-0 font-weight-bold text-muted"><i class="fas fa-calendar-alt mr-1"></i> Jadwal Konsultasi</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js"></script>
    <script>
        var jadwal = '{!! json_encode($result) !!}';
        const jsonJadwal = JSON.parse(jadwal);
        console.log(jsonJadwal);
        
        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById("calendar");
            var calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: 'bootstrap',
                initialView: "timeGridWeek",
                locale: "id",
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    omitZeroMinute: false,
                },
                headerToolbar: {
                    start: 'dayGridMonth,timeGridWeek,timeGridDay',
                    center: 'title',
                    end: 'prev,next'
                },
                titleFormat: {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                },
                dayHeaderFormat: {
                    weekday: 'long',
                    // month: 'long',
                    // day: 'numeric',
                    omitCommas: false
                },
                weekends: false,
                events: jsonJadwal
                ,
            });
            calendar.render();
        });
    </script>
@endsection
