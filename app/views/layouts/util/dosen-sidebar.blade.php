<li class="nav-item{{ segment(2) == ''? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('dosen') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('dosen/mahasiswa') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Data Mahasiswa</span></a>
</li>
<li class="nav-item{{ segment(2) == 'bimbingan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('dosen/bimbingan') }}">
        <i class="fas fa-fw fa-business-time"></i>
        <span>Bimbingan</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == 'penilaian'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('dosen/mahasiswa/penilaian') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Penilaian Akhir Mahasiswa</span></a>
</li>

