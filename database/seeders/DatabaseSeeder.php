<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PagesAndSettingsSeeder::class,
            AccSeeder::class,
            CocoaIntelligenceSeeder::class,
            CorporateIntelligenceSeeder::class,
        ]);
    }
}
