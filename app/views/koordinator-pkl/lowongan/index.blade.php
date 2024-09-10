@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Lowongan</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button> --}}
        <a href="{{ base_url('koordinator-pkl/cetak/lowongan') }}" target="blank" class="btn btn-danger">Export PDF</a>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lowongan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Perusahaan</th>
                        <th>Gambar</th>
                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Kuota</th>
                        <th>Kuota Terisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_perusahaan }}</td>
                            <td><img src="{{ thumbnail_lowongan($v->gambar,$i) }}" alt="" width="100"></td>
                            <td>{{ $v->posisi }}</td>
                            <td>{{ $v->deskripsi }}</td>
                            <td>{{ $v->kuota }}</td>
                            <td>{{ $v->kuota_terisi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection