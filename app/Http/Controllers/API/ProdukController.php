<?php

namespace App\Http\Controllers\API;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProdukController extends BaseController
{
    public function getProduk()
    {
        $query = Produk::with('kategori')->where('is_active', true)
            ->where('stok', '>', 0)->get();

        return $this->sendResponse([
            'data' => $query
        ], 'Data berhasil diambil');
    }

    public function getKategoriProduk()
    {

    }
}
