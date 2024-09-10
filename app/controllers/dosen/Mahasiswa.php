<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    public $roleAccept = 3;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PembimbingModel' => 'pembimbing','PengajuanModel' => 'pengajuan','DokumenPengajuanModel' => 'dokumen_pengajuan','LaporanAkhirModel' => 'laporan_akhir']);
	}
    
    public function index()
    {
        $mahasiswa = $this->pembimbing->where(['dosen_id' => auth()->id()])->get;
		$index = 0;
        $datas = new stdClass;
        foreach($mahasiswa as $r => $val)
        {
            $perusahaan = $this->pengajuan->where(['pengajuan.pembimbing_id' => $val->id])->first;
            $datas->{$index} = $val;
            $datas->{$index}->perusahaan = $perusahaan? $perusahaan->perusahaan : '';
            $index++;

        }
		$data['data'] = $datas;
        return view('dosen.mahasiswa.index',$data);
    }

    public function store()
    {
        $rules = [
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
                    'dosen_id' => auth()->id(),
                    'user_id' => $user_id,
                ];

                $this->pembimbing->create($dataPembimbing);

				set_alert('success','Berhasil menambahkan data');
				return redirect('dosen/mahasiswa');
			}
			
			set_alert('error','Gagal menambahkan data');
			return redirect('dosen/mahasiswa');
            
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
			'nim' => 'required',
			'jurusan' => 'required',
			'username' => 'required|min_length[5]|max_length[20]'.($user && $user->username != $this->input->post('username')? '|is_unique[user.username]' : ''),
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

			$sv = $this->user->update($dataUser,['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil mengubah data');
				return redirect('dosen/mahasiswa');
			}
			
			set_alert('error','Gagal mengubah data');
			return redirect('dosen/mahasiswa');
            
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
            $this->pembimbing->delete(['user_id' => $this->input->post('id')]);
			$sv = $this->user->delete(['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menghapus data');
				return redirect('dosen/mahasiswa');
			}
			
			set_alert('error','Gagal menghapus data');
			return redirect('dosen/mahasiswa');
            
		}
        modal_session('ModalDelete'.$this->input->post('id'));
        return $this->index();
    }
    
	public function nilai()
    {
        $rules = [
			'id' => 'required',
			'nilai' => 'required'
		];

		if(validate($rules))
		{
            $sv = $this->pembimbing->update(['nilai' => $this->input->post('nilai')],['user_id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menilai mahasiswa');
				return redirect('dosen/mahasiswa');
			}
			
			set_alert('error','Gagal menilai mahasiswa');
			return redirect('dosen/mahasiswa');
            
		}
        modal_session('ModalNilai'.$this->input->post('id'));
        return $this->index();
    }


	public function penilaian()
    {
        $daftar_pkl = $this->pengajuan->where('pengajuan.status = 1 AND pembimbing.dosen_id = '.auth()->id())->get;
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
        return view('dosen.mahasiswa.penilaian',$data);
    }

}