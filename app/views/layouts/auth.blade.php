
@include('layouts.util.head')


    <div class="container d-flex align-items-center" style="min-height:100vh;">

        <div class="row justify-content-center w-100">

            <div class="col-xl-10 col-lg-12 col-md-9">

                @yield('content')

            </div>

        </div>

    </div>

@include('layouts.util.script')