<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public $withCredential = false;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->init_guard();

		$rules = [
			'username' => 'required',
			'password' => 'required',
		];
		if(validate($rules))
		{

			$dataUser = $this->user->where(['username' => $this->input->post('username')])->row();
			if($dataUser && (Hash::check($this->input->post('password'),$dataUser->password)))
			{

				if($dataUser->status == 0)
				{
					set_alert('error','Akun anda belum diverifikasi');
					return redirect('login');
				}elseif($dataUser->status == 2)
				{
					set_alert('error','Verifikasi akun anda ditolak, mohon menghubungi admin');
					return redirect('login');
				}

				Auth::login($dataUser);

				return redirect(slugify($dataUser->role));
			}

			set_alert('error','Username atau Password yang anda masukkan salah');
			return redirect('login');

		}else{
			return view('auth.login');
		}
	}

	// public function register()
	// {
	// 	$this->init_guard();
		
	// 	$rules = [
	// 		'name' => 'required',
	// 		'email' => 'required|valid_email|is_unique[users.email]',
	// 		'address' => 'required',
	// 		'phone_number' => 'required',
	// 		'username' => 'required|min_length[5]|max_length[10]',
	// 		'password' => 'required|min_length[6]',
	// 		'konfirmasi_password' => 'required|min_length[6]|matches[password]',
	// 	];

	// 	if(validate($rules))
	// 	{
	// 		$data = [
	// 			'name' => $this->input->post('name'),
	// 			'email' => $this->input->post('email'),
	// 			'address' => $this->input->post('address'),
	// 			'phone_number' => $this->input->post('phone_number'),
	// 			'username' => $this->input->post('username'),
	// 			'password' => Hash::make($this->input->post('password')),
	// 		];

	// 		// var_dump(Hash::check($this->input->post('password'),$data['password']));die;

	// 		if($this->user->create($data))
	// 		{
	// 			set_alert('success','Berhasil mendaftar, silahkan login');
	// 			return redirect('login');
	// 		}
			
	// 		set_alert('error','Gagal mendaftar');
	// 		return redirect('register');

	// 	}else{
	// 		return view('auth.register');
	// 	}
	// }

	public function logout()
	{
		Auth::logout();
		return redirect('');
	}
	
	// public function forgot_password()
	// {
	// 	$this->init_guard();

	// 	$rules = [
	// 		'email' => 'required|valid_email',
	// 	];

	// 	if(validate($rules))
	// 	{

	// 		$cekEmail = $this->user->where(['email' => $this->input->post('email')])->first;
	// 		if($cekEmail)
	// 		{

	// 			$currentDate = date('Y-m-d H:i:s');

	// 			$cekForgot = $this->DataResetPassword->where("user_id = '{$cekEmail->id}' AND expired > '{$currentDate}'")->first;
	// 			if($cekForgot)
	// 			{
	// 				set_alert('error','Anda telah mengirim link reset password sebelumnya, silahkan cek email anda');
	// 				return redirect('forgot-password');
	// 			}

	// 			$token = random_string('alnum', 50);

	// 			$svDataReset = $this->DataResetPassword->create([
	// 				'user_id' => $cekEmail->id,
	// 				'token' => $token,
	// 				'expired' => date('Y-m-d H:i:s',strtotime('+3 days',strtotime(date('Y-m-d H:i:s'))))
	// 			]);

	// 			$svDataReset->user = $cekEmail;

	// 			$body = $this->load->view('mail/reset-password',$svDataReset,true);
	// 			Mail::send('Permintaan pengaturan ulang kata sandi',$this->input->post('email'),$body);

	// 			set_alert('success','Kami telah mengirim link untuk mengatur ulang kata sandi anda.');
	// 			return redirect('forgot-password?send=true');
	// 		}

	// 		set_alert('error','Email yang anda masukkan tidak terdaftar');
	// 		return redirect('forgot-password');


	// 	}else{
			
	// 		return view('auth.forgot-password');
	// 	}
	// }

	// public function reset_password($token)
	// {
	// 	$this->init_guard();

	// 	$currentDate = date('Y-m-d H:i:s');

	// 	$cekForgot = $this->DataResetPassword->where("token = '{$token}' AND expired > '{$currentDate}'")->first;
	// 	if(!$cekForgot)
	// 	{
	// 		return show_404();
	// 	}

	// 	$rules = [
	// 		'password' => 'required|min_length[6]',
	// 		'konfirmasi_password' => 'required|min_length[6]|matches[password]',
	// 	];

	// 	if(validate($rules))
	// 	{

	// 		$cekUser = $this->user->find($cekForgot->user_id);
	// 		if($cekUser)
	// 		{
	// 			$this->user->update([
	// 				'password' => Hash::make($this->input->post('password'))
	// 			],['id' => $cekUser->id]);

	// 			$this->DataResetPassword->delete(['user_id' => $cekUser->id]);
				
	// 			set_alert('success','Password berhasil diperbaharui silahkan login');
	// 			return redirect('login');
	// 		}
			
	// 		$this->DataResetPassword->delete(['user_id' => $cekUser->id]);

	// 		set_alert('error','Gagal memperbaharui password');
	// 		return redirect('login');


	// 	}else{
			
	// 		return view('auth.reset-password');
	// 	}
	// }
}
