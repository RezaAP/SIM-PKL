@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Penilaian Akhir Mahasiswa</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button> --}}
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Mahasiswa PKL</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Tahun</th>
                        <th>Nama Pembimbing</th>
                        <th>Nama Perusahaan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_mahasiswa }}</td>
                            <td>{{ $v->nim_mahasiswa }}</td>
                            <td>{{ $v->tahun_mahasiswa }}</td>
                            <td>{{ $v->nama_dosen }}</td>
                            <td>{{ $v->perusahaan }}</td>
                            <td>
                                @if(count($v->laporan_akhir))
                                <span class="badge badge-success">Sudah Upload</span>
                                @else
                                <span class="badge badge-warning">Belum Upload</span>
                                @endif
                            </td>
                            <td>
                                
                                @if(count($v->laporan_akhir))
                                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalDokumen{{ $v->id }}">Lihat Dokumen</button>
                                @endif

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
                                            <div class="modal-body">
                                                @if(count($v->laporan_akhir))
                                                <table class="table">
                                                    @foreach ($v->laporan_akhir as $doc)
                                                    <tr>
                                                        <th>
                                                            @if(get_file_extension($doc->dokumen) != 'pdf')
                                                                <img src="{{ base_url($doc->dokumen) }}" alt="" width="150">
                                                            @else
                                                                <img src="{{ base_url('assets/img/pdf.png') }}" alt="" width="40"> {{ $doc->nama_dokumen }}
                                                            @endif
                                                        </th>
                                                        <td>
                                                            <a href="{{ base_url($doc->dokumen) }}" target="blank" class="btn btn-info mr-2">Lihat</a>
                                                            <a href="{{ base_url($doc->dokumen) }}" download="{{ $doc->nama_dokumen }}" class="btn btn-success">Download</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
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