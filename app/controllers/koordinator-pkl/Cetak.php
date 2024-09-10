<?php

use Dompdf\Dompdf;
use Dompdf\Options;

defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends MY_Controller {

    public $roleAccept = 1;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PerusahaanModel' => 'perusahaan','LowonganModel' => 'lowongan']);
	}
    
    public function perusahaan()
    {
		$data['data'] = $this->perusahaan->all();
		return $this->generate('Data Perusahaan','perusahaan.cetak',$data,true);
    }

    public function dosen()
    {
		$data['data'] = $this->user->where(['role_id' => 3])->get;
		return $this->generate('Data Dosen','dosen.cetak',$data);
    }

    public function mahasiswa()
    {
		$data['data'] = $this->pembimbing->all();
		return $this->generate('Data Mahasiswa','mahasiswa.cetak',$data, true);
    }
    
	public function mahasiswa_pkl()
    {
		$data['data'] = $this->pembimbing->all();
		return $this->generate('Data Mahasiswa','mahasiswa.cetak-pkl',$data, true);
    }

    public function lowongan()
    {
		$data['data'] = $this->lowongan->getAll();
		return $this->generate('Data Lowongan','lowongan.cetak',$data);
    }

	private function generate($judul,$view,$data,$landscape = false)
	{
		$dompdf = new Dompdf();
		$data['judul'] = $judul;
		$html = view('koordinator-pkl.'.$view,$data,true);
		// echo $html;die;
		$options = new Options();
		$options->set('defaultFont', 'Courier');
		$dompdf->loadHtml($html);
		
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', $landscape? 'landscape' : 'portrait');
		$dompdf->render();

		// Render the HTML as PDF
		// $dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream("{$judul}.pdf",['Attachment' => 0]);	
	}

}