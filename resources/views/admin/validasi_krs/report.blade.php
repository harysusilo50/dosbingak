<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Persetujuan KRS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Data Persetujuan KRS</h4>
        </h5>
    </center>

    <table class='table table-bordered' width="100%" style="table-layout:fixed;">
        <thead>
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Nama Mahasiswa</th>
                <th class="text-center">Nama Dosen PA</th>
                <th class="text-center">NIM</th>
                <th class="text-center">Angkatan</th>
                <th class="text-center">Semester</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($validasiKrs as $item)
                <tr>
                    <td class="text-center" style="width:5%">{{ $i++ }}</td>
                    <td>{{ $item->mahasiswa->nama }}</td>
                    <td>{{ $item->mahasiswa->nama_dosen_pa }}</td>
                    <td>{{ $item->mahasiswa->noreg }}</td>
                    <td>{{ $item->mahasiswa->angkatan }}</td>
                    <td>{{ $item->semester }}</td>
                    <td class="text-center">
                        @switch($item->status)
                            @case('menunggu')
                                <span class="badge badge-pill badge-warning">Menuggu Persetujuan</span>
                            @break

                            @case('disetujui')
                                <span class="badge badge-pill badge-success">Disetujui</span>
                            @break

                            @case('ditolak')
                                <span class="badge badge-pill badge-danger">Ditolak</span>
                            @break

                            @default
                                <span class="badge badge-pill badge-secondary">{{ $item->status }}</span>
                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
