<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends MY_Controller {

	public $withCredential = false;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PerusahaanModel','perusahaan');
	}

	public function index()
	{
		$this->init_guard();
		$rules = [
			'nama_perusahaan' => 'required',
			'tahun_berdiri_perusahaan' => 'required',
			'email_perusahaan' => 'required|valid_email|is_unique[perusahaan.email]',
			'alamat_perusahaan' => 'required',
			'telepon_perusahaan' => 'required',
			'nama' => 'required',
			'jabatan' => 'required',
			'username' => 'required|min_length[5]|max_length[20]|is_unique[user.username]',
			'password' => 'required|min_length[6]',
			'konfirmasi_password' => 'required|min_length[6]|matches[password]',
			// 'dokumen_ktp' => '',
			// 'dokumen_npwp' => '',
			// 'dokumen_nib' => '',
		];

		if(validate($rules))
		{

			$dataUser = [
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'password' => Hash::make($this->input->post('password')),
				// 'alamat' => $this->input->post('alamat_perusahaan'),
				'role_id' => 2
			];

			$sv = $this->user->create($dataUser);
			if($sv)
			{	
				$user_id = $sv->id;
				$dokumen_ktp = null;
				$uploadKTP = file_store('dokumen_ktp','perusahaan/'.$user_id);
				if($uploadKTP['status'])
				{

					$fileData = $uploadKTP['data'];

					$dokumen_ktp = $fileData['full_path'];
				}
				
				$dokumen_npwp = null;
				$uploadNPWP = file_store('dokumen_npwp','perusahaan/'.$user_id);
				if($uploadNPWP['status'])
				{

					$fileData = $uploadNPWP['data'];

					$dokumen_npwp = $fileData['full_path'];
				}

				$dokumen_nib = null;
				$uploadNIB = file_store('dokumen_nib','perusahaan/'.$user_id);
				if($uploadNIB['status'])
				{

					$fileData = $uploadNIB['data'];

					$dokumen_nib = $fileData['full_path'];
				}

				$dataPerusahaan = [
					// 'user_id' => $user_id,
					'nama' => $this->input->post('nama_perusahaan'),
					'email' => $this->input->post('email_perusahaan'),
					'tahun_berdiri' => $this->input->post('tahun_berdiri_perusahaan'),
					'deskripsi' => $this->input->post('deskripsi_perusahaan'),
					'alamat' => $this->input->post('alamat_perusahaan'),
					'telepon' => $this->input->post('telepon_perusahaan'),
					'dokumen_ktp' => $dokumen_ktp,
					'dokumen_npwp' => $dokumen_npwp,
					'dokumen_nib' => $dokumen_nib,
				];

				$svPerusahaan = $this->perusahaan->create($dataPerusahaan);

				$this->user->update(['perusahaan_id' => $svPerusahaan->id],['id' => $user_id]);


				set_alert('success','Berhasil mendaftar, data anda akan diverifikasi dalam 1x24jam');
				return redirect('login');
			}
			
			set_alert('error','Gagal mendaftar');
			return redirect('register');

		}else{
			return view('auth.register');
		}
	}

}
