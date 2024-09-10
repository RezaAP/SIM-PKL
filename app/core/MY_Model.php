<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $table = null;

	public $primary = 'id';

	public function __construct()
	{
		parent::__construct();
	}

	public function all()
	{
		return $this->db->get($this->table)->result();
	}

	public function find($id)
	{
		return $this->db->get_where($this->table,[$this->primary => $id])->row();
	}

	public function create($data)
	{
		$create = $this->db->insert($this->table,$data);
		if($create)
		{
			$id = $this->db->insert_id();
			return $this->find($id);
		}
		return null;
	}

	public function insert($data)
	{
		return $this->db->insert_batch($this->table,$data);
	}

	public function update($data,$where)
	{
		return $this->db->update($this->table,$data,$where);
	}

	public function delete($where)
	{
		return $this->db->where($where)->delete($this->table);
	}

	public function where($where)
	{
		$query = $this->db->get_where($this->table,$where);
		$query->first = $query->row();
		$query->get = $query->result();
		return $query;
	}

	public function whereRaw($where)
	{
		$query = $this->db->where($where)->get($this->table);
		$query->first = $query->row();
		$query->get = $query->result();
		return $query;
	}

	public function count()
	{
		$query = $this->db->select("COUNT(id) as aggregate")->get($this->table)->row()->aggregate;
		return $query;
	}

	public function sum($column)
	{
		$query = $this->db->select("SUM($column) as aggregate")->get($this->table)->row()->aggregate;
		return $query;
	}

}


/* End of file Model.php */