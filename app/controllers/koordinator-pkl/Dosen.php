<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {

    public $roleAccept = 1;

	public function __construct()
	{
		parent::__construct();
	}
    
    public function index()
    {
        $data['data'] = $this->user->where(['role_id' => 3])->get;
        return view('koordinator-pkl.dosen.index',$data);
    }

    public function store()
    {
        $rules = [
			'nama' => 'required',
			'nip' => 'required',
			'no_telepon' => 'required',
			'username' => 'required|min_length[5]|max_length[20]|is_unique[user.username]',
			'password' => 'required|min_length[6]',
		];

		if(validate($rules))
		{

			$dataUser = [
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'no_telepon' => $this->input->post('no_telepon'),
				'password' => Hash::make($this->input->post('password')),
				'role_id' => 3,
                'status' => 1
			];

			$sv = $this->user->create($dataUser);
			if($sv)
			{	

				set_alert('success','Berhasil menambahkan data');
				return redirect('koordinator-pkl/dosen');
			}
			
			set_alert('error','Gagal menambahkan data');
			return redirect('koordinator-pkl/dosen');
            
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
			'nip' => 'required',
			'no_telepon' => 'required',
			'username' => 'required|min_length[5]|max_length[20]'.($user && $user->username != $this->input->post('username')? '|is_unique[user.username]' : ''),
			'password' => $this->input->post('password')? 'required|min_length[6]' : '',
		];

		if(validate($rules))
		{

			$dataUser = [
				'username' => $this->input->post('username'),
				'nama' => $this->input->post('nama'),
				'nip' => $this->input->post('nip'),
				'no_telepon' => $this->input->post('no_telepon'),
				'password' => $this->input->post('password')? Hash::make($this->input->post('password')) : $user->password,
			];

			$sv = $this->user->update($dataUser,['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil mengubah data');
				return redirect('koordinator-pkl/dosen');
			}
			
			set_alert('error','Gagal mengubah data');
			return redirect('koordinator-pkl/dosen');
            
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
				return redirect('koordinator-pkl/dosen');
			}
			
			set_alert('error','Gagal menghapus data');
			return redirect('koordinator-pkl/dosen');
            
		}
        modal_session('ModalDelete'.$this->input->post('id'));
        return $this->index();
    }

	public function template_import()
	{
		
		$spreadsheet    = IOFactory::load(FCPATH.'/assets/template-import/template-import-dosen.xlsx');
		$spreadsheet->setActiveSheetIndex(0);		
		
		// $worksheet      = $spreadsheet->getActiveSheet();
		// $row 						= 3;
		// foreach ($data  as $key => $value) {
		// 	$worksheet->getCell("A{$row}")->setValue($value->id);
		// 	$row++;
		// }

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Template Import Dosen.xlsx"');
		$writer->save('php://output');

	}

	public function import()
	{
		$uploadFile = file_store('file','import-cache');
		if($uploadFile['status'])
		{
			$fileData = $uploadFile['data'];
			$path_file = $fileData['full_path'];

			$reader          	= new Xlsx();
			$spreadsheet      	= $reader->load(FCPATH.$path_file);
			$data        		= $spreadsheet->getSheet(0)->toArray();

			unset($data[0]);

			if(count($data) == 0)
			{
				set_alert('error','Gagal mengimport data, pastikan data sudah terisi dengan benar');
				return redirect('koordinator-pkl/dosen');
			}

			$dataImport = [];

			foreach($data as $d){
				$cekUsername = $this->user->where("username = '{$d[2]}' OR nip = '{$d[2]}'")->first;
				if($d[1] && $d[2] && !$cekUsername)
				{
					$dataImport[] = [
						'nama' => $d[1],
						'nip' => $d[2],
						'no_telepon' => $d[3],
						'username' => $d[2],
						'password' => Hash::make($d[2]),
						'role_id' => 3,
						'status' => 1
					];
				}
			}

			@unlink(FCPATH.$path_file);
			if(count($data) == count($dataImport))
			{
				$sv = $this->user->insert($dataImport);
				if($sv)
				{	

					set_alert('success','Berhasil mengimport data');
					return redirect('koordinator-pkl/dosen');
				}
				
				set_alert('error','Gagal mengimport data');
				return redirect('koordinator-pkl/dosen');
			}

			set_alert('error','Gagal mengimport data, pastikan data sudah diisi dengan benar dan tidak ada username atau nip yang sama');
			return redirect('koordinator-pkl/dosen');
		}

		set_alert('error','Gagal mengupload file, pastikan file sudah sesuai template');
		return redirect('koordinator-pkl/dosen');

	}

}