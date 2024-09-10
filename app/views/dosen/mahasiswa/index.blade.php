@extends('layouts.panel')
@section('content')
<!-- Page Heading -->

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Mahasiswa</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button> --}}
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Mahasiswa</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>NIM</th>
                        <th>Tahun</th>
                        <th>Status Diterima</th>
                        <th>Nama Perusahaan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->nama_mahasiswa }}</td>
                            <td>{{ $v->jurusan_mahasiswa }}</td>
                            <td>{{ $v->nim_mahasiswa }}</td>
                            <td>{{ $v->tahun_mahasiswa }}</td>
                            <td>
                                @if($v->status_pengajuan == null)
                                    <span class="badge badge-light">Belum mengajukan</span>
                                @elseif($v->status_pengajuan == '0')
                                    <span class="badge badge-warning">Dalam proses pengajuan</span>
                                @elseif($v->status_pengajuan == '1')
                                    <span class="badge badge-success">Diterima</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                {{ $v->status_pengajuan == '1' ? $v->perusahaan : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <div class="modal fade text-left" id="ModalAdd" tabindex="-1" role="dialog"
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
            <form action="{{ base_url('dosen/mahasiswa/store') }}" method="post">
                <div class="modal-body">
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
</div> --}}

@endsection
@push('js')
{!! show_modal() !!}
@endpush