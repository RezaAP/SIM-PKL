<?php

class PerusahaanModel extends MY_Model {

    public $table = 'perusahaan';

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
	{
        $status = $this->input->get('status');

		$data = $this->db->select($this->table.'.*,
        user.nama as penanggungjawab,
        user.username as penanggungjawab_username,
        user.nama as penanggungjawab_nama,
        user.foto as penanggungjawab_foto,
        user.role_id as penanggungjawab_role_id,
        user.status')
        ->join('user',$this->table.'.id=user.perusahaan_id','right')->where('role_id=2');
        if($status != '')
        {
            $data = $data->group_start()
                ->where('user.status',$status)
            ->group_end();
        }
        $data = $data->order_by($this->table.'.created_at','desc')->group_by('user.perusahaan_id')
        ->get($this->table)->result();
        return $data;
	}

    public function countVerif()
    {
        $query = $this->db->select("COUNT({$this->table}.id) as aggregate")->join('user',$this->table.'.id=user.perusahaan_id','left')->where(['user.status' => 1])->get($this->table)->row()->aggregate;
		return $query;
    }


    public function find($id)
	{
        $status = $this->input->get('status');

		$data = $this->db->select($this->table.'.*,
        user.nama as penanggungjawab,
        user.username as penanggungjawab_username,
        user.nama as penanggungjawab_nama,
        user.foto as penanggungjawab_foto,
        user.role_id as penanggungjawab_role_id,
        user.status')
        ->join('user',$this->table.'.id=user.perusahaan_id','left');
        if($status != '')
        {
            $data = $data->group_start()
                ->where('user.status',$status)
            ->group_end();
        }
        $data = $data->get($this->table)->row();
        return $data;
	}

}