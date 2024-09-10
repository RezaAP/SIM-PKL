<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends MY_Controller {

    public $roleAccept = 2;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan','PembimbingModel' => 'pembimbing','AbsensiModel' => 'absensi']);
	}
    
    public function index()
    {
        $absensi = $this->absensi->getDataByPerusahaan();

        $data['data'] = $absensi;

        return view('perusahaan.absensi.index',$data);
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

    public function terima()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $this->absensi->update(['status' => 1],['id' => $this->input->post('id')]);
            
			set_alert('success','Berhasil menerima kegiatan tersebut');
			return redirect('perusahaan/absensi');

		}
		set_alert('error','Gagal menerima kegiatan tersebut');
		return redirect('perusahaan/absensi');
    }

    public function tolak()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $this->absensi->update(['status' => 2],['id' => $this->input->post('id')]);
            
			set_alert('success','Berhasil menolak kegiatan tersebut');
			return redirect('perusahaan/absensi');

		}
		set_alert('error','Gagal menolak kegiatan tersebut');
		return redirect('perusahaan/absensi');
    }

}