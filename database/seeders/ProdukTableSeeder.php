<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataKategori = [
            [
                'name' => 'Makanan',
                'image' => asset('storage/image-kategori/makanan.png')
            ],
            [
                'name' => 'Minuman',
                'image' => asset('storage/image-kategori/minuman.png')
            ],
            [
                'name' => 'Appetizer',
                'image' => asset('storage/image-kategori/appetizer.png')
            ],
            [
                'name' => 'Dessert',
                'image' => asset('storage/image-kategori/dessert.png')
            ],
            [
                'name' => 'Kids Menu',
                'image' => asset('storage/image-kategori/kids-menu.png')
            ],
            // [
            //     'name' => 'Esspresso',
            //     'image' => asset('storage/image-kategori/esspresso.png')
            // ],
            // [
            //     'name' => 'Manual Brew',
            //     'image' => asset('storage/image-kategori/manual-brew.png')
            // ],
            [
                'name' => 'Signature Coffee',
                'image' => asset('storage/image-kategori/signature-coffee.png')
            ],
            [
                'name' => 'Bottled Coffee',
                'image' => asset('storage/image-kategori/bottled-coffee.png')
            ],
        ];
        $produks = [
            [
                'kategori_id' => 1,
                'nama_produk' => '',
            ]
        ];

        foreach($dataKategori as $key => $kategori) {
            Kategori::create([
                'name' => $kategori['name'],
                'image' => $kategori['image'],
                'sort_order' => ($key+1)
            ]);
        }

        $this->command->info('success seeding Produk data');
    }
}
