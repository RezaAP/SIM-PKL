@extends('layouts.panel')
@section('content')

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Detail Lowongan</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button> --}}
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card shadow h-100">
            <img src="{{ thumbnail_lowongan($data->gambar,$data->id) }}" width="100%" class="card-img-top">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->perusahaan }} - {{ $data->posisi }}</div>
                        <hr>
                        <div class="row">
                            <div class="col md-4">
                                <div class="text-md font-weight-bold text-dark text-uppercase mb-1">
                                    Kuota
                                </div>
                                <div class="text-md text-dark text-uppercase mb-1">
                                    <i class="fas fa-users"></i> {!! $data->kuota == $data->kuota_terisi? "<span class='text-danger'>Kuota Penuh</span>" : " $data->kuota_terisi/$data->kuota Orang" !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-md font-weight-bold text-dark text-uppercase mb-1">
                            Deskripsi
                        </div>
                        <div class="text-md text-dark">
                            {{ $data->deskripsi }}                            
                        </div>
                        <hr>
                        @if ($data->kuota != $data->kuota_terisi)
                            @if($data->status_pengajuan == '0')
                            <a data-toggle="modal" data-target="#ModalDaftar" class="btn btn-primary w-100">
                                Daftar
                            </a>
                            @else
                                <button class="btn btn-light border w-100 disabled" disabled>Sudah Mendaftar</button>
                            @endif
                        @else
                        <div class="alert alert-warning">Mohon Maaf Kuota Sudah Penuh</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="ModalDaftar" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Dokumen Pengajuan</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ base_url('mahasiswa/lowongan/daftar') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    {{-- <div class="form-group">
                        <label for="">Upload Dokumen</label>
                        <div class="custom-file">
                            <input type="file" name="dokumen" class="custom-file-input" id="dokumen-pengajuan" accept=".heic,.jpg,.png,.pdf" required>
                            <label class="custom-file-label" for="dokumen-pengajuan">Pilih Dokumen</label>
                        </div>
                        {{ error('dokumen') }}
                    </div> --}}
                    <div class="alert alert-warning">
                        Apakah anda yakin ingin mendaftar pada perusahaan {{ $data->perusahaan }}?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection