<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $roleAccept = 1;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PerusahaanModel' => 'perusahaan','LowonganModel' => 'lowongan']);
	}
    
    public function index()
    {

        $data['total_perusahaan'] = $this->perusahaan->countVerif();
        $data['total_lowongan'] = $this->lowongan->count();
        $data['total_dosen'] = $this->user->countDosen();
        $data['total_mahasiswa'] = $this->user->countMahasiswa();
        return view('koordinator-pkl.dashboard',$data);
    }

}