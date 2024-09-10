<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

    public $roleAccept = 4;

	public function __construct()
	{
		parent::__construct();
        $this->load->model(['PengajuanModel' => 'pengajuan','LaporanAkhirModel' => 'laporan_akhir','PembimbingModel' => 'pembimbing']);
	}

    private function get_pengajuan()
    {
        $pembimbing = $this->pembimbing->where(['user_id' => auth()->id()])->first;
        $pengajuan = $this->pengajuan->where(['pengajuan.pembimbing_id' => $pembimbing->id,'pengajuan.status' => 1])->first;
        return $pengajuan;
    }
    
    public function index()
    {
        $pengajuan = $this->get_pengajuan();

        $data['detail'] = $pengajuan;

        $laporan = [];
        if($pengajuan)
        {
            $laporan = $this->laporan_akhir->where(['pembimbing_id' => $pengajuan->pembimbing_id])->get;
        }

        $data['data'] = $laporan;

        return view('mahasiswa.laporan.index',$data);
    }

    public function upload()
    {
        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{
            if($_FILES['file'])
            {
                $pembimbing_id = $this->input->post('id');
                $uploadDokumen = file_store('file','mahasiswa/'.auth()->id().'/laporan-pkl');
                if($uploadDokumen['status'])
                {
                    $fileData = $uploadDokumen['data'];
                    
                    $dokumen = [];
                    foreach($fileData as $doc){
                        $dokumen[] = [
                            'pembimbing_id' => $pembimbing_id,
                            'dokumen' => $doc['full_path'],
                            'nama_dokumen' => $doc['name']
                        ];
                    }

                    $this->laporan_akhir->insert($dokumen);

                    set_alert('success','Berhasil mengupload laporan PKL');
                    return redirect('mahasiswa/laporan');
                }
            }
        }
    
        set_alert('error','Gagal mengupload laporan PKL');
        return redirect('mahasiswa/laporan');
    }

    public function destroy()
    {
        $rules = [
			'id' => 'required',
		];

		if(validate($rules))
		{

            $sv = $this->laporan_akhir->delete(['id' => $this->input->post('id')]);
			if($sv)
			{	

				set_alert('success','Berhasil menghapus data');
				return redirect('mahasiswa/laporan');
			}
			
			set_alert('error','Gagal menghapus data');
			return redirect('mahasiswa/laporan');

        }

    }

    public function unduh_template()
    {
        $spreadsheet    = IOFactory::load(FCPATH.'/assets/template-import/template-penilaian.xlsx');
		$spreadsheet->setActiveSheetIndex(0);		
        $worksheet      = $spreadsheet->getActiveSheet();

        // $user = auth()->user();
        // $worksheet->getCell("F16")->setValue($user->nama);		
        // $worksheet->getCell("F17")->setValue($user->nim);		
        // $worksheet->getCell("F18")->setValue($user->jurusan);		

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="FORM 4 - Form Penilaian - Pembimbing Lapangan 3 bulan.xlsx"');
		$writer->save('php://output');
    }

}