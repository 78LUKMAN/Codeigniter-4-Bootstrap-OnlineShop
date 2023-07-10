<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\ProdukModel;

class AdminController extends BaseController
{

    protected $transaksiModel;
    protected $detailTransaksiModel;
    protected $dataProdukModel;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->transaksiModel = new TransaksiModel();
        $this->detailTransaksiModel = new TransaksiDetailModel();
        $this->dataProdukModel = new ProdukModel();
    }
    public function index()
    {
        $data['users'] = $this->userModel->findAll();

        return view('v_users', $data);
    }
    public function tambahUser()
    {
        $data = $this->request->getPost();
        $errors = $this->validation->getErrors();
        $newPassword = $this->request->getPost('password');
        $Confirmassword = $this->request->getPost('confirm_password');

        if (!$errors) {
            $dataForm = [
                'username' => $this->request->getPost('username'),
                'password' => md5($this->request->getPost('password')),
                'role' => "guest"
            ];

            if ($newPassword == $Confirmassword) {
                $this->userModel->insert($dataForm);
                return redirect('users')->with('success', 'Data Berhasil Ditambah');
            }  else {
                return redirect('users')->with('failed', 'Gagal Menambahkan Data');
            }
            
        } else {
            return redirect('users')->with('failed', implode("<br>", $errors));
        }
    }
    public function editPassword($id)
    {

        if ($this->request->getMethod() === 'post') {
            $newPassword = $this->request->getPost('password');
            $confirmPassword = $this->request->getPost('confirm_password');

            if ($newPassword === $confirmPassword) {
                // update pwd user didb
                $this->userModel->update($id, ['password' => md5($newPassword)]);

                // menampilkan pesan 
                session()->setFlashData('success', 'Password Berhasil Diupdate.');
            } else {
                session()->setFlashData('failed', 'New Password Dan Confirm Password Tidak Sesuai.');
            }
        }

        return redirect()->to('/users');
    }

    public function deleteUser($id)
    {

        // Hapus user dari database
        $this->userModel->delete($id);

        // menampilkan pesan jika berhasil menghapus user

        return redirect('users')->with('success', 'Akun pengguna berhasil dihapus.');
    }

    // manajemen riwayat semua user (hanya untuk admin)
    public function tampilkanRiwayatSemuaUser()
    {
        // Mendapatkan ID user dari data user saat ini (sesuaikan dengan implementasi Anda)
        $getTransaksi = $this->transaksiModel->findAll();
        $getDetailTransaksi = $this->detailTransaksiModel->findAll();
        $getDetailPoduk = $this->dataProdukModel->findAll();
        
        $data = [
            'transaksi' => $getTransaksi,
            'detailTransaksiData' => $getDetailTransaksi,
            'detailProduk' => $getDetailPoduk
        ];

        return view('v_riwayatUsers', $data);
    }



    public function editStatus($id)
    {

        if ($this->request->getMethod() === 'post') {
            $newStatus = $this->request->getPost('new_status');

            // update pwd user didb
            $this->transaksiModel->update($id, ['status' => ($newStatus)]);
            // menampilkan pesan 
            session()->setFlashData('success', 'Status transaksi berhasil diubah.');
        } else {
            session()->setFlashData('failed', 'Gagal mengubah status transaksi.');
        }

        return redirect()->to('/transaksi');
    }

}