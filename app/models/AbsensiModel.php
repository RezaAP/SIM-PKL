<?php

class AbsensiModel extends MY_Model {

    public $table = 'absensi';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['PerusahaanModel' => 'perusahaan']);
    }

    public function getDataByPerusahaan()
    {
        $perusahaan_id = auth()->user()->perusahaan_id;
        $perusahaan = $this->perusahaan->where(['id' => $perusahaan_id])->first;

        $query = $this->db->select("
            {$this->table}.*,
            user.nama as nama_mahasiswa,
            user.nim as nim_mahasiswa,
            user.jurusan as jurusan_mahasiswa,
            YEAR(user.created_at) as tahun_mahasiswa,
        ")
        ->join('pengajuan',$this->table.'.pengajuan_id=pengajuan.id','left')
        ->join('pembimbing','pengajuan.pembimbing_id=pembimbing.id','left')
        ->join('user','user.id=pembimbing.user_id','left')
        ->join('lowongan','pengajuan.lowongan_id=lowongan.id','left')
        ->order_by($this->table.'.tanggal','desc')
        ->get_where($this->table,['lowongan.perusahaan_id' => $perusahaan? $perusahaan->id : ''])->result();
        return $query;
    }

}