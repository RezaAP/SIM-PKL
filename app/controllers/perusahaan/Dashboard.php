<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $roleAccept = 2;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan']);
	}
    
    public function index()
    {
        $data['total_mahasiswa'] = count($this->pengajuan->where(['perusahaan.id' => auth()->user()->perusahaan_id,'pengajuan.status' => '1'])->get);
        $data['total_pengajuan'] = count($this->pengajuan->where(['perusahaan.id' => auth()->user()->perusahaan_id,'pengajuan.status' => '0'])->get);
        return view('perusahaan.dashboard',$data);
    }

}