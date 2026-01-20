<?php

namespace App\Http\Controllers\API;

use Throwable;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProdukController extends BaseController
{
    public function getProduk()
    {
        try {
            $query = Produk::where('is_active', true)
                ->where('stok', '>', 0)->get();
    
            return $this->sendResponse([
                'produk' => $query
            ], 'Data berhasil diambil');
        } catch (Throwable $e) {
            return $this->sendError('Terjadi kesalahan'.$e->getMessage());
        }
    }

    public function getKategoriProduk()
    {
        try {
            $query = Kategori::where('is_active', true)
                ->get();

            return $this->sendResponse([
                'kategori' => $query
            ], 'Data berhasil diambil');
        } catch(Throwable $e) {
            return $this->sendError('gagal');
        }
    }
}
