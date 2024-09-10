@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Dosen</h1>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#ModalAdd">Tambah</button>
        <button class="btn btn-success mr-2" data-toggle="modal" data-target="#ModalImport">Import</button>
        <a href="{{ base_url('koordinator-pkl/cetak/dosen') }}" target="blank" class="btn btn-danger">Export PDF</a>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dosen</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>No Telepon</th>
                        <th>Username</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->nip }}</td>
                            <td>{{ $v->no_telepon }}</td>
                            <td>{{ $v->username }}</td>
                            <td>

                                <button class="btn btn-info" data-toggle="modal" data-target="#ModalEdit{{ $v->id }}">Edit</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{ $v->id }}">Hapus</button>

                                <div class="modal fade text-left" id="ModalEdit{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('koordinator-pkl/dosen/update') }}" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                                    <div class="form-group">
                                                        <label for="">NIP</label>
                                                        <input type="text" name="nip" class="form-control" placeholder="NIP" required value="{{ $v->nip }}">
                                                        {{ error('nip') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nama</label>
                                                        <input type="text" name="nama" class="form-control" placeholder="Nama" required value="{{ $v->nama }}">
                                                        {{ error('nama') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">No. Telepon</label>
                                                        <input type="text" name="no_telepon" class="form-control" placeholder="No. Telepon" required value="{{ $v->no_telepon }}">
                                                        {{ error('no_telepon') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Username</label>
                                                        <input type="text" name="username" class="form-control" placeholder="Username" required value="{{ $v->username }}">
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
                                            <form action="{{ base_url('koordinator-pkl/dosen/destroy') }}" method="post">
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
            <form action="{{ base_url('koordinator-pkl/dosen/store') }}" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">NIP</label>
                        <input type="text" name="nip" class="form-control" placeholder="NIP" required value="{{ old('nip') }}">
                        {{ error('nip') }}
                    </div>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required value="{{ old('nama') }}">
                        {{ error('nama') }}
                    </div>
                    <div class="form-group">
                        <label for="">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="No. Telepon" required value="{{ old('no_telepon') }}">
                        {{ error('no_telepon') }}
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
            <form action="{{ base_url('koordinator-pkl/dosen/import') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <h5><b>1.</b> Download template import data</h5>
                        <a href="{{ base_url('koordinator-pkl/dosen/template_import') }}" class="btn bg-white border">Download Template</a>
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