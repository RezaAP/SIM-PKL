@extends('layouts.panel')
@section('content')
<!-- Page Heading -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Data Perusahaan</h1>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{ base_url('koordinator-pkl/cetak/perusahaan') }}" target="blank" class="btn btn-danger" id="btn-export">Export PDF</a>
    </div>
</div>

{!! alert(['success' => 'success','error' => 'danger']) !!}


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary">Perusahaan</h6>
            </div>
            <div class="col-3 ml-auto d-flex align-items-center">
                <span class="mr-2">Filter: </span>
                <select name="status" id="" class="form-control">
                    <option value="">Semua</option>
                    <option value="0">Menunggu Diverifikasi</option>
                    <option value="1">Diverifikasi</option>
                    <option value="2">Ditolak</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered content-datatable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Penanggungjawab</th>
                        <th>Nama Perusahaan</th>
                        <th>Email Perusahaan</th>
                        <th>Tahun Berdiri</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Status</th>
                        <th width="350">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $v)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $v->penanggungjawab }}</td>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->email }}</td>
                            <td>{{ $v->tahun_berdiri }}</td>
                            <td>{{ $v->alamat }}</td>
                            <td>{{ $v->telepon }}</td>
                            <td>
                                @if($v->status == '0')
                                    <span class="badge badge-warning">Menunggu Diverifikasi</span>
                                @elseif($v->status == '1')
                                    <span class="badge badge-success">Diverifikasi</span>
                                @elseif($v->status == '2')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>

                                <button class="btn btn-info" data-toggle="modal" data-target="#ModalDokumen{{ $v->id }}">Detail Dokumen</button>
                                @if($v->status == '0')
                                <button class="btn btn-success" data-toggle="modal" data-target="#ModalVerifikasi{{ $v->id }}">Verifikasi</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#ModalTolak{{ $v->id }}">Tolak</button>
                                @elseif($v->status == '1')
                                {{-- <button class="btn btn-danger" data-toggle="modal" data-target="#ModalBatalVerifikasi{{ $v->id }}">Batal Verifikasi</button> --}}
                                <button class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit{{ $v->id }}">Edit</button>
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
                                                <table class="table table-light">
                                                    <tr>
                                                        <th width="200">Dokumen KTP</th>
                                                        <td> :
                                                            <a href="{{ base_url($v->dokumen_ktp) }}" target="blank">
                                                                @if(get_file_extension($v->dokumen_ktp) != 'pdf')
                                                                    <img src="{{ base_url($v->dokumen_ktp) }}" alt="" width="150">
                                                                @else
                                                                    <img src="{{ base_url('assets/img/pdf.png') }}" alt="" width="40"> dokumen.pdf
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">Dokumen NPWP</th>
                                                        <td> :
                                                            <a href="{{ base_url($v->dokumen_npwp) }}" target="blank">
                                                                @if(get_file_extension($v->dokumen_npwp) != 'pdf')
                                                                    <img src="{{ base_url($v->dokumen_npwp) }}" alt="" width="150">
                                                                @else
                                                                    <img src="{{ base_url('assets/img/pdf.png') }}" alt="" width="40"> dokumen.pdf
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th width="200">Dokumen NIB</th>
                                                        <td> :
                                                            <a href="{{ base_url($v->dokumen_nib) }}" target="blank">
                                                                @if(get_file_extension($v->dokumen_nib) != 'pdf')
                                                                    <img src="{{ base_url($v->dokumen_nib) }}" alt="" width="150">
                                                                @else
                                                                    <img src="{{ base_url('assets/img/pdf.png') }}" alt="" width="40"> dokumen.pdf
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-dismiss="modal">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <form action="{{ base_url('koordinator-pkl/perusahaan/verifikasi') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin memverifikasi data ini?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-success ms-1">
                                                        Verifikasi
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
                                            <form action="{{ base_url('koordinator-pkl/perusahaan/tolak') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin menolak verifikasi data ini?</div>
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
                                <div class="modal fade text-left" id="ModalBatalVerifikasi{{ $v->id }}" tabindex="-1" role="dialog"
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
                                            <form action="{{ base_url('koordinator-pkl/perusahaan/batal_verifikasi') }}" method="post">
                                                <input type="hidden" name="id" value="{{ $v->id }}">
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">Apakah anda yakin ingin membatalkan verifikasi data ini?</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-danger ms-1">
                                                        Batalkan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

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
                                            <form action="{{ base_url('koordinator-pkl/perusahaan/update') }}" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $v->id }}">
                                                    <div class="form-group">
                                                        <label for="">Nama Perusahaan</label>
                                                        <input type="text" name="nama_perusahaan" class="form-control" placeholder="Nama perusahaan" value="{{ $v->nama }}">
                                                        {{ error('nama_perusahaan') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">No. Telepon</label>
                                                        <input type="text" name="telepon" class="form-control" placeholder="No. Telepon" value="{{ $v->telepon }}">
                                                        {{ error('telepon') }}
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $v->email }}">
                                                        {{ error('email') }}
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

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
