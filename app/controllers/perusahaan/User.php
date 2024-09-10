<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public $roleAccept = 2;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PerusahaanModel' => 'perusahaan']);
	}
    
    public function index()
    {
		$perusahaan_id = auth()->user()->perusahaan_id;
        $data['data'] = $this->user->where(['perusahaan_id' => $perusahaan_id,'role_id' => 2])->result();
        return view('perusahaan.user.index',$data);
    }

    public function store()
    {
        $rules = [
			'nama' => 'required',
			'jabatan' => 'required',
			'username' => 'required|min_length[5]|max_length[20]|is_unique[user.username]',
			'password' => 'required|min_length[6]',
		];

		if(validate($rules))
		{

			$perusahaan_id = auth()->user()->perusahaan_id;
			// $perusahaan = $this->perusahaan->where(['id' => auth()->id()])->first;

			$data = [
				'perusahaan_id' => $perusahaan_id,
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'password' => Hash::make($this->input->post('password')),
				// 'alamat' => $this->input->post('alamat_perusahaan'),
				'role_id' => 2,
				'status' => 1
			];

			$sv = $this->user->create($data);
			if($sv)
			{	

				set_alert('success','Berhasil menambahkan data');
				return redirect('perusahaan/user');
			}
			
			set_alert('error','Gagal menambahkan data');
			return redirect('perusahaan/user');
            
		}
        modal_session('ModalAdd');
        return $this->index();
    }
    
    public function update()
    {
        $user = $this->user->find($this->input->post('id'));
        $rules = [
			'id' => 'required',
			'nama' => 'required',
			'jabatan' => 'required',
			'username' => 'required'.($user && $user->username != $this->input->post('username')? '|is_unique[user.username]' : ''),
			'password' => '',
		];

		if(validate($rules))
		{

			$data = [
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'jabatan' => $this->input->post('jabatan'),
				'password' => $this->input->post('username')? Hash::make($this->input->post('password')) : $user->password,
			];

			$sv = $this->user->update($data,['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil mengubah data');
				return redirect('perusahaan/user');
			}
			
			set_alert('error','Gagal mengubah data');
			return redirect('perusahaan/user');
            
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
			$sv = $this->user->delete(['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menghapus data');
				return redirect('perusahaan/user');
			}
			
			set_alert('error','Gagal menghapus data');
			return redirect('perusahaan/user');
            
		}
        modal_session('ModalDelete'.$this->input->post('id'));
        return $this->index();
    }

}