<?php

		namespace App\Controllers;
		use App\Models\ProdukModel;

		class Produk extends BaseController
		{
			public function produk()
			{
				$produkModel = new ProdukModel(); 
				$produk = $produkModel->findAll();
				$data['produks'] = $produk;
				
				return view('v_produk', $data);
			} 
		}