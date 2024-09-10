<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $withCredential = true;

	public $roleAccept = null;

	public function __construct()
	{
		parent::__construct();

		if($this->withCredential)
		{
			$this->initialize();
		}
	}

	public function initialize()
	{
		if(!Auth::check())
		{
			return show_404();
		}

		if($this->roleAccept != null)
		{
			$user = Auth::user();

			if(is_array($this->roleAccept))
			{
				if(!$user || !in_array($user->role_id, $this->roleAccept))
				{
					return show_error("Anda tidak memiliki akses ke halaman ini <a href=\"".base_url('')."\">Beranda</a>",403,"Akses Ditolak");
				}
			}else{
				if(!$user || $user->role_id != $this->roleAccept)
				{
					return show_error("Anda tidak memiliki akses ke halaman ini <a href=\"".base_url('')."\">Beranda</a>",403,"Akses Ditolak");
				}
			}

		}

	}

	public function init_guard()
	{
		if(Auth::check())
		{
			$user = Auth::user();
			redirect(slugify($user->role));
		}
	}
}

/* End of file Controller.php */