<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-rocket"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @php
        $__role = auth()->user()->role_id;
    @endphp

    @includeWhen($__role == '1','layouts.util.admin-sidebar')

    @includeWhen($__role == '2','layouts.util.perusahaan-sidebar')

    @includeWhen($__role == '3','layouts.util.dosen-sidebar')
    
    @includeWhen($__role == '4','layouts.util.mahasiswa-sidebar')

    <li class="nav-item{{ segment(1) == 'profil'? ' active' : '' }}">
        <a class="nav-link" href="{{ base_url('profil') }}">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>