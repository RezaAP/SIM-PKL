<?php

use Dompdf\Dompdf;
use Dompdf\Options;

defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends MY_Controller {

    public $roleAccept = 4;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan','PembimbingModel' => 'pembimbing','AbsensiModel' => 'absensi']);
	}

    private function get_pengajuan()
    {
        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;
        $pengajuan = $this->pengajuan->where(['pengajuan.pembimbing_id' => $pembimbing->id,'pengajuan.status' => 1])->first;
        return $pengajuan;
    }
    
    public function index()
    {
        $pengajuan = $this->get_pengajuan();

        $data['detail'] = $pengajuan;

        $data['data'] = $pengajuan? $this->absensi->where(['pengajuan_id' => $pengajuan->id])->get : [];

        $currentDate = date('Y-m-d');

        $data['status_absensi'] = $pengajuan? $this->absensi->where("pengajuan_id = $pengajuan->id AND DATE(tanggal) = '$currentDate' AND status = 1")->first : null;

        return view('mahasiswa.absensi.index',$data);
    }

    public function store()
    {
        $validate = [
            'kegiatan' => 'required'
        ];


        if(validate($validate))
        {

            $pengajuan = $this->get_pengajuan();
            
            $currentDate = date('Y-m-d');

            $cekAbsen = $this->absensi->where("pengajuan_id = $pengajuan->id AND DATE(tanggal) = '$currentDate' AND status != 2")->first;

            if($cekAbsen)
            {
                set_alert('error','Anda telah Melakukan Absensi hari ini');
                return redirect('mahasiswa/absensi');
            }


            $data = [
                'pengajuan_id' => $pengajuan->id,
                'kegiatan' => $this->input->post('kegiatan')
            ];

            $sv = $this->absensi->create($data);
            if($sv)
			{	
				set_alert('success','Berhasil Melakukan Absensi');
				return redirect('mahasiswa/absensi');
			}
			
			set_alert('error','Gagal Melakukan Absensi');
			return redirect('mahasiswa/absensi');

        }

        return $this->index();
    }

    public function cetak()
    {
        $pengajuan = $this->get_pengajuan();
        $data['data'] = $pengajuan? $this->absensi->where(['pengajuan_id' => $pengajuan->id])->get : [];
        $dompdf = new Dompdf();
        $judul = "Absensi PKL - ".auth()->user()->nama;
		$data['judul'] = $judul;
		$html = view('mahasiswa.absensi.cetak',$data,true);
		// echo $html;die;
		$options = new Options();
		$options->set('defaultFont', 'Courier');
		$dompdf->loadHtml($html);
		
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Render the HTML as PDF
		// $dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream("{$judul}.pdf",['Attachment' => 0]);	
    }

}