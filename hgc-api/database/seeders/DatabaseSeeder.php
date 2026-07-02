<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            SectorSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            StatSeeder::class,
        ]);
    }
}