<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    public $roleAccept = 2;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan','LaporanAkhirModel' => 'laporan_akhir','PerusahaanModel' => 'perusahaan']);
	}
    
    public function index()
    {
		$perusahaan = $this->perusahaan->where(['id' => auth()->user()->perusahaan_id])->first;
        $data['data'] = $this->pengajuan->where('pengajuan.status = 1 AND lowongan.perusahaan_id = '.$perusahaan->id)->get;
        return view('perusahaan.mahasiswa.index',$data);
    }
    
	public function penilaian()
    {
		$perusahaan = $this->perusahaan->where(['id' => auth()->user()->perusahaan_id])->first;
        $daftar_pkl = $this->pengajuan->where('pengajuan.status = 1 AND lowongan.perusahaan_id = '.$perusahaan->id)->get;
		$index = 0;
		$datas = new stdClass;
        foreach($daftar_pkl as $val)
        {
            $dokumen = $this->laporan_akhir->where(['pembimbing_id' => $val->pembimbing_id])->get;
            $datas->{$index} = $val;
            $datas->{$index}->laporan_akhir = $dokumen;
            $index++;

        }
		$data['data'] = $datas;
        return view('perusahaan.mahasiswa.penilaian',$data);
    }

    // public function nilai()
    // {
    //     $rules = [
	// 		'id' => 'required',
	// 		'nilai' => 'required'
	// 	];

	// 	if(validate($rules))
	// 	{
    //         $sv = $this->pengajuan->update(['nilai' => $this->input->post('nilai')],['id' => $this->input->post('id')]);
	// 		if($sv)
	// 		{	

	// 			set_alert('success','Berhasil menilai mahasiswa');
	// 			return redirect('perusahaan/mahasiswa');
	// 		}
			
	// 		set_alert('error','Gagal menilai mahasiswa');
	// 		return redirect('perusahaan/mahasiswa');
            
	// 	}
    //     modal_session('ModalNilai'.$this->input->post('id'));
    //     return $this->index();
    // }

}