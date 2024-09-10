@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Pendaftaran Mahasiswa</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalAdd">Tambah</button>
        <button class="btn btn-success mr-2" data-toggle="modal" data-target="#ModalImport">Import</button> --}}
        {{-- <a href="{{ base_url('koordinator-pkl/cetak/mahasiswa') }}" target="blank" class="btn btn-danger" id="btn-export">Export PDF</a> --}}
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<div class="card shadow">
    <div class="card-body">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalAdd">Tambah</button>
        <button class="btn btn-success mr-2" data-toggle="modal" data-target="#ModalImport">Import</button>
    </div>
</div>

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
                    {{-- <div class="form-group">
                        <label for="">Dosen Pembimbing</label>
                        <select name="pembimbing" id="" class="form-control">
                            <option value="">-- Pilih Dosen Pembimbing --</option>
                            @foreach($pembimbing as $p)
                            <option value="{{ $p->id }}" {{ old('pembimbing') == $p->id? 'selected' : '' }}>{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        {{ error('pembimbing') }}
                    </div> --}}
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
                        <label for="">Prodi</label>
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
                        <small class="text-muted">
                            File harus berformat: .xlsx, dan maksimal ukuran file 8mb
                        </small>
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
</div>

@endsection
@push('js')
{!! show_modal() !!}
@endpush