<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends MY_Controller {

    public $roleAccept = 1;

	public function __construct()
	{
		parent::__construct();
        $this->load->model('PerusahaanModel','perusahaan');
	}
    
    public function index()
    {
        $data['data'] = $this->perusahaan->all();
        return view('koordinator-pkl.perusahaan.index',$data);
    }

	public function update()
    {
        $perusahaan = $this->perusahaan->find($this->input->post('id'));

        $rules = [
			'id' => 'required',
			'nama_perusahaan' => 'required',
			'telepon' => 'required',
			'email' => 'required'.($perusahaan && $perusahaan->email != $this->input->post('email')? '|is_unique[perusahaan.email]' : ''),
			// 'username' => 'required'.($perusahaan && $perusahaan->penanggungjawab_username != $this->input->post('username')? '|is_unique[user.username]' : ''),
			// 'password' => $this->input->post('password')? 'required|min_length[6]' : '',
		];

		if(validate($rules))
		{

			// $user = $this->user->find($perusahaan->user_id);

			// $dataUser = [
			// 	'nama' => $this->input->post('nama_penanggungjawab'),
			// 	'username' => $this->input->post('username'),
			// 	'password' => $this->input->post('password')? Hash::make($this->input->post('password')) : $user->password,
			// ];

			// $sv = $this->user->update($dataUser,['id' => $perusahaan->user_id]);
			// if($sv)
			// {	

				$this->perusahaan->update([
					'nama' => $this->input->post('nama_perusahaan'),
					'email' => $this->input->post('email'),
					'telepon' => $this->input->post('telepon'),
				],['id' => $perusahaan->id]);

				set_alert('success','Berhasil mengubah data');
				return redirect('koordinator-pkl/perusahaan');
			// }
			
			// set_alert('error','Gagal mengubah data');
			// return redirect('koordinator-pkl/perusahaan');
            
		}
        modal_session('ModalEdit'.$this->input->post('id'));
        return $this->index();
    }

    public function verifikasi()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $perusahaan = $this->perusahaan->find($this->input->post('id'));

            $this->user->update(['status' => 1],['perusahaan_id' => $perusahaan->id]);
            
			set_alert('success','Berhasil memverifikasi data');
			return redirect('koordinator-pkl/perusahaan');

		}
		set_alert('error','Gagal memverifikasi data');
		return redirect('koordinator-pkl/perusahaan');
    }

    public function tolak()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $perusahaan = $this->perusahaan->find($this->input->post('id'));

            $this->user->update(['status' => 2],['perusahaan_id' => $perusahaan->id]);
            
			set_alert('success','Berhasil memverifikasi data');
			return redirect('koordinator-pkl/perusahaan');

		}
		set_alert('error','Gagal memverifikasi data');
		return redirect('koordinator-pkl/perusahaan');
    }

    public function batal_verifikasi()
    {
        $rules = [
			'id' => 'required',
		];
		
		if(validate($rules))
		{

            $perusahaan = $this->perusahaan->find($this->input->post('id'));

            $this->user->update(['status' => 0],['perusahaan_id' => $perusahaan->id]);
            
			set_alert('success','Berhasil memverifikasi data');
			return redirect('koordinator-pkl/perusahaan');

		}
		set_alert('error','Gagal memverifikasi data');
		return redirect('koordinator-pkl/perusahaan');
    }

}