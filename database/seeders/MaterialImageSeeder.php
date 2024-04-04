<?php

namespace Database\Seeders;
use App\Models\MaterialImages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MaterialImages::factory()->count(10)->create();
    }
}
