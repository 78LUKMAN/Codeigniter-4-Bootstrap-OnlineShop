<?php
namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
    }

    public function profile()
    {
        // Ambil id pengguna yang sedang login (sesuaikan dengan implementasi login Anda)
        $userId = session()->get('user_id');

        // Ambil data pengguna dari database
        $userModel = new UserModel();
        $userData = $userModel->find($userId);

        // Kirim data pengguna ke tampilan
        $data['userData'] = $userData;

        return view('v_profile', $data);
    }

    public function updatePassword()
    {
        $validationRules = [
            'currentPassword' => 'required',
            'newPassword' => 'required|min_length[6]',
            'renewPassword' => 'required|matches[newPassword]'
        ];

        if ($this->validate($validationRules)) {
            $currentPassword = $this->request->getPost('currentPassword');
            $newPassword = $this->request->getPost('newPassword');

            // Mendapatkan ID pengguna dari data pengguna
            $userData = session('userData');
            if (!$userData) {
                return redirect()->back()->with('pwd-error', 'User data not found in session.');
            }

            $userId = $userData['id'];


            // Mendapatkan data pengguna dari database berdasarkan ID
            $user = $this->userModel->find($userId);

            if (!$user) {
                return redirect()->back()->with('pwd-error', 'User not found.');
            }

            // Memverifikasi password saat ini
            if (md5($currentPassword) != $user['password']) {
                return redirect()->back()->with('pwd-error', 'Incorrect current password.');
            }

            // Mengubah password baru
            $data = [
                'password' => md5($newPassword)
            ];
            $upPwd = $this->userModel->update($userId, $data);
            if ($upPwd) {
                return redirect()->to('profile')->with('pwd-success', 'Password successfully updated.');
            }
        } else {
            return redirect()->back()->withInput()->with('pwd-errors', $this->validator->getErrors());
        }
    }


    public function edit()
    {
        $validationRules = [
            'username' => 'required',
            'email' => 'required|valid_email',
            'phone' => 'required',
            'address' => 'required'
        ];

        if ($this->validate($validationRules)) {
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $phone = $this->request->getPost('phone');
            $address = $this->request->getPost('address');

            // Get the user ID from the user data in the session
            $userData = session('userData');
            if (!$userData) {
                return redirect()->back()->with('pro-error', 'User data not found in session.');
            }
            $userId = $userData['id'];

            // Get the user data from the database based on the ID
            $user = $this->userModel->find($userId);
            if (!$user) {
                return redirect()->back()->with('pro-error', 'User not found.');
            }

            // Update the user data
            $user['username'] = $username;
            $user['email'] = $email;
            $user['phone'] = $phone;
            $user['address'] = $address;

            $updated = $this->userModel->save($user);

            if ($updated) {
                return redirect()->to('profile')->with('pro-success', 'Profile data successfully updated.');
            } else {
                return redirect()->to('profile')->with('pro-failed', 'Failed to update profile data.');
            }
        } else {
            return redirect()->back()->withInput()->with('pro-errors', $this->validator->getErrors());
        }
    }

}