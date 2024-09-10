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
                <th>NIP</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $v)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $v->nip }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>{{ $v->no_telepon }}</td>
                    <td>{{ $v->username }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>