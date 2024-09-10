<?php

class UserModel extends MY_Model {

    public $table = 'user';

    public function __construct()
    {
        parent::__construct();
    }

    public function where($where)
    {
        $query = $this->db->select($this->table.".*,role.nama as role")
        ->join('role','role.id='.$this->table.'.role_id')
        ->where($where)->get($this->table);
        $query->first = $query->row();
		$query->get = $query->result();
        return $query;
    }
    
    public function find($id)
    {
        $query = $this->db->select($this->table.".*,role.nama as role")
        ->join('role','role.id='.$this->table.'.role_id')
        ->where([$this->table.'.id' => $id])->get($this->table)->row();
        return $query;
    }

    public function countDosen()
	{
		$query = $this->db->select("COUNT(id) as aggregate")->get_where($this->table,['role_id' => 3])->row()->aggregate;
		return $query;
	}

    public function countMahasiswa()
	{
		$query = $this->db->select("COUNT(id) as aggregate")->get_where($this->table,['role_id' => 4])->row()->aggregate;
		return $query;
	}
    
    public function countMahasiswaByDosen()
	{
		$query = $this->db->select("COUNT(id) as aggregate")->get_where($this->table,['role_id' => 4])->row()->aggregate;
		return $query;
	}

}