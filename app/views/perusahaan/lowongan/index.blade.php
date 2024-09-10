@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Lowongan</h1>
    </div>
    <div class="col-md-6 text-right">
        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lowongan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Posisi</th>
                        <th>Deskripsi</th>
                        <th>Dokumen yang dibutuhkan</th>
                        <th>Kuota</th>
                        <th>Kuota Terisi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i => $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td><img src="{{ thumbnail_lowongan($v->gambar,$i) }}" alt="" width="100"></td>
                            <td>{{ $v->posisi }}</td>
                            <td>{{ $v->deskripsi }}</td>
                            <td>{{ $v->deskripsi_dokumen }}</td>
                            <td>{{ $v->kuota }}</td>
                            <td>{{ $v->kuota_terisi }}</td>
                            <td>

                                <button class="btn btn-info" data-toggle="modal" data-target="#ModelEdit{{ $v->id }}">Edit</button>
                                @if($v->kuota_terisi == 0)
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
                                            <form action="{{ base_url('perusahaan/lowongan/update') }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                                    <div class="form-group">
                                                        <label for="">Gambar / Thumbnail <small>(Pilih gambar untuk mengubah gambar sebelumnya)</small></label>
                                                        <div class="custom-file">
                                                            <input type="file" name="gambar" class="custom-file-input" id="dokumen-ktp" accept=".heic,.jpg,.png">
                                                            <label class="custom-file-label" for="dokumen-ktp">Pilih Gambar</label>
                                                        </div>
                                                        {{ error('gambar') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Posisi</label>
                                                        <input type="text" name="posisi" class="form-control" placeholder="Posisi" required value="{{ $v->posisi }}">
                                                        {{ error('posisi') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Deskripsi</label>
                                                        <textarea name="deskripsi" rows="2" class="form-control" placeholder="Deskripsi" required>{{ $v->deskripsi }}</textarea>
                                                        {{ error('deskripsi') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Kuota</label>
                                                        <input type="number" name="kuota" class="form-control" placeholder="Kuota" required value="{{ $v->kuota }}">
                                                        {{ error('kuota') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Dokumen yang dibutuhkan</label>
                                                        <textarea name="deskripsi_dokumen" rows="2" class="form-control" placeholder="- Dokumen 1 .dst" required>{{ $v->deskripsi_dokumen }}</textarea>
                                                        {{ error('deskripsi_dokumen') }}
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
                                            <form action="{{ base_url('perusahaan/lowongan/destroy') }}" method="post">
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
            <form action="{{ base_url('perusahaan/lowongan/store') }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Gambar / Thumbnail</label>
                        <div class="custom-file">
                            <input type="file" name="gambar" class="custom-file-input" id="dokumen-ktp" accept=".heic,.jpg,.png">
                            <label class="custom-file-label" for="dokumen-ktp">Pilih Gambar</label>
                        </div>
                        {{ error('gambar') }}
                    </div>
                    <div class="form-group">
                        <label for="">Posisi</label>
                        <input type="text" name="posisi" class="form-control" placeholder="Posisi" required value="{{ old('posisi') }}">
                        {{ error('posisi') }}
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi</label>
                        <textarea name="deskripsi" rows="2" class="form-control" placeholder="Deskripsi" required>{{ old('deskripsi') }}</textarea>
                        {{ error('deskripsi') }}
                    </div>
                    <div class="form-group">
                        <label for="">Kuota</label>
                        <input type="number" name="kuota" class="form-control" placeholder="Kuota" required value="{{ old('kuota') }}">
                        {{ error('kuota') }}
                    </div>
                    <div class="form-group">
                        <label for="">Dokumen yang dibutuhkan</label>
                        <textarea name="deskripsi_dokumen" rows="2" class="form-control" placeholder="- Dokumen 1 .dst" required>{{ old('deskripsi_dokumen') }}</textarea>
                        {{ error('deskripsi_dokumen') }}
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