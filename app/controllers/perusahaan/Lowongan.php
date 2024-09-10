<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan extends MY_Controller {

    public $roleAccept = 2;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['LowonganModel' => 'lowongan','PerusahaanModel' => 'perusahaan','PengajuanModel' => 'pengajuan']);
	}
    
    public function index()
    {
        $data['data'] = $this->lowongan->all();
        return view('perusahaan.lowongan.index',$data);
    }

    public function store()
    {
        $rules = [
			'posisi' => 'required',
			'deskripsi' => 'required',
			'kuota' => 'required',
			'deskripsi_dokumen' => 'required',
		];

		if(validate($rules))
		{

            $gambar = null;

            if($_FILES['gambar'])
            {
                $uploadGambar = file_store('gambar','perusahaan/'.auth()->id().'/lowongan');
                if($uploadGambar['status'])
                {
                    $fileData = $uploadGambar['data'];
                    $gambar = $fileData['full_path'];
                }
            }

			$perusahaan_id = auth()->user()->perusahaan_id;
			// $perusahaan = $this->perusahaan->where(['id' => auth()->id()])->first;

			$data = [
				'perusahaan_id' => $perusahaan_id,
                'gambar' => $gambar,
				'posisi' => $this->input->post('posisi'),
				'deskripsi' => $this->input->post('deskripsi'),
				'deskripsi_dokumen' => $this->input->post('deskripsi_dokumen'),
				'kuota' => $this->input->post('kuota'),
			];

			$sv = $this->lowongan->create($data);
			if($sv)
			{	

				set_alert('success','Berhasil menambahkan data');
				return redirect('perusahaan/lowongan');
			}
			
			set_alert('error','Gagal menambahkan data');
			return redirect('perusahaan/lowongan');
            
		}
        modal_session('ModalAdd');
        return $this->index();
    }
    
    public function update()
    {
        $lowongan = $this->lowongan->find($this->input->post('id'));
        $rules = [
			'id' => 'required',
			'posisi' => 'required',
			'deskripsi' => 'required',
			'kuota' => 'required',
			'deskripsi_dokumen' => 'required',
		];

		if(validate($rules))
		{

			$gambar = $lowongan->gambar;

            if($_FILES['gambar'])
            {
                $uploadGambar = file_store('gambar','perusahaan/'.auth()->id().'/lowongan');
                if($uploadGambar['status'])
                {
                    $fileData = $uploadGambar['data'];
                    $gambar = $fileData['full_path'];
                }
            }

			$data = [
                'gambar' => $gambar,
				'posisi' => $this->input->post('posisi'),
				'deskripsi' => $this->input->post('deskripsi'),
				'deskripsi_dokumen' => $this->input->post('deskripsi_dokumen'),
				'kuota' => $this->input->post('kuota'),
			];

			$sv = $this->lowongan->update($data,['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil mengubah data');
				return redirect('perusahaan/lowongan');
			}
			
			set_alert('error','Gagal mengubah data');
			return redirect('perusahaan/lowongan');
            
		}
        modal_session('ModalEdit'.$this->input->post('id'));
        return $this->index();
    }
   
    public function destroy()
    {

        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{
			$this->pengajuan->delete(['lowongan_id' => $this->input->post('id')]);
			$sv = $this->lowongan->delete(['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menghapus data');
				return redirect('perusahaan/lowongan');
			}
			
			set_alert('error','Gagal menghapus data');
			return redirect('perusahaan/lowongan');
            
		}
        modal_session('ModalDelete'.$this->input->post('id'));
        return $this->index();
    }

}