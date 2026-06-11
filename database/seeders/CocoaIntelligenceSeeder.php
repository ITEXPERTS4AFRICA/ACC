<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Product, Article};
use Illuminate\Support\Str;

class CocoaIntelligenceSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Enrichissement des Produits
        $products = [
            [
                'name' => 'Beurre de Cacao Brut (Pastilles)',
                'name_en' => 'Raw Cocoa Butter (Wafers)',
                'slug' => 'beurre-de-cacao-brut-pastilles',
                'description' => 'Beurre de cacao pur à 100%, idéal pour une utilisation cosmétique directe.',
                'description_en' => '100% pure cocoa butter, ideal for direct cosmetic use.',
                'description_full' => '<p><strong>Cosmétique et Soins</strong></p><p>Le beurre de cacao pur, souvent présenté sous forme de pastilles pour une manipulation aisée, est un trésor naturel pour la peau. Il s\'utilise directement pour :</p><ul><li><strong>Hydrater en profondeur</strong> : Riche en acides gras, il pénètre l\'épiderme pour une nutrition intense.</li><li><strong>Prévenir les vergetures</strong> : Idéal pour les futures mamans ou lors de variations de poids.</li><li><strong>Base de DIY</strong> : L\'ingrédient parfait pour créer vos propres baumes, laits corporels ou savons artisanaux.</li></ul>',
                'description_full_en' => '<p><strong>Cosmetic and Care</strong></p><p>Pure cocoa butter, often presented in wafer form for easy handling, is a natural treasure for the skin. It is used directly to:</p><ul><li><strong>Deeply Moisturize</strong>: Rich in fatty acids, it penetrates the epidermis for intense nutrition.</li><li><strong>Prevent Stretch Marks</strong>: Ideal for expectant mothers or during weight fluctuations.</li><li><strong>DIY Base</strong>: The perfect ingredient for creating your own balms, body milks, or artisanal soaps.</li></ul>',
                'order' => 5,
                'active' => true,
                'variants' => [
                    ['name' => 'Sac 25kg', 'code' => 'CB-RAW-25'],
                    ['name' => 'Pastilles 1kg', 'code' => 'CB-RAW-1'],
                ]
            ],
            [
                'name' => 'Beurre de Cacao Grade Alimentaire',
                'name_en' => 'Food Grade Cocoa Butter',
                'slug' => 'beurre-de-cacao-grade-alimentaire',
                'description' => 'Beurre de cacao premium pour la chocolaterie et la pâtisserie fine.',
                'description_en' => 'Premium cocoa butter for fine chocolate making and pastry.',
                'description_full' => '<p><strong>Alimentaire, Chocolaterie et Pâtisserie</strong></p><p>Notre beurre de cacao de grade alimentaire est l\'allié indispensable des artisans chocolatiers et pâtissiers.</p><ul><li><strong>Chocolat Fondant</strong> : C\'est l\'élément qui donne au chocolat son fondant onctueux et son côté "cassant" si caractéristique.</li><li><strong>Pâtisserie Fine</strong> : Utilisé en bloc ou en poudre, il permet de tempérer le chocolat à la perfection.</li><li><strong>Sprays Velours</strong> : Idéal pour créer des finitions élégantes et des sprays velours pour décorer vos entremets.</li><li><strong>Cuisine Santé</strong> : Une alternative saine pour la cuisine paléo ou céto.</li></ul>',
                'description_full_en' => '<p><strong>Food, Chocolate, and Pastry</strong></p><p>Our food-grade cocoa butter is the indispensable ally of artisan chocolatiers and pastry chefs.</p><ul><li><strong>Melting Chocolate</strong>: It is the element that gives chocolate its smooth melt and characteristic "snap".</li><li><strong>Fine Pastry</strong>: Used in blocks or powder, it allows for perfect chocolate tempering.</li><li><strong>Velvet Sprays</strong>: Ideal for creating elegant finishes and velvet sprays to decorate your desserts.</li><li><strong>Health Cooking</strong>: A healthy alternative for paleo or keto cooking.</li></ul>',
                'order' => 6,
                'active' => true,
                'variants' => [
                    ['name' => 'Bloc 5kg', 'code' => 'CB-FOOD-5'],
                    ['name' => 'Poudre Mycryo 500g', 'code' => 'CB-FOOD-P'],
                ]
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 2. Articles d'actualité intelligents
        $articles = [
            [
                'title' => 'Le Beurre de Cacao : Le secret d\'une peau parfaite',
                'title_en' => 'Cocoa Butter: The Secret to Perfect Skin',
                'slug' => 'le-beurre-de-cacao-secret-peau-parfaite',
                'content' => '<p>Saviez-vous que le beurre de cacao est l\'un des ingrédients les plus prisés en cosmétologie ? Grâce à ses antioxydants naturels, il combat les radicaux libres et ralentit le vieillissement cutané.</p><p>Que ce soit en baumes réparateurs ou intégré dans vos savons, il apporte une barrière protectrice durable. Découvrez notre gamme de beurre brut pour vos créations maison !</p>',
                'content_en' => '<p>Did you know that cocoa butter is one of the most prized ingredients in cosmetology? Thanks to its natural antioxidants, it fights free radicals and slows down skin aging.</p><p>Whether in restorative balms or integrated into your soaps, it provides a lasting protective barrier. Discover our range of raw butter for your homemade creations!</p>',
                'published' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Maîtriser le tempérage du chocolat avec le beurre de cacao',
                'title_en' => 'Mastering Chocolate Tempering with Cocoa Butter',
                'slug' => 'maitriser-temperage-chocolat-beurre-cacao',
                'content' => '<p>Pour obtenir un chocolat brillant qui craque sous la dent, le tempérage est crucial. L\'utilisation du beurre de cacao en poudre facilite grandement ce processus pour les amateurs et les professionnels.</p><p>En ajoutant seulement 1% de beurre de cacao à votre masse fondue, vous stabilisez les cristaux de gras et garantissez un résultat digne des plus grands maîtres.</p>',
                'content_en' => '<p>To obtain a shiny chocolate that snaps in the mouth, tempering is crucial. Using cocoa butter powder greatly facilitates this process for amateurs and professionals alike.</p><p>By adding just 1% cocoa butter to your melted mass, you stabilize the fat crystals and guarantee a result worthy of the greatest masters.</p>',
                'published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'L\'innovation au service de la cosmétique : Les laits réparateurs ACC',
                'title_en' => 'Innovation Serving Cosmetics: ACC Restorative Milks',
                'slug' => 'innovation-cosmetique-laits-reparateurs-acc',
                'content' => '<p>Atlantic Cocoa Corporation travaille en partenariat avec les plus grands laboratoires pour transformer le beurre de cacao en ingrédients actifs révolutionnaires.</p><p>Nos dérivés de beurre de cacao se retrouvent aujourd\'hui dans des produits phares comme le "Body Superfood" de Garnier, apportant confort et nutrition intense aux peaux les plus sèches.</p>',
                'content_en' => '<p>Atlantic Cocoa Corporation works in partnership with major laboratories to transform cocoa butter into revolutionary active ingredients.</p><p>Our cocoa butter derivatives are now found in leading products like Garnier\'s "Body Superfood", providing comfort and intense nutrition to the driest skin.</p>',
                'published' => true,
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($articles as $a) {
            Article::updateOrCreate(['slug' => $a['slug']], $a);
        }
    }
}
