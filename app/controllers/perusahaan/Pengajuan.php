<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends MY_Controller {

    public $roleAccept = 2;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan','PerusahaanModel' => 'perusahaan','DokumenPengajuanModel' => 'dokumen_pengajuan']);
	}
    
    public function index()
    {
	$perusahaan = $this->perusahaan->where(['id' => auth()->user()->perusahaan_id])->first;
        $pengajuan = $this->pengajuan->where('pengajuan.status != 1 AND lowongan.perusahaan_id='.$perusahaan->id)->get;
		$index = 0;
        $datas = new stdClass;
        foreach($pengajuan as $r => $val)
        {
            $dokumen = $this->dokumen_pengajuan->where(['pengajuan_id' => $val->id])->get;
            $datas->{$index} = $val;
            $datas->{$index}->dokumen = $dokumen;
            $index++;

        }
		$data['data'] = $datas;
        return view('perusahaan.pengajuan.index',$data);
    }

    public function terima()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $this->pengajuan->update(['status' => 1],['id' => $this->input->post('id')]);
            
			set_alert('success','Berhasil menerima pengajuan');
			return redirect('perusahaan/pengajuan');

		}
		set_alert('error','Gagal menerima pengajuan');
		return redirect('perusahaan/pengajuan');
    }

    public function tolak()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $this->pengajuan->update(['status' => 2],['id' => $this->input->post('id')]);
            
			set_alert('success','Berhasil menolak pengajuan');
			return redirect('perusahaan/pengajuan');

		}
		set_alert('error','Gagal menolak pengajuan');
		return redirect('perusahaan/pengajuan');
    }


}
