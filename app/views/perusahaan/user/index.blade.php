@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Penanggungjawab</h1>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Penanggungjawab</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penanggungjawab</th>
                        <th>Jabatan</th>
                        <th>Username</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->jabatan }}</td>
                            <td>{{ $v->username }}</td>
                            <td>

                                <button class="btn btn-info" data-toggle="modal" data-target="#ModelEdit{{ $v->id }}">Edit</button>
                                @if($v->id != auth()->id())
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete{{ $v->id }}">Hapus</button>
                                @endif

                                <div class="modal fade text-left" id="ModelEdit{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('perusahaan/user/update') }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                                    <div class="form-group">
                                                        <label for="">Nama Penanggungjawab</label>
                                                        <input type="text" name="nama" class="form-control form-control-user"
                                                        placeholder="Nama Penanggungjawab" value="{{ $v->nama }}">
                                                        {{ error('nama') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Jabatan Penanggungjawab</label>
                                                        <input type="text" name="jabatan" class="form-control form-control-user"
                                                        placeholder="Jabatan Penanggungjawab" value="{{ $v->jabatan }}">
                                                        {{ error('jabatan') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Username</label>
                                                        <input type="text" name="username" class="form-control form-control-user"
                                                        placeholder="Username" value="{{ $v->username }}">
                                                        {{ error('username') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" autocomplete="new-password">
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
                                            <form action="{{ base_url('perusahaan/user/destroy') }}" method="post">
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
            <form action="{{ base_url('perusahaan/user/store') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Penanggungjawab</label>
                        <input type="text" name="nama" class="form-control form-control-user"
                        placeholder="Nama Penanggungjawab" value="{{ old('nama') }}">
                        {{ error('nama') }}
                    </div>
                    <div class="form-group">
                        <label for="">Jabatan Penanggungjawab</label>
                        <input type="text" name="jabatan" class="form-control form-control-user"
                        placeholder="Jabatan Penanggungjawab" value="{{ old('jabatan') }}">
                        {{ error('jabatan') }}
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control form-control-user"
                        placeholder="Username" value="{{ old('username') }}">
                        {{ error('username') }}
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" autocomplete="new-password">
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

@endsection
@push('js')
{!! show_modal() !!}
@endpush