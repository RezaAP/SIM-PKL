@extends('layouts.panel')
@section('content')

<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="h3 text-gray-800">Daftar Lowongan</h1>
    </div>
    <div class="col-md-6 text-right">
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#ModalAdd">Tambah</button> --}}
    </div>
</div>


{!! alert(['success' => 'success','error' => 'danger']) !!}

<div class="row">
    @foreach($data as $v)
        <div class="col-md-3">
            <a href="{{ base_url('mahasiswa/lowongan/show/'.$v->id) }}" class="card border-0 shadow text-decoration-none">
                <img src="{{ thumbnail_lowongan($v->gambar,$v->id) }}" alt="" class="card-img-top" width="100%">
                <div class="card-body">
                    <div class="mb-2     h5 font-weight-bold text-dark">
                        {{ $v->posisi }}
                    </div>
                    <div class="text-md font-weight-bold text-primary text-uppercase mb-2">
                        <i class="fas fa-building"></i> {{ $v->perusahaan }}</div>
                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                        <i class="fas fa-users"></i> {!! $v->kuota == $v->kuota_terisi? "<span class='text-danger'>Kuota Penuh</span>" : "Kuota $v->kuota_terisi/$v->kuota Orang"!!}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>



@endsection