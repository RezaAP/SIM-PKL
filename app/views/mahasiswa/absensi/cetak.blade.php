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
                <th>Kegiatan</th>
                <th>Jam Absensi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $v)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $v->kegiatan }}</td>
                    <td>{{ $v->tanggal }}</td>
                    <td>
                        @if($v->status == '0')
                            <span style="padding: 3px 4px;font-size: 11px;color: #fff;background-color: #f6c23e;">Menunggu Dikonfirmasi</span>
                        @elseif($v->status == '1')
                            <span style="padding: 3px 4px;font-size: 11px;color: #fff;background-color: #1cc88a;">Diterima</span>
                        @elseif($v->status == '2')
                        <span style="padding: 3px 4px;font-size: 11px;color: #fff;background-color: #e74a3b;">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>