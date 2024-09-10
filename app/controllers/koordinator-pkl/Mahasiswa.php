<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    public $roleAccept = 1;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PembimbingModel' => 'pembimbing','LaporanAkhirModel' => 'laporan_akhir','PengajuanModel' => 'pengajuan','DokumenPengajuanModel' => 'dokumen_pengajuan']);
	}
    
    public function index()
    {
        // $data['data'] = $this->pengajuan->where('pengajuan.status = 1')->get;
		$data = $this->pembimbing->all();

		$index = 0;
        $datas = new stdClass;
        foreach($data as $r => $val)
        {
            $dokumen = $this->laporan_akhir->where(['pembimbing_id' => $val->id])->get;
            $datas->{$index} = $val;
            $datas->{$index}->laporan_akhir = $dokumen;
            $index++;

        }
		
        $data['data'] = $datas;
        $data['pembimbing'] = $this->user->where(['role_id' => 3])->get;
        return view('koordinator-pkl.mahasiswa.index',$data);
    }
    
	public function create()
    {
        // $data['data'] = $this->pengajuan->where('pengajuan.status = 1')->get;
        $data['data'] = $this->pembimbing->all();
        // $data['pembimbing'] = $this->user->where(['role_id' => 3])->get;
        return view('koordinator-pkl.mahasiswa.create',$data);
    }
	
	public function pkl()
    {
        // $data['data'] = $this->pengajuan->where('pengajuan.status = 1')->get;
		// $_GET['status'] = $this->input->get('status') != ''? $this->input->get('status') : "!NULL";
		$pengajuan = $this->pengajuan->all();
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
        // $data['data'] = $this->pembimbing->all();
        $data['pembimbing'] = $this->user->where(['role_id' => 3])->get;
        return view('koordinator-pkl.mahasiswa.pkl',$data);
    }

	public function penilaian()
    {
		// $perusahaan = $this->perusahaan->where(['user_id' => auth()->id()])->first;
        $daftar_pkl = $this->pengajuan->where('pengajuan.status = 1')->get;
		$index = 0;
		$datas = new stdClass;
        foreach($daftar_pkl as $val)
        {
            $dokumen = $this->laporan_akhir->where(['pembimbing_id' => $val->pembimbing_id])->get;
            $datas->{$index} = $val;
            $datas->{$index}->laporan_akhir = $dokumen;
            $index++;

        }
		$data['data'] = $datas;
        return view('koordinator-pkl.mahasiswa.penilaian',$data);
    }

    public function store()
    {
        $rules = [
			'pembimbing' => '',
			'nama' => 'required',
			'nim' => 'required',
			'jurusan' => 'required',
			'username' => 'required|min_length[5]|max_length[20]|is_unique[user.username]',
			'password' => 'required|min_length[6]',
		];

		if(validate($rules))
		{

			$dataUser = [
                'nama' => $this->input->post('nama'),
				'nim' => $this->input->post('nim'),
				'jurusan' => $this->input->post('jurusan'),
				'username' => $this->input->post('username'),
				'password' => Hash::make($this->input->post('password')),
				'role_id' => 4,
                'status' => 1
			];

			$sv = $this->user->create($dataUser);
			if($sv)
			{	
                $user_id = $sv->id;

                $dataPembimbing = [
                    'dosen_id' => $this->input->post('pembimbing')? $this->input->post('pembimbing') : null,
                    'user_id' => $user_id,
                ];

                $this->pembimbing->create($dataPembimbing);

				set_alert('success','Berhasil menambahkan data');
				return redirect('koordinator-pkl/mahasiswa/create');
			}
			
			set_alert('error','Gagal menambahkan data');
			return redirect('koordinator-pkl/mahasiswa/create');
            
		}
        modal_session('ModalAdd');
        return $this->create();
    }
    
    public function update()
    {
        $user = $this->user->find($this->input->post('id'));

        $rules = [
			'id' => 'required',
            // 'pembimbing' => '',
			'nama' => 'required',
			'nim' => 'required',
			'jurusan' => 'required',
			// 'username' => 'required|min_length[5]|max_length[20]'.($user && $user->username != $this->input->post('username')? '|is_unique[user.username]' : ''),
			'username' => 'required|min_length[5]|max_length[20]',
			'password' => $this->input->post('password')? 'required|min_length[6]' : '',
		];

		if(validate($rules))
		{

			$dataUser = [
				'nama' => $this->input->post('nama'),
				'nim' => $this->input->post('nim'),
				'jurusan' => $this->input->post('jurusan'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password')? Hash::make($this->input->post('password')) : $user->password,
			];

			// $cekDosen = $this->pembimbing->where(['pembimbing.user_id' => $this->input->post('id')])->first;

			// dd($cekDosen);

			$sv = $this->user->update($dataUser,['id' => $this->input->post('id')]);
			if($sv)
			{	


                if($this->input->post('pembimbing'))
                {
                    $this->pembimbing->update(['dosen_id' => $this->input->post('pembimbing')],['user_id' => $this->input->post('id')]);
					set_alert('success','Berhasil mengubah data');
					return redirect('koordinator-pkl/mahasiswa/pkl');
                }

				set_alert('success','Berhasil mengubah data');
				return redirect('koordinator-pkl/mahasiswa');
			}
			
			set_alert('error','Gagal mengubah data');
			return redirect('koordinator-pkl/mahasiswa');
            
		}
        modal_session('ModelEdit'.$this->input->post('id'));
        return $this->index();
    }
   
    public function destroy()
    {
        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{
			// $cekDosen = $this->pembimbing->where(['id' => $this->input->post('id')])->first;
            $this->pembimbing->delete(['user_id' => $this->input->post('id')]);
			$sv = $this->user->delete(['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menghapus data');
				return redirect('koordinator-pkl/mahasiswa');
			}
			
			set_alert('error','Gagal menghapus data');
			return redirect('koordinator-pkl/mahasiswa');
            
		}
        modal_session('ModalDelete'.$this->input->post('id'));
        return $this->index();
    }

	public function template_import()
	{
		
		$spreadsheet    = IOFactory::load(FCPATH.'/assets/template-import/template-import-mahasiswa.xlsx');
		$spreadsheet->setActiveSheetIndex(0);		

		// $pembimbing = $this->user->where(['role_id' => 3])->get;
		
		// $worksheet      = $spreadsheet->getActiveSheet();
		// $row = 2;
		// foreach ($pembimbing  as $key => $value) {
		// 	$worksheet->getCell("A{$row}")->setValue($value->id);
		// 	$worksheet->getCell("B{$row}")->setValue($value->nama);
		// 	$worksheet->getCell("C{$row}")->setValue($value->nip);
		// 	$row++;
		// }

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Template Import Mahasiswa.xlsx"');
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
				return redirect('koordinator-pkl/mahasiswa');
			}

			$dataImport = [];

			foreach($data as $d){
				$cekUsername = $this->user->where("username = '{$d[3]}' OR nim = '{$d[1]}'")->first;
				if($d[1] && $d[2] && $d[3] && !$cekUsername)
				{
					$dataImport[] = [
						'nama' => $d[1],
						'nim' => $d[2],
						'jurusan' => $d[3],
						'username' => $d[2],
						'password' => Hash::make($d[2]),
						'role_id' => 4,
						'status' => 1
					];
				}
			}

			@unlink(FCPATH.$path_file);
			if(count($data) == count($dataImport))
			{
				$successDataImport = 0;
				foreach($data as $d){
					$cekUsername = $this->user->where("username = '{$d[3]}' OR nim = '{$d[1]}'")->first;
					if($d[1] && $d[2] && $d[3] && !$cekUsername)
					{
						$dataInsert = [
							'nama' => $d[1],
							'nim' => $d[2],
							'jurusan' => $d[3],
							'username' => $d[2],
							'password' => Hash::make($d[2]),
							'role_id' => 4,
							'status' => 1
						];
						$sv = $this->user->create($dataInsert);
						if($sv)
						{
							$dataPembimbing = [
								'dosen_id' => null,
								'user_id' => $sv->id,
							];
			
							$this->pembimbing->create($dataPembimbing);
							$successDataImport++;
						}
					}
				}
				if(count($data) == $successDataImport)
				{	

					set_alert('success','Berhasil mengimport data');
					return redirect('koordinator-pkl/mahasiswa');
				}
				
				set_alert('error','Gagal mengimport data');
				return redirect('koordinator-pkl/mahasiswa');
			}

			set_alert('error','Gagal mengimport data, pastikan data sudah diisi dengan benar dan tidak ada username atau nim yang sama');
			return redirect('koordinator-pkl/mahasiswa');
		}

		set_alert('error','Gagal mengupload file, pastikan file sudah sesuai template');
		return redirect('koordinator-pkl/mahasiswa');

	}

}