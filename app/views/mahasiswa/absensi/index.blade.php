@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

{{-- <div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Absensi PKL</h1>
    </div>
    <div class="col-md-6 text-right">
    </div>
</div> --}}

<!-- DataTales Example -->

@if($detail)


<div class="row">
    <div class="col-md-4">
        <div class="card shadow">
            <img src="{{ thumbnail_lowongan($detail->gambar,$detail->id) }}" alt="" class="card-img-top" width="100%">
            <div class="card-body">
                <div class="mb-2 h5 font-weight-bold text-dark">
                    {{ $detail->posisi }}
                </div>
                <div class="text-md font-weight-bold text-primary text-uppercase mb-2">
                    <i class="fas fa-building"></i> {{ $detail->perusahaan }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-8">

        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="h3 text-gray-800"></h1>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ base_url('mahasiswa/absensi/cetak') }}" target="blank" class="btn btn-danger" id="btn-export">Export PDF</a>
            </div>
        </div>

        {!! alert(['success' => 'success','error' => 'danger']) !!}
        

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="m-0 font-weight-bold text-primary">Absensi PKL</h6>
                    </div>
                    <div class="col-md-6 text-right">
                        @if(!$status_absensi)
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Absen</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Jam Absensi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $v)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $v->kegiatan }}</td>
                                    <td>{{ $v->tanggal }}</td>
                                    <td>
                                        @if($v->status == '0')
                                            <span class="badge badge-warning">Menunggu Dikonfirmasi</span>
                                        @elseif($v->status == '1')
                                            <span class="badge badge-success">Diterima</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="ModalAdd" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Absen</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ base_url('mahasiswa/absensi/store') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {{-- <div class="form-group">
                        <label for="">Jam Absen</label>
                        <h6>{{ date('Y-m-d H:i') }}</h6>
                    </div> --}}
                    <div class="form-group">
                        <label for="">Kegiatan</label>
                        <textarea name="kegiatan" rows="2" class="form-control" required></textarea>
                        {{ error('kegiatan') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        Absen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@else

<div class="alert alert-warning">
    Anda belum diterima atau belum mendaftar pada salah satu perusahaan yang membuka lowongan. <a href="{{ base_url('mahasiswa/lowongan') }}">Klik disini</a> untuk melakukan pendaftaran
</div>

@endif



@endsection