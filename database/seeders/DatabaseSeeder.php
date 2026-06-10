<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([AccSeeder::class, PagesAndSettingsSeeder::class]);
    }
}
