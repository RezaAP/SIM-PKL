<?php

use Dompdf\Dompdf;
use Dompdf\Options;

defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends MY_Controller {

    public $roleAccept = 4;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['BimbinganModel' => 'bimbingan','PembimbingModel' => 'pembimbing','PengajuanModel' => 'pengajuan']);
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

        $laporan = [];
        if($pengajuan)
        {
            $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;
            $data['pembimbing'] = $pembimbing;
            $data['data'] = $this->bimbingan->where(['user_id' => auth()->id(),'dosen_id' => $pembimbing->dosen_id])->get;
        }
        return view('mahasiswa.bimbingan.index',$data);
    }

    public function store()
    {
        $validate = [
            'kegiatan' => 'required',
            // 'tanggal_pengajuan' => 'required'
        ];


        if(validate($validate))
        {

            $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;

            $data = [
                'user_id' => auth()->id(),
                'dosen_id' => $pembimbing->dosen_id,
                'catatan_mahasiswa' => $this->input->post('kegiatan'),
                // 'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan')
            ];

            $sv = $this->bimbingan->create($data);
            if($sv)
			{	
				set_alert('success','Berhasil membuat pengajuan');
				return redirect('mahasiswa/bimbingan');
			}
			
			set_alert('error','Gagal membuat pengajuan');
			return redirect('mahasiswa/bimbingan');

        }

        return $this->index();
    }

    public function batal()
    {
        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{
			$sv = $this->bimbingan->delete(['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil membatalkan bimbingan');
				return redirect('mahasiswa/bimbingan');
			}
			
			set_alert('error','Gagal membatalkan bimbingan');
			return redirect('mahasiswa/bimbingan');
            
		}
        modal_session('ModalBatal'.$this->input->post('id'));
        return $this->index();
    }

    public function cetak()
    {

        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;
        $data['data'] = $pembimbing? $this->bimbingan->where(['user_id' => auth()->id(),'dosen_id' => $pembimbing->dosen_id])->get : [];
        
        $dompdf = new Dompdf();
        $judul = "Data Bimbingan PKL";
		$data['judul'] = $judul;
		$html = view('mahasiswa.bimbingan.cetak',$data,true);
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