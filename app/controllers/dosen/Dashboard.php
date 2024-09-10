<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $roleAccept = 3;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PerusahaanModel' => 'perusahaan','LowonganModel' => 'lowongan','PembimbingModel' => 'pembimbing','BimbinganModel' => 'bimbingan']);
	}
    
    public function index()
    {
        $data['total_mahasiswa'] = count($this->pembimbing->where(['dosen_id' => auth()->id()])->get);
        $data['total_bimbingan'] = count($this->bimbingan->where(['dosen_id' => auth()->id(),'bimbingan.status' => '0'])->get);
        return view('dosen.dashboard',$data);
    }

}