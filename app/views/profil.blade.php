@extends('layouts.panel')
@section('content')
{!! alert(['success' => 'success','error' => 'danger']) !!}

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form action="" method="post">
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="username">Username</label>
                        <input class="form-control" id="username" type="text" value="{{ $data->username }}" disabled>
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">Nama Lengkap</label>
                            <input class="form-control" id="inputFirstName" name="nama" type="text" placeholder="Nama Lengkap" value="{{ $data->nama }}">
                            {{ error('nama') }}
                        </div>
                        <!-- Form Group (last name)-->
                        @if(auth()->user()->role_id == '3')
                        <div class="col-md-6">
                            <label class="small mb-1" for="nip">No Telepon</label>
                            <input class="form-control" name="no_telepon" type="text" placeholder="No Telepon" value="{{ $data->no_telepon }}">
                            {{ error('no_telepon') }}
                        </div>
                        @endif
                        {{-- @if(auth()->user()->role_id == '3')
                        <div class="col-md-6">
                            <label class="small mb-1" for="nip">NIP</label>
                            <input class="form-control" id="nip" type="text" name="nip" placeholder="NIP" value="{{ $data->nip }}">
                            {{ error('nip') }}
                        </div>
                        @endif
                        @if(auth()->user()->role_id == '4')
                        <div class="col-md-6">
                            <label class="small mb-1" for="nim">NIM</label>
                            <input class="form-control" id="nim" type="text" name="nim" placeholder="NIM" value="{{ $data->nim }}">
                            {{ error('nim') }}
                        </div>
                        @endif --}}
                    </div>
                    <!-- Form Row        -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (organization name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="new-password">Password Baru</label>
                            <input class="form-control" id="new-password" name="password" type="password" placeholder="" autocomplete="new-password">
                            {{ error('password') }}
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLocation">Konfirmasi Password Baru</label>
                            <input class="form-control" id="inputLocation" name="konfirmasi_password" type="password" placeholder="" autocomplete="new-password">
                            {{ error('konfirmasi_password') }}
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection