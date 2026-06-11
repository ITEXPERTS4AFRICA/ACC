<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Page, SiteSetting, User};

class PagesAndSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Update admin user avec rôle
        User::where('email', 'admin@atlantic-cocoacorporation.net')
            ->update(['role' => 'admin', 'active' => true, 'is_admin' => true]);

        // Pages CMS
        $pages = [
            ['key' => 'home',           'title' => 'Accueil',                         'title_en' => 'Home',               'status' => 'published'],
            ['key' => 'about',          'title' => 'À propos',                        'title_en' => 'About Us',           'status' => 'published'],
            ['key' => 'factories',      'title' => 'Nos Usines',                      'title_en' => 'Our Plants',         'status' => 'published'],
            ['key' => 'products',       'title' => 'Nos Produits',                    'title_en' => 'Our Products',       'status' => 'published'],
            ['key' => 'quality',        'title' => 'Qualité & Certifications',         'title_en' => 'Quality & Certifications', 'status' => 'published'],
            ['key' => 'sustainability', 'title' => 'Durabilité & RSE',                'title_en' => 'Sustainability & CSR', 'status' => 'published'],
            ['key' => 'news',           'title' => 'Actualités & Médias',             'title_en' => 'News & Media',       'status' => 'published'],
            ['key' => 'contact',        'title' => 'Contact',                         'title_en' => 'Contact',            'status' => 'published'],
            ['key' => 'partners',       'title' => 'Nos Partenaires',                 'title_en' => 'Our Partners',       'status' => 'published'],
        ];
        foreach ($pages as $p) {
            Page::firstOrCreate(['key' => $p['key']], $p);
        }

        // Paramètres généraux
        $settings = [
            'site_name'       => 'Atlantic Cocoa Corporation',
            'site_tagline_fr' => 'Leader en transformation de cacao en Afrique subsaharienne',
            'site_tagline_en' => 'Leading cocoa processor in sub-Saharan Africa',
            'contact_email'   => 'contact@atlantic-cocoacorporation.net',
            'smtp_from_name'  => 'Atlantic Cocoa Corporation',
            'smtp_from_email' => 'no-reply@atlantic-cocoacorporation.net',
        ];
        foreach ($settings as $key => $value) {
            SiteSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
