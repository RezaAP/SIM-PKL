@extends('layouts.panel')
@section('content')

@if($detail)

<!-- Page Heading -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Bimbingan PKL</h1>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalAdd">Ajukan Bimbingan</button>
        <a href="{{ base_url('mahasiswa/bimbingan/cetak') }}" target="blank" class="btn btn-danger" id="btn-export">Export PDF</a>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bimbingan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Pengajuan</th>
                        {{-- <th>Catatan Dosen</th> --}}
                        <th>Status</th>
                        <th width="350">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_pembimbing }}</td>
                            <td>{{ $v->catatan_mahasiswa }}</td>
                            <td>{{ date('d-m-Y H:i',strtotime($v->tanggal_pengajuan)) }}</td>
                            {{-- <td class="{{ $v->status == '2'? 'text-danger' : '' }}">{{ $v->catatan_dosen }}</td> --}}
                            <td>
                                @if($v->status == '0')
                                    <span class="badge badge-warning">Proses Pengajuan</span>
                                @elseif($v->status == '1')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif($v->status == '2')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>

                                @if($v->status == '0')
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalBatal{{ $v->id }}">Batal</button>
                                @endif

                                <div class="modal fade text-left" id="ModalBatal{{ $v->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">Konfirmasi</h5>
                                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ base_url('mahasiswa/bimbingan/batal') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin mambatalkan pengajuan bimbingan ini?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="submit" class="btn btn-danger ms-1">
                                                        Batalkan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade text-left" id="ModalAdd" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Pengajuan Bimbingan</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ base_url('mahasiswa/bimbingan/store') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Pembimbing</label>
                        <h6 class="text-primary">{{ $pembimbing->nama_pembimbing }}</h6>
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Tanggal Pengajuan</label>
                        <input type="datetime-local" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan') }}">
                        {{ error('tanggal_pengajuan') }}
                    </div> --}}
                    <div class="form-group">
                        <label for="">Kegiatan</label>
                        <textarea name="kegiatan" rows="2" class="form-control" required>{{ old('kegiatan') }}</textarea>
                        {{ error('kegiatan') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        Ajukan
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
