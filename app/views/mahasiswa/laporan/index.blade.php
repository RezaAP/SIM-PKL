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


{!! alert(['success' => 'success','error' => 'danger']) !!}

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Laporan PKL</h6>
            </div>
            <div class="col-md-6 text-right">
                {{-- @if(!$data) --}}
                <a href="{{ base_url('mahasiswa/laporan/unduh_template') }}" class="btn btn-success">Download Format Penilaian</a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalUploadLaporan">Upload Laporan PKL</button>
                {{-- @endif --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>File Laporan</th>
                        <th>Tanggal Laporan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                    <tr>
                        <th>1.</th>
                        <td>
                            <a href="{{ base_url($v->dokumen) }}" target="blank">
                                @if(get_file_extension($v->dokumen) != 'pdf')
                                    <img src="{{ base_url($v->dokumen) }}" alt="" width="150">
                                @else
                                    <img src="{{ base_url('assets/img/pdf.png') }}" alt="" width="40"> {{ $v->nama_dokumen }}
                                @endif
                            </a>
                        </td>
                        <td>{{ $v->created_at }}</td>
                        <td>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{ $v->id }}">Hapus</button>

                            <div class="modal fade text-left" id="ModalDelete{{ $v->id }}" tabindex="-1" role="dialog"
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
                                        <form action="{{ base_url('mahasiswa/laporan/destroy') }}" method="post">
                                            <input type="hidden" name="id" value="{{ $v->id }}">
                                            <div class="modal-body">
                                                <div class="alert alert-warning">Apakah anda yakin ingin menghapus data ini?</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-danger ms-1">
                                                    Hapus
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

<div class="modal fade text-left" id="ModalUploadLaporan" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Upload Laporan PKL</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ base_url('mahasiswa/laporan/upload') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $detail->pembimbing_id }}">
                    <div class="form-group">
                        <label for="">Upload Dokumen</label>
                        <div class="custom-file">
                            <input type="file" name="file[]" class="custom-file-input" id="dokumen-laporan-akhir" accept=".pdf" required multiple>
                            <label class="custom-file-label" for="dokumen-laporan-akhir">Pilih Dokumen</label>
                        </div>
                        <small class="text-muted">
                            File harus berformat: .pdf, dan maksimal ukuran file 8mb
                        </small>
                        {{ error('file[]') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        Submit
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