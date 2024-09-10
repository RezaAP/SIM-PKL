<li class="nav-item{{ segment(2) == ''? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
</li>
<li class="nav-item{{ segment(2) == 'perusahaan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/perusahaan') }}">
        <i class="fas fa-fw fa-building"></i>
        <span>Data Perusahaan</span></a>
</li>
<li class="nav-item{{ segment(2) == 'lowongan'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/lowongan') }}">
        <i class="fas fa-fw fa-list-alt"></i>
        <span>Data Lowongan PKL</span></a>
</li>
<li class="nav-item{{ segment(2) == 'dosen'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/dosen') }}">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Data Dosen</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == 'create'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/mahasiswa/create') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Pendaftaran Mahasiswa</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == ''? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/mahasiswa') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Data Mahasiswa Terdaftar</span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == 'pkl'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/mahasiswa/pkl') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Data Mahasiswa PKL </span></a>
</li>
<li class="nav-item{{ segment(2) == 'mahasiswa' && segment(3) == 'penilaian'? ' active' : '' }}">
    <a class="nav-link" href="{{ base_url('koordinator-pkl/mahasiswa/penilaian') }}">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Penilaian Akhir Mahasiswa</span></a>
</li>

