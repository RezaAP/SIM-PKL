<li class="nav-item{{ segment(2) == ''? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
</li>
<li class="nav-item{{ segment(2) == 'lowongan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan/lowongan') }}">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Data Lowongan PKL</span></a>
</li>
<li class="nav-item{{ segment(2) == 'pengajuan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan/pengajuan') }}">
        <i class="fas fa-fw fa-th-list"></i>
        <span>Pengajuan PKL</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == ''? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan/mahasiswa') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Data Mahasiswa PKL</span></a>
</li>
<li class="nav-item{{ segment(2) == 'absensi'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan/absensi') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Data Absensi</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == 'penilaian'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan/mahasiswa/penilaian') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Penilaian Akhir Mahasiswa</span></a>
</li>
<li class="nav-item{{ segment(2) == 'user'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('perusahaan/user') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Penanggung Jawab Lapangan</span></a>
</li>
