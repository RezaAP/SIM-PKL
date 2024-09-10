<?php

class PembimbingModel extends MY_Model {

    public $table = 'pembimbing';

    public function __construct()
    {
        parent::__construct();
    }

    public function where($where = null)
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
            (SELECT pengajuan.status FROM pengajuan WHERE pengajuan.pembimbing_id=pembimbing.id AND status != 2) as status_pengajuan,
        ")
        ->join('user m','m.id=pembimbing.user_id','left')
        ->join('user d','d.id=pembimbing.dosen_id','left');
        if($where)
        {
            $query = $query->group_start()->where($where)->group_end();
        }
        $status = $this->input->get('status');
        if($status != '')
        {
            $status = ($status == '-'? 'IS NULL' : ($status == '!NULL'? 'IS NOT NULL' : "=".$status));
            $query = $query->group_start()
                ->where("(SELECT pengajuan.status FROM pengajuan WHERE pengajuan.pembimbing_id=pembimbing.id)", $status, false)
            ->group_end();
        }
        $query = $query->get($this->table);
        $query->first = $query->row();
		$query->get = $query->result();
        return $query;
    }

    public function all()
    {
        return $this->where()->get;
    }

}