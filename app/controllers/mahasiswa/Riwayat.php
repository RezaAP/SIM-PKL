<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends MY_Controller {

    public $roleAccept = 4;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan','DokumenPengajuanModel' => 'dokumen_pengajuan','PembimbingModel' => 'pembimbing']);
	}
    
    public function index()
    {
        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;

        $riwayat = $this->pengajuan->where(['pembimbing_id' => $pembimbing->id])->get;
        $index = 0;
        $datas = new stdClass;
        foreach($riwayat as $r => $val)
        {
            $dokumen = $this->dokumen_pengajuan->where(['pengajuan_id' => $val->id])->get;
            $datas->{$index} = $val;
            $datas->{$index}->dokumen = $dokumen;
            $index++;

        }
        $data['data'] = $datas;
        return view('mahasiswa.riwayat.index',$data);
    }

    public function upload_dokumen()
    {
        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;

        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{

            $pengajuan_id = $this->input->post('id');

            if($_FILES['dokumen'])
            {
                $uploadDokumen = file_store('dokumen','mahasiswa/'.auth()->id().'/lowongan');
                if($uploadDokumen['status'])
                {
                    $fileData = $uploadDokumen['data'];
                    
                    $dokumen = [];
                    foreach($fileData as $doc){
                        $dokumen[] = [
                            'pengajuan_id' => $pengajuan_id,
                            'dokumen' => $doc['full_path'],
                            'nama_dokumen' => $doc['name']
                        ];
                    }

                    $this->dokumen_pengajuan->insert($dokumen);

                    // $data = [
                    //     'dokumen' => $dokumen
                    // ];
        
                    // $this->pengajuan->update($data,['id' => $this->input->post('id'),'pembimbing_id' => $pembimbing->id]);
        
                    set_alert('success','Berhasil mengupload dokumen');
                    return redirect('mahasiswa/riwayat');
                
                }
            }
            set_alert('error','Gagal mengupload dokumen');
            return redirect('mahasiswa/riwayat');
            
		}
    }

}