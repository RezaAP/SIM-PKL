@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Riwayat Pengajuan PKL</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ base_url('mahasiswa/lowongan') }}" class="btn btn-primary">Cari Lowongan</a>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Pengajuan PKL</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->perusahaan }}</td>
                            <td>{{ $v->posisi }}</td>
                            <td>
                                @if($v->status == '0')
                                    <span class="badge badge-warning">Menunggu Dikonfirmasi</span>
                                @elseif($v->status == '1')
                                    <span class="badge badge-success">Diterima</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                @if(count($v->dokumen) ==  0)
                                <button class="btn btn-info" data-toggle="modal" data-target="#ModalDokumen{{ $v->id }}">Upload Dokumen Pendukung</button>
                                @else
                                <button class="btn btn-info" data-toggle="modal" data-target="#ModalViewDokumen{{ $v->id }}">Lihat Dokumen</button>
                                @endif

                                <div class="modal fade text-left" id="ModalDokumen{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('mahasiswa/riwayat/upload_dokumen') }}" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Dokumen yang dibutuhkan</label>
                                                        <p class="h6">{{ $v->deskripsi_dokumen }}</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Upload Dokumen</label>
														<small class="text-muted">
                                                            Dapat memilih lebih dari 1 file
                                                        </small>
                                                        <div class="custom-file">
                                                            <input type="file" name="dokumen[]" class="custom-file-input" id="dokumen-pengajuan" accept=".pdf" multiple required>
                                                            <label class="custom-file-label" for="dokumen-pengajuan">Pilih Dokumen</label>
                                                        </div>
                                                        <small class="text-muted">
                                                            File harus berformat: .pdf, dan maksimal ukuran file 8mb
                                                        </small>
                                                        {{ error('dokumen[]') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="submit" class="btn btn-warning ms-1">
                                                        Upload
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade text-left" id="ModalViewDokumen{{ $v->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">View Dokumen</h5>
                                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @if(count($v->dokumen))
                                                    <ul>
                                                        @foreach ($v->dokumen as $doc)
                                                            <li class="mb-3">
                                                                <a href="{{ base_url($doc->dokumen) }}" target="blank">
                                                                    @if(get_file_extension($doc->dokumen) != 'pdf')
                                                                        <img src="{{ base_url($doc->dokumen) }}" alt="" width="150">
                                                                    @else
                                                                        <img src="{{ base_url('assets/img/pdf.png') }}" alt="" width="40"> {{ $doc->nama_dokumen }}
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
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

@endsection
