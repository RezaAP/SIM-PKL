<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {

	public $roleAccept = [1,2,3,4];

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PerusahaanModel','perusahaan');
	}

    public function index()
    {
        $role = auth()->user()->role_id;
        if($role == '1')
        {
            $rules = [
                'nama' => 'required',
            ];
        }elseif($role == '2')
        {
            $rules = [
                'nama' => 'required',
            ];
        }elseif($role == '3')
        {
            $rules = [
                'nama' => 'required',
                'no_telepon' => 'required',
                // 'nip' => 'required',
            ];
        }elseif($role == '4')
        {
            $rules = [
                'nama' => 'required',
                // 'nim' => 'required',
            ];
        }

        if($this->input->post('password'))
        {
            $rules['password'] = 'required|min_length[6]';
            $rules['konfirmasi_password'] = 'required|min_length[6]|matches[password]';
        }

		if(validate($rules))
		{

            $data = [
                'nama' => $this->input->post('nama'),
                'no_telepon' => $this->input->post('no_telepon'),
            ];

            if($this->input->post('password'))
            {
                $data['password'] = Hash::make($this->input->post('password'));
            }

            $sv = $this->user->update($data,['id' => auth()->id()]);
            if($sv)
            {
                set_alert('success','Berhasil mengubah profil');
                return redirect('profil');
            }

            set_alert('error','Gagal mengubah profil');
            return redirect('profil');
        }else{
            $data['data'] = Auth::user();
            return view('profil',$data);
        }
    }


}