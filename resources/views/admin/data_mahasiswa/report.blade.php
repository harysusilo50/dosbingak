<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Mahasiswa Bimbingan</title>
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
        <h5>Laporan Data Mahasiswa Bimbingan</h4>
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
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($dataMahasiswa as $item)
                <tr>
                    <td class="text-center" style="width:5%">{{ $i++ }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_dosen_pa }}</td>
                    <td>{{ $item->noreg }}</td>
                    <td>{{ $item->angkatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
