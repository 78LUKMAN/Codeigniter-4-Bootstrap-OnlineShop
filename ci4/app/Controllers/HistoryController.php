<?php
namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\ProdukModel;

class HistoryController extends BaseController
{
    protected $transaksiModel;
    protected $detailTransaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->detailTransaksiModel = new TransaksiDetailModel();
        $this->dataProdukModel = new ProdukModel();

    }

    public function index()
    {
        // Mendapatkan ID user dari data user saat ini (sesuaikan dengan implementasi Anda)
        $userId = session()->get('username');

        // Mendapatkan transaksi berdasarkan ID user
        $transaksi = $this->transaksiModel->where('username', $userId)->findAll();

        $getDetailPoduk = $this->dataProdukModel->findAll();

        // Mendapatkan detail transaksi berdasarkan ID user
        $detailTransaksi = $this->detailTransaksiModel->where('created_by', $userId)->findAll();

        $data = [
            'transaksi' => $transaksi,
            'detailTransaksiData' => $detailTransaksi,
            'detailProduk' => $getDetailPoduk
        ];

        return view('v_riwayat', $data);
    }
}
