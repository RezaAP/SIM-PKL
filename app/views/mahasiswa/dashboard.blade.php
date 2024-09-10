@extends('layouts.panel')
@section('content')
<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card border-0 shadow-sm">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary mb-0">Selamat Datang, <b>{{ auth()->user()->nama }}</b></h5>
                        {{-- <p class="mb-4">
                            Kamu mempunyai transaksi sebanyak <span class="fw-medium">99</span>
                        </p> --}}

                        {{-- <a href="{{ route('admin.profile.index') }}" class="btn btn-sm btn-outline-primary">Lihat
                            Profil</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection