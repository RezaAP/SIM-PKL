<?php

class PengajuanModel extends MY_Model {

    public $table = 'pengajuan';

    public function __construct()
    {
        parent::__construct();
    }

    public function where($where = null)
    {
        $query = $this->db->select($this->table.".*,
            mhs.id as mahasiswa_id,
            mhs.nama as nama_mahasiswa,
            mhs.username as username_mahasiswa,
            mhs.nim as nim_mahasiswa,
            mhs.jurusan as jurusan_mahasiswa,
            YEAR(mhs.created_at) as tahun_mahasiswa,
            dsn.nama as nama_dosen,
            lowongan.gambar,
            lowongan.posisi,
            lowongan.deskripsi,
            lowongan.deskripsi_dokumen,
            lowongan.kuota,
            perusahaan.nama as perusahaan,
            pembimbing.dosen_id,
            pembimbing.nilai as nilai_pembimbing
        ")
        ->join('pembimbing','pembimbing.id='.$this->table.'.pembimbing_id','left')
        ->join('user mhs','mhs.id=pembimbing.user_id','left')
        ->join('user dsn','dsn.id=pembimbing.dosen_id','left')
        ->join('lowongan','lowongan.id='.$this->table.'.lowongan_id','left')
        ->join('perusahaan','perusahaan.id=lowongan.perusahaan_id','left');

        if($where){
            $query = $query->group_start()
                ->where($where)
            ->group_end();
        }
        $status = $this->input->get('status');
        if($status != '')
        {
            $query = $query->group_start()
                ->where($this->table.'.status',$status)
            ->group_end();
        }
        $query = $query->order_by($this->table.'.created_at','desc')
        ->get($this->table);
        $query->first = $query->row();
		$query->get = $query->result();
        return $query;
    }

    public function all()
    {
        return $this->where()->get;
    }
}