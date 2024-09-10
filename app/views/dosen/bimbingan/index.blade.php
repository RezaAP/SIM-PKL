@extends('layouts.panel')
@section('content')
<!-- Page Heading -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Bimbingan PKL</h1>
    </div>
    <div class="col-md-6 text-right">
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
                        <th>Nama Mahasiswa</th>
                        <th>Kegiatan</th>
                        <th>Tanggal Pengajuan</th>
                        {{-- <th>Catatan Saya</th> --}}
                        <th>Status</th>
                        <th width="350">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_mahasiswa }}</td>
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
                                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#ModalTerima{{ $v->id }}">Terima</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalTolak{{ $v->id }}">Tolak</button>
                                @endif

                                <div class="modal fade text-left" id="ModalTolak{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('dosen/bimbingan/tolak') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin menolak pengajuan bimbingan ini?</div>
                                                    {{-- <div class="form-group">
                                                        <label for="">Alasan</label>
                                                        <textarea name="alasan" id="" rows="2" class="form-control" required></textarea>
                                                        {{ error('alasan') }}
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="submit" class="btn btn-danger ms-1">
                                                        Tolak
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal fade text-left" id="ModalTerima{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('dosen/bimbingan/terima') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin menerima pengajuan bimbingan ini?</div>
                                                    {{-- <div class="form-group">
                                                        <label for="">Catatan</label>
                                                        <textarea name="catatan" id="" rows="2" class="form-control"></textarea>
                                                        {{ error('catatan') }}
                                                    </div> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="submit" class="btn btn-success ms-1">
                                                        Terima
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
                    <div class="form-group">
                        <label for="">Tanggal Pengajuan</label>
                        <input type="datetime-local" name="tanggal_pengajuan" class="form-control" value="{{ old('tanggal_pengajuan') }}">
                        {{ error('tanggal_pengajuan') }}
                    </div>
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


@endsection
