<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $judul }}</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>
<body>

    <h5 style="text-align: center;font-size: 2em">{{ $judul }}</h5>

    <table border="0" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Posisi</th>
                <th>Deskripsi</th>
                <th>Kuota</th>
                <th>Kuota Terisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $v)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <th>{{ $v->nama_perusahaan }}</th>
                    {{-- <td><img src="{{ thumbnail_lowongan($v->gambar,$v->id,true) }}" alt="" width="40px"></td> --}}
                    <td>{{ $v->posisi }}</td>
                    <td>{{ $v->deskripsi }}</td>
                    <td>{{ $v->kuota }}</td>
                    <td>{{ $v->kuota_terisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>