@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Mahasiswa Terdaftar</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalAdd">Tambah</button>
        <button class="btn btn-success mr-2" data-toggle="modal" data-target="#ModalImport">Import</button> --}}
        <a href="{{ base_url('koordinator-pkl/cetak/mahasiswa') }}" target="blank" class="btn btn-danger" id="btn-export">Export PDF</a>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="col-md-6">
            <h6 class="m-0 font-weight-bold text-primary">Mahasiswa</h6>
        </div>
        {{-- <div class="col-3 ml-auto d-flex align-items-center">
            <span class="mr-2">Filter: </span>
            <select name="status" id="" class="form-control">
                <option value="">Semua</option>
                    <option value="-">Belum Mengajukan</option>
                    <option value="0">Dalam proses pengajuan</option>
                    <option value="1">Diterima</option>
                    <option value="2">Ditolak</option>
            </select>
        </div> --}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        {{-- <th>Pembimbing</th> --}}
                        <th>Prodi</th>
                        <th>Tahun</th>
                        <th>Username</th>
                        {{-- <th>Nilai Dosen</th>
                        <th>Nilai Perusahaan</th> --}}
                        <th>Status Aktif</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_mahasiswa }}</td>
                            <td>{{ $v->nim_mahasiswa }}</td>
                            {{-- <td>{!! $v->nama_pembimbing? $v->nama_pembimbing : '<small class="text-muted">Belum ada pembimbing</small>' !!}</td> --}}
                            <td>{{ $v->jurusan_mahasiswa }}</td>
                            <td>{{ $v->tahun_mahasiswa }}</td>
                            <td>{{ $v->username_mahasiswa }}</td>
                            {{-- <td>{{ $v->nilai? $v->nilai : 0 }}</td>
                            <td>{{ $v->nilai_perusahaan? $v->nilai_perusahaan : 0 }}</td> --}}
                            <td>
                                @if($v->status_pengajuan == 1 && count($v->laporan_akhir))
                                <span class="badge badge-success">Sudah PKL</span>
                                @elseif($v->status_pengajuan == 1 && count($v->laporan_akhir) == 0)
                                <span class="badge badge-warning">Sedang Melaksanakan PKL</span>
                                @else
                                <span class="badge badge-danger">Belum Melaksanakan PKL</span>
                                @endif
                            </td>
                            <td>

                                <button class="btn btn-info" data-toggle="modal" data-target="#ModelEdit{{ $v->user_id }}">Edit</button>
                                @if($v->status_pengajuan == null)
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{ $v->id }}">Hapus</button>
                                @endif

                                <div class="modal fade text-left" id="ModelEdit{{ $v->user_id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel1">Edit Data</h5>
                                                <button type="button" class="close rounded-pill" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ base_url('koordinator-pkl/mahasiswa/update') }}" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $v->user_id }}">
                                                    {{-- <div class="form-group">
                                                        <label for="">Dosen Pembimbing</label>
                                                        <select name="pembimbing" id="" class="form-control">
                                                            <option value="">-- Pilih Dosen Pembimbing --</option>
                                                            @foreach($pembimbing as $p)
                                                            <option value="{{ $p->id }}" {{ $v->dosen_id == $p->id? 'selected' : '' }}>{{ $p->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{ error('pembimbing') }}
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="">Nama</label>
                                                        <input type="text" name="nama" class="form-control" placeholder="Nama" required value="{{ $v->nama_mahasiswa }}">
                                                        {{ error('nama') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">NIM</label>
                                                        <input type="text" name="nim" class="form-control" placeholder="NIM" required value="{{ $v->nim_mahasiswa }}">
                                                        {{ error('nim') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Prodi</label>
                                                        <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required value="{{ $v->jurusan_mahasiswa }}">
                                                        {{ error('jurusan') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Username</label>
                                                        <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ $v->username_mahasiswa }}">
                                                        {{ error('username') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password <small>(Isi untuk mengubah)</small></label>
                                                        <input type="password" name="password" class="form-control" placeholder="******" autocomplete="new-password">
                                                        {{ error('password') }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ms-1">
                                                        Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

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
                                            <form action="{{ base_url('koordinator-pkl/mahasiswa/destroy') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->user_id }}">
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
{{-- 
<div class="modal fade text-left" id="ModalAdd" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Tambah Data</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ base_url('koordinator-pkl/mahasiswa/store') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Dosen Pembimbing</label>
                        <select name="pembimbing" id="" class="form-control">
                            <option value="">-- Pilih Dosen Pembimbing --</option>
                            @foreach($pembimbing as $p)
                            <option value="{{ $p->id }}" {{ old('pembimbing') == $p->id? 'selected' : '' }}>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        {{ error('pembimbing') }}
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required value="{{ old('nama') }}">
                        {{ error('nama') }}
                    </div>
                    <div class="form-group">
                        <label for="">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="NIM" required value="{{ old('nim') }}">
                        {{ error('nim') }}
                    </div>
                    <div class="form-group">
                        <label for="">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" required value="{{ old('jurusan') }}">
                        {{ error('jurusan') }}
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ old('username') }}">
                        {{ error('username') }}
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="******" autocomplete="new-password" required>
                        {{ error('password') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="ModalImport" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Import Data</h5>
                <button type="button" class="close rounded-pill" data-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ base_url('koordinator-pkl/mahasiswa/import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <h5><b>1.</b> Download template import data</h5>
                        <a href="{{ base_url('koordinator-pkl/mahasiswa/template_import') }}" class="btn bg-white border">Download Template</a>
                    </div>
                    <div class="mb-3">
                        <h5><b>2.</b> Upload file import data yang telah diisi </h5>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file" id="fileimport" required>
                            <label class="custom-file-label" for="fileimport">Pilih File</label>
                          </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary ms-1">
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

@endsection
@push('js')
{!! show_modal() !!}
@endpush