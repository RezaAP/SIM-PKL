@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Pengajuan PKL</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button> --}}
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengajuan PKL</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Tahun</th>
                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th width="300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_mahasiswa }}</td>
                            <td>{{ $v->nim_mahasiswa }}</td>
                            <td>{{ $v->jurusan_mahasiswa }}</td>
                            <td>{{ $v->tahun_mahasiswa }}</td>
                            <td>{{ $v->posisi }}</td>
                            <td>{{ $v->deskripsi }}</td>
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

                                <button class="btn btn-info" data-toggle="modal" data-target="#ModalDokumen{{ $v->id }}">Lihat Dokumen</button>
                                @if($v->status == '0')
                                <button class="btn btn-success" data-toggle="modal" data-target="#ModalVerifikasi{{ $v->id }}">Terima</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalTolak{{ $v->id }}">Tolak</button>
                                @endif

                                <div class="modal fade text-left" id="ModalVerifikasi{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('perusahaan/pengajuan/terima') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin menerima pengajuan ini?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-success ms-1">
                                                        Terima
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                            <form action="{{ base_url('perusahaan/pengajuan/tolak') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin menolak pengajuan ini?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger ms-1">
                                                        Tolak
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="ModalDokumen{{ $v->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">Dokumen</h5>
                                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ base_url('perusahaan/pengajuan/tolak') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
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

@endsection