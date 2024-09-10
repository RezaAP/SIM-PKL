@extends('layouts.auth')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12 d-flex align-items-center" style="min-height: 680px">
                <div class="p-5 w-100">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Daftar Sebagai Perusahaan!</h1>
                    </div>
                    {!! alert(['success' => 'success','error' => 'danger']) !!}
                    <form class="user" action="" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>Perusahaan</b>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="form-control form-control-user"
                                    placeholder="Nama Perusahaan" value="{{ old('nama_perusahaan') }}">
                                    {{ error('nama_perusahaan') }}
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi Perusahaan</label>
                                    <textarea name="deskripsi_perusahaan" rows="2" class="form-control">{{ old('deskripsi_perusahaan') }}</textarea>
                                    {{ error('deskripsi_perusahaan') }}
                                </div>
                                <div class="form-group">
                                    <label for="">Tahun Berdiri</label>
                                    <input type="number" name="tahun_berdiri_perusahaan" class="form-control form-control-user"
                                    placeholder="Tahun Berdiri" value="{{ old('tahun_berdiri_perusahaan') }}">
                                    {{ error('tahun_berdiri_perusahaan') }}
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email_perusahaan" class="form-control form-control-user"
                                    placeholder="Email Perusahaan" value="{{ old('email_perusahaan') }}">
                                    {{ error('email_perusahaan') }}
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="alamat_perusahaan" rows="2" class="form-control">{{ old('alamat_perusahaan') }}</textarea>
                                    {{ error('alamat_perusahaan') }}
                                </div>
                                <div class="form-group">
                                    <label for="">No Telepon </label>
                                    <input type="text" name="telepon_perusahaan" class="form-control form-control-user" placeholder="No Telepon" value="{{ old('telepon_perusahaan') }}">
                                    {{ error('telepon_perusahaan') }}
                                </div>
                                <div class="form-group">
                                    <b>Dokumen</b>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <b>Akun</b>
                                </div>
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
                                <div class="form-group">
                                    <label for="">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password" class="form-control form-control-user" placeholder="Konfirmasi Password" autocomplete="new-password">
                                    {{ error('konfirmasi_password') }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Dokumen KTP</label>
                                            <div class="custom-file">
                                                <input type="file" name="dokumen_ktp" class="custom-file-input" id="dokumen-ktp" accept=".heic,.jpg,.png,.pdf" required>
                                                <label class="custom-file-label" for="dokumen-ktp">Pilih Dokumen</label>
                                            </div>
                                            {{ error('dokumen_ktp') }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Dokumen NPWP</label>
                                            <div class="custom-file">
                                                <input type="file" name="dokumen_npwp" class="custom-file-input" id="dokumen-npwp" accept=".heic,.jpg,.png,.pdf" required>
                                                <label class="custom-file-label" for="dokumen-npwp">Pilih Dokumen</label>
                                            </div>
                                            {{ error('dokumen_npwptp') }}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Dokumen NIB</label>
                                            <div class="custom-file">
                                                <input type="file" name="dokumen_nib" class="custom-file-input" id="dokumen-nib" accept=".heic,.jpg,.png,.pdf" required>
                                                <label class="custom-file-label" for="dokumen-nib">Pilih Dokumen</label>
                                            </div>
                                            {{ error('dokumen_nib') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        
                        <button class="btn btn-primary btn-user btn-block">
                            Daftar Sekarang
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ base_url('daftar') }}">Sudah mempunyai akun? Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
