<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends MY_Controller {

    public $roleAccept = 3;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['BimbinganModel' => 'bimbingan','PembimbingModel' => 'pembimbing']);
	}
    
    public function index()
    {
        $data['data'] = $this->bimbingan->where(['dosen_id' => auth()->id()])->get;
        return view('dosen.bimbingan.index',$data);
    }

    public function tolak()
    {
        $rules = [
			'id' => 'required',
            // 'alasan' => 'required'
		];

		if(validate($rules))
		{
			$sv = $this->bimbingan->update(['status' => '2'],['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menolak bimbingan');
				return redirect('dosen/bimbingan');
			}
			
			set_alert('error','Gagal menolak bimbingan');
			return redirect('dosen/bimbingan');
            
		}
        modal_session('ModalTolak'.$this->input->post('id'));
        return $this->index();
    }

    public function terima()
    {
        $rules = [
			'id' => 'required',
            'catatan' => ''
		];

		if(validate($rules))
		{
			$sv = $this->bimbingan->update(['status' => '1'],['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menerima bimbingan');
				return redirect('dosen/bimbingan');
			}
			
			set_alert('error','Gagal menerima bimbingan');
			return redirect('dosen/bimbingan');
            
		}
        modal_session('ModalTerima'.$this->input->post('id'));
        return $this->index();
    }

}