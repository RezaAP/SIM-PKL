<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends MY_Controller {

    public $roleAccept = 4;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['LowonganModel' => 'lowongan','PengajuanModel' => 'pengajuan']);
	}
    
    public function index()
    {
        $data['data'] = $this->lowongan->getByUser();
        return view('mahasiswa.lowongan.index',$data);
    }

    public function show($id)
    {
        $data['data'] = $this->lowongan->findByUser($id);
        return view('mahasiswa.lowongan.show',$data);
    }

    public function daftar()
    {

        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;

        $cekPengajuan = $this->pengajuan->where("pembimbing_id = $pembimbing->id AND (pengajuan.status = 0 OR pengajuan.status = 1)")->first;

        if($cekPengajuan)
        {
            set_alert('error','Anda tidak dapat mengikuti lebih dari 1 lowongan');
            return redirect('mahasiswa/lowongan/show/'.$this->input->post('id'));
        }

        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{


            // if($_FILES['dokumen'])
            // {
            //     $uploadDokumen = file_store('dokumen','mahasiswa/'.auth()->id().'/lowongan');
            //     if($uploadDokumen['status'])
            //     {
            //         $fileData = $uploadDokumen['data'];
            //         $dokumen = $fileData['full_path'];

            //     }
            // }
            $data = [
                'pembimbing_id' => $pembimbing->id,
                'lowongan_id' => $this->input->post('id'),
                // 'dokumen' => $dokumen
            ];

            $this->pengajuan->create($data);

            set_alert('success','Berhasil mendaftar lowongan');
            return redirect('mahasiswa/riwayat');
            
		}

        return $this->show($this->input->post('id'));
    }

}