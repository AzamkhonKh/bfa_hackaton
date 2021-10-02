<?php

namespace Database\Seeders;

use App\Models\FileStorageProduct;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileStorageProduct::factory()
            ->count(50)
            ->create();
    }
}
