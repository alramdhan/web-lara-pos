<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Kategori;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
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
                'nama_produk' => 'Kwetiaw Goreng',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/makanan.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
            [
                'kategori_id' => 1,
                'nama_produk' => 'Nasi Bakar',
                'deskripsi' => 'Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/makanan.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
            [
                'kategori_id' => 1,
                'nama_produk' => 'Bebek Goreng',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/makanan.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Jus Jeruk',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/minuman.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Es Teh Manis',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/minuman.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Teh Lemon',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/minuman.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
            [
                'kategori_id' => 3,
                'nama_produk' => 'Kentang Goreng',
                'deskripsi' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'sku' => $faker->unique()->bothify("SKU-######"),
                'image' => asset('storage/produk/appetizer.png'),
                'harga' => $faker->numberBetween(15000, 50000),
                'stok' => $faker->numberBetween(0, 100)
            ],
        ];

        foreach($dataKategori as $key => $kategori) {
            Kategori::create([
                'name' => $kategori['name'],
                'image' => $kategori['image'],
                'sort_order' => ($key+1)
            ]);
        }

        foreach($produks as $key => $p) {
            Produk::create($p);
        }

        $this->command->info('success seeding Produk data');
    }
}
