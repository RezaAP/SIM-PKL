<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Secret extends MY_Controller {

	public $withCredential = false;

	public function __construct()
	{
		parent::__construct();
	}

    public function seed($token)
    {
        if($token == md5(date('Ymd')))
        {

            $this->roleSeeder();
            $this->userSeeder();


            return dd([
                'status' => true,
                'message' => "Berhasil menjalankan seeder"
            ]);

        }
        return dd([
            'status' => false,
            'message' => "Gagal menjalankan seeder"
        ]);
    }

    private function roleSeeder()
    {

        $data = [
            [
                'id' => 1,
                'nama' => 'Koordinator PKL',
            ],
            [
                'id' => 2,
                'nama' => 'Perusahaan',
            ],
            [
                'id' => 3,
                'nama' => 'Dosen',
            ],
            [
                'id' => 4,
                'nama' => 'Mahasiswa',
            ]
        ];

        $this->role->insert($data);
        
    }
    private function userSeeder()
    {
        
        $data = [
            [
                'username' => 'koordinator-pkl',
                'nama' => 'Koordinator PKL',
                'password' => Hash::make('koordinator-pkl'),
                'role_id' => 1,
                'status' => 1
            ]
        ];

        $this->user->insert($data);

    }

}