<?php

class BimbinganModel extends MY_Model {

    public $table = 'bimbingan';

    public function __construct()
    {
        parent::__construct();
    }

    public function where($where)
    {
        $query = $this->db->select($this->table.".*,
            m.nama as nama_mahasiswa,
            m.username as username_mahasiswa,
            m.nim as nim_mahasiswa,
            m.jurusan as jurusan_mahasiswa,
            YEAR(m.created_at) as tahun_mahasiswa,
            d.nama as nama_pembimbing,
            d.username as username_pembimbing,
            d.nip as nip_pembimbing,
        ")
        ->join('user m','m.id=bimbingan.user_id','left')
        ->join('user d','d.id=bimbingan.dosen_id','left');
        if($where)
        {
            $query = $query->group_start()->where($where)->group_end();
        }
        $status = $this->input->get('status');
        if($status != '')
        {
            $query = $query->group_start()
                ->where("bimbingan.status", $status)
            ->group_end();
        }
        $query = $query->order_by('bimbingan.id','desc')->get($this->table);
        $query->first = $query->row();
		$query->get = $query->result();
        return $query;
    }
}