<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends MY_Controller {

    public $roleAccept = 1;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['LowonganModel' => 'lowongan']);
	}
    
    public function index()
    {
        $data['data'] = $this->lowongan->getAll();
        return view('koordinator-pkl.lowongan.index',$data);
    }

}