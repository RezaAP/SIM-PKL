<?php

class LowonganModel extends MY_Model {

    public $table = 'lowongan';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['PembimbingModel' => 'pembimbing']);
    }

    public function getAll()
    {
        $query = $this->db->select("
            $this->table.*,
            perusahaan.nama as nama_perusahaan,
            (SELECT COUNT(id) FROM pengajuan WHERE lowongan_id=lowongan.id AND status=1) as kuota_terisi
        ")
        ->join('perusahaan',$this->table.'.perusahaan_id=perusahaan.id','left')
        ->order_by($this->table.'.created_at','desc')
        ->get($this->table)->result();
        return $query;
    }
    
    public function all()
    {
        $perusahaan_id = auth()->user()->perusahaan_id;
        $query = $this->db->select("
            $this->table.*,
            perusahaan.nama as nama_perusahaan,
            (SELECT COUNT(id) FROM pengajuan WHERE lowongan_id=lowongan.id AND status=1) as kuota_terisi
        ")
        ->join('perusahaan',$this->table.'.perusahaan_id=perusahaan.id','left')
        ->order_by($this->table.'.created_at','desc')
        ->get_where($this->table,['perusahaan.id' => $perusahaan_id])->result();
        return $query;
    }

    public function getByUser()
    {

        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;

        $query = $this->db->select("
            $this->table.*,
            perusahaan.nama as perusahaan,
            (SELECT COUNT(id) FROM pengajuan WHERE lowongan_id=lowongan.id AND status=1) as kuota_terisi,
            IF((SELECT id FROM pengajuan WHERE lowongan_id=lowongan.id AND pembimbing_id={$pembimbing->id}),1,0) as status_pengajuan
        ")
        ->join('perusahaan',$this->table.'.perusahaan_id=perusahaan.id','left')
        ->join('user','perusahaan.id=user.perusahaan_id','right')
        ->where(['user.status' => '1','user.role_id' => 2])
        ->order_by($this->table.'.created_at','desc')
        ->group_by('user.perusahaan_id')
        ->get($this->table)->result();
        return $query;
    }
    
    public function findByUser($id)
    {
        
        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;
        
        $query = $this->db->select("
        $this->table.*,
        perusahaan.nama as perusahaan,
        (SELECT COUNT(id) FROM pengajuan WHERE lowongan_id=lowongan.id AND status=1) as kuota_terisi,
        IF((SELECT id FROM pengajuan WHERE lowongan_id=lowongan.id AND pembimbing_id={$pembimbing->id}),1,0) as status_pengajuan
        ")
        ->join('perusahaan',$this->table.'.perusahaan_id=perusahaan.id','left')
        ->join('user','perusahaan.id=user.perusahaan_id','right')
        ->where(['user.status' => '1','user.role_id' => 2])
        ->order_by($this->table.'.created_at','desc')
        ->group_by('user.perusahaan_id')
        ->get_where($this->table,[$this->table.'.id' => $id])->row();
        return $query;
    }

}