<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public $roleAccept = 4;

	public function __construct()
	{
		parent::__construct();
	}
    
    public function index()
    {
        return view('mahasiswa.dashboard');
    }

}