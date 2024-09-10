<li class="nav-item{{ segment(2) == ''? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('mahasiswa') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
</li>
<li class="nav-item{{ segment(2) == 'lowongan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('mahasiswa/lowongan') }}">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Lowongan PKL</span></a>
</li>
<li class="nav-item{{ segment(2) == 'riwayat'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('mahasiswa/riwayat') }}">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Riwayat Lamaran</span></a>
</li>
<li class="nav-item{{ segment(2) == 'absensi'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('mahasiswa/absensi') }}">
        <i class="fas fa-fw fa-user-edit"></i>
        <span>Absensi</span></a>
</li>
<li class="nav-item{{ segment(2) == 'bimbingan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('mahasiswa/bimbingan') }}">
        <i class="fas fa-fw fa-business-time"></i>
        <span>Bimbingan PKL</span></a>
</li>
<li class="nav-item{{ segment(2) == 'laporan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('mahasiswa/laporan') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Laporan PKL</span></a>
</li>
