<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Partner, TeamMember, ContactMessage, SiteSetting};

class CorporateIntelligenceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Partenaires (Logistique, Banques, Clients Industriels)
        $partners = [
            ['name' => 'MSC Mediterranean Shipping Company', 'website' => 'https://www.msc.com', 'order' => 1],
            ['name' => 'Maersk Line', 'website' => 'https://www.maersk.com', 'order' => 2],
            ['name' => 'CMA CGM', 'website' => 'https://www.cma-cgm.com', 'order' => 3],
            ['name' => 'Ecobank Transnational Inc.', 'website' => 'https://www.ecobank.com', 'order' => 4],
            ['name' => 'Société Générale Côte d\'Ivoire', 'website' => 'https://www.societegenerale.ci', 'order' => 5],
            ['name' => 'Barry Callebaut', 'website' => 'https://www.barry-callebaut.com', 'order' => 6],
            ['name' => 'ICCO - International Cocoa Organization', 'website' => 'https://www.icco.org', 'order' => 7],
        ];

        foreach ($partners as $p) {
            Partner::updateOrCreate(['name' => $p['name']], $p + ['active' => true]);
        }

        // 2. Équipe Dirigeante (Board & Management)
        $team = [
            [
                'name' => 'Koffi Kouamé',
                'title' => 'Président du Conseil d\'Administration',
                'title_en' => 'Chairman of the Board',
                'bio' => 'Plus de 30 ans d\'expérience dans l\'agro-industrie et le commerce international de matières premières.',
                'bio_en' => 'Over 30 years of experience in agro-industry and international commodities trading.',
                'is_director' => true,
                'order' => 1,
            ],
            [
                'name' => 'Jean-Marc Dupont',
                'title' => 'Directeur Général (CEO)',
                'title_en' => 'Chief Executive Officer',
                'bio' => 'Expert en transformation industrielle, il pilote la stratégie d\'expansion panafricaine du groupe.',
                'bio_en' => 'Industrial transformation expert, he leads the group\'s pan-African expansion strategy.',
                'is_director' => true,
                'order' => 2,
            ],
            [
                'name' => 'Awa Traoré',
                'title' => 'Directrice Qualité & Développement Durable',
                'title_en' => 'Quality & Sustainability Director',
                'bio' => 'Ingénieure agronome, elle garantit la conformité aux standards internationaux et les engagements RSE.',
                'bio_en' => 'Agronomist engineer, she ensures compliance with international standards and CSR commitments.',
                'is_director' => false,
                'order' => 3,
            ],
            [
                'name' => 'Ibrahim Sangaré',
                'title' => 'Directeur de l\'Usine de San Pedro',
                'title_en' => 'San Pedro Plant Manager',
                'bio' => 'Spécialiste du génie industriel, responsable de l\'excellence opérationnelle du site de San Pedro.',
                'bio_en' => 'Industrial engineering specialist, responsible for operational excellence at the San Pedro site.',
                'is_director' => false,
                'order' => 4,
            ],
        ];

        foreach ($team as $t) {
            TeamMember::updateOrCreate(['name' => $t['name']], $t);
        }

        // 3. Messages de Contact ( CRM Demonstration )
        $messages = [
            [
                'name' => 'Thomas Muller',
                'email' => 't.muller@euro-choc.de',
                'company' => 'EuroChoc GmbH',
                'subject' => 'Demande de cotation pour beurre de cacao naturel',
                'message' => 'Bonjour, nous souhaiterions recevoir une offre tarifaire pour 2 containers de beurre de cacao naturel (natural cocoa butter) pour livraison à Hambourg en Septembre.',
                'read' => false,
                'created_at' => now()->subHours(2),
            ],
            [
                'name' => 'Sophie Martin',
                'email' => 's.martin@bio-cosmetic.fr',
                'company' => 'BioCosmétiques France',
                'subject' => 'Certification Rainforest Alliance',
                'message' => 'Bonjour, pourriez-vous nous transmettre vos certificats Rainforest Alliance à jour ? Nous sommes intéressés par vos pastilles de beurre brut pour une nouvelle gamme bio.',
                'read' => true,
                'created_at' => now()->subDays(1),
            ],
            [
                'name' => 'Kevin Tan',
                'email' => 'k.tan@asia-trade-cocoa.sg',
                'company' => 'Asia Trade Cocoa',
                'subject' => 'Partenariat Distribution Asie du Sud-Est',
                'message' => 'Dear Sales Team, we are a leading distributor in Singapore and we are looking for high quality cocoa powder suppliers from West Africa.',
                'read' => false,
                'created_at' => now()->subDays(2),
            ],
        ];

        foreach ($messages as $m) {
            ContactMessage::create($m);
        }

        // 4. Photos de Galerie (Liaison avec les articles existants)
        $galleryImages = [
            'galleries/articles/0Kmte8lS0mfWXn4ar2maOGmSDUi1gh3GH4lpEoTY.png',
            'galleries/articles/enAsehfBv134o8Fq8oJRW3eHU110SUhjalue3qhp.png',
            'galleries/articles/G82HfsYWZoWN0ebzgZnpL2knSUev15noiKeQm27p.png',
        ];

        $firstArticle = \App\Models\Article::first();
        if ($firstArticle) {
            foreach ($galleryImages as $index => $path) {
                \App\Models\GalleryPhoto::updateOrCreate(
                    ['path' => $path],
                    [
                        'category' => 'article-' . $firstArticle->id,
                        'order' => $index + 1,
                    ]
                );
            }
        }

        // 5. Site Settings
        $settings = [
            'site_name' => 'Atlantic Cocoa Corporation',
            'contact_email' => 'contact@atlantic-cocoacorporation.net',
            'contact_phone' => '+225 27 21 00 00 00',
            'contact_address' => 'Zone Industrielle de Vridi, BP 123, Abidjan, Côte d\'Ivoire',
            'facebook_url' => 'https://facebook.com/atlanticcocoa',
            'linkedin_url' => 'https://linkedin.com/company/atlantic-cocoa-corporation',
            'twitter_url' => 'https://twitter.com/atlanticcocoa',
            'working_hours' => 'Lun - Ven : 08:00 - 17:30',
            'csr_report_path' => 'pdfs/csr-report-2024.pdf',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // 6. Media File pour le rapport
        \App\Models\MediaFile::updateOrCreate(
            ['path' => 'pdfs/csr-report-2024.pdf'],
            [
                'name' => 'Rapport RSE 2024',
                'disk' => 'public',
                'mime_type' => 'application/pdf',
                'type' => 'pdf',
                'size' => filesize(storage_path('app/public/pdfs/csr-report-2024.pdf')),
                'alt' => 'Rapport RSE 2024 - Atlantic Cocoa Corporation',
            ]
        );
    }
}
