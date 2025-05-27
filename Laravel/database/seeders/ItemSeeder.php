<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
    use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


public function run()
{
    Item::create([
        'nama' => 'Kemeja Batik Biru',
        'kategori' => 'Kemeja',
        'harga' => 124000,
        'deskripsi' => 'Kemeja dengan motif batik biru elegan.',
        'gambar' => 'layout/batik1.jpg'
    ]);

    Item::create([
        'nama' => 'Hoodie Hitam',
        'kategori' => 'Hoodie',
        'harga' => 350000,
        'deskripsi' => 'Hoodie warna hitam nyaman dan stylish.',
        'gambar' => 'layout/hoodie1.jpg'
    ]);
}

}
