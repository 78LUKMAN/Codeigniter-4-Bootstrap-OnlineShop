<?php

namespace App\Controllers;

use App\Models\userModel;

class AuthController extends BaseController
{
	protected $user;

	function __construct()
	{
		helper('form');
		$this->user = new userModel();
	}

	public function signup()
	{
		if ($this->request->getMethod() === 'post') {
			$rules = [
				'username' => 'required',
				'password' => 'required'
			];

			if ($this->validate($rules)) {
				$data = [
					'username' => $this->request->getPost('username'),
					// Menggunakan enkripsi md5
					'password' => md5($this->request->getPost('password')),
					'role' => "guest"
				];

				$this->user->insert($data);

				return redirect()->to('login')->with('success', 'Sign up successful! Please login.');
			} else {
				return redirect()->back()->withInput()->with('failed', 'Sign up failed! Please try again.');
			}
		}

		return view('v_signup');
	}


	public function login()
	{
		if ($this->request->getPost()) {
			$username = $this->request->getVar('username');
			$password = $this->request->getVar('password');

			$dataUser = $this->user->where(['username' => $username])->first();

			if ($dataUser) {
				if (md5($password) == $dataUser['password']) {
					session()->set([
						'username' => $dataUser['username'],
						'role' => $dataUser['role'],
						'email' => $dataUser['email'],
						'phone' => $dataUser['phone'],
						'address' => $dataUser['address'],
						'isLoggedIn' => TRUE
					]);
					session()->set('userData', $dataUser);

					return redirect()->to(base_url('/'));
				} else {
					session()->setFlashdata('failed', 'Username & Password Salah');
					return redirect()->back();
				}
			} else {
				session()->setFlashdata('failed', 'Username Tidak Ditemukan');
				return redirect()->back();
			}
		} else {
			return view('v_login');
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('login');
	}
}