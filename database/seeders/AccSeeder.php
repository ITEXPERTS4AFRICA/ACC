<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Factory, Product, Certification, Article, SeoSetting, RsePillar, User};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AccSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@atlantic-cocoacorporation.net'],
            ['name' => 'Admin ACC', 'password' => Hash::make('acc-admin-2025'), 'is_admin' => true]
        );

        // Usines
        $factories = [
            ['name' => 'Usine d\'Abidjan', 'name_en' => 'Abidjan Plant', 'city' => 'Abidjan', 'country' => 'Côte d\'Ivoire', 'capacity_mt' => 60000, 'status' => 'operational', 'order' => 1,
             'description' => 'Première usine du groupe, située dans la Zone Industrielle de Vridi au Port d\'Abidjan. Spécialisée dans la production de masse et beurre de cacao.',
             'description_en' => 'The group\'s first plant, located in the Vridi Industrial Zone at the Port of Abidjan. Specializes in cocoa mass and butter production.'],
            ['name' => 'Usine de San Pedro', 'name_en' => 'San Pedro Plant', 'city' => 'San Pedro', 'country' => 'Côte d\'Ivoire', 'capacity_mt' => 60000, 'status' => 'operational', 'order' => 2,
             'description' => 'Implantée dans la zone portuaire de San Pedro, cette usine traite principalement les fèves de la région Ouest de la Côte d\'Ivoire.',
             'description_en' => 'Located in the San Pedro port zone, this plant primarily processes beans from western Côte d\'Ivoire.'],
            ['name' => 'Usine de Kribi', 'name_en' => 'Kribi Plant', 'city' => 'Kribi', 'country' => 'Cameroun', 'capacity_mt' => 40000, 'status' => 'construction', 'order' => 3,
             'description' => 'Troisième site du groupe en cours de développement au Cameroun, dans la zone économique spéciale du port de Kribi.',
             'description_en' => 'The group\'s third site under development in Cameroon, in the special economic zone of the port of Kribi.'],
        ];
        foreach ($factories as $f) { Factory::firstOrCreate(['city' => $f['city'], 'country' => $f['country']], $f + ['active' => true]); }

        // Produits
        $products = [
            ['name' => 'Masse de Cacao', 'name_en' => 'Cocoa Liquor', 'slug' => 'masse-de-cacao', 'order' => 1,
             'description' => 'Pâte de cacao pure, produite par broyage des fèves de cacao torréfiées et décortiquées.',
             'description_en' => 'Pure cocoa paste, produced by grinding roasted and hulled cocoa beans.',
             'description_full' => 'La masse de cacao (ou liqueur de cacao) est obtenue par broyage fin des fèves de cacao après torréfaction et décorticage. Elle contient environ 50-55% de beurre de cacao naturellement présent dans la fève. Utilisée comme ingrédient de base dans la fabrication du chocolat.',
             'description_full_en' => 'Cocoa liquor is obtained by fine grinding of cocoa beans after roasting and hulling. It contains approximately 50-55% naturally occurring cocoa butter. Used as a base ingredient in chocolate manufacturing.',
             'variants' => [['name' => 'Natural', 'code' => 'ML-NAT'], ['name' => 'Alkalized', 'code' => 'ML-ALK']]],
            ['name' => 'Beurre de Cacao', 'name_en' => 'Cocoa Butter', 'slug' => 'beurre-de-cacao', 'order' => 2,
             'description' => 'Matière grasse naturelle extraite de la masse de cacao par pressage hydraulique.',
             'description_en' => 'Natural fat extracted from cocoa mass by hydraulic pressing.',
             'description_full' => 'Le beurre de cacao est la matière grasse naturelle présente dans la fève de cacao, extraite par pressage hydraulique de la masse de cacao. Il est utilisé dans la confiserie, la cosmétique et l\'industrie pharmaceutique.',
             'description_full_en' => 'Cocoa butter is the natural fat present in the cocoa bean, extracted by hydraulic pressing of cocoa mass. It is used in confectionery, cosmetics and pharmaceutical industry.',
             'variants' => [['name' => 'Deodorized', 'code' => 'CB-DEO'], ['name' => 'Natural', 'code' => 'CB-NAT']]],
            ['name' => 'Tourteaux de Cacao', 'name_en' => 'Cocoa Cake', 'slug' => 'tourteaux-de-cacao', 'order' => 3,
             'description' => 'Résidu solide obtenu après extraction du beurre de cacao, utilisé pour produire la poudre.',
             'description_en' => 'Solid residue obtained after cocoa butter extraction, used to produce cocoa powder.',
             'description_full' => 'Les tourteaux de cacao sont le résidu solide obtenu après extraction du beurre par pressage de la masse de cacao. Ils constituent la matière première pour la production de poudre de cacao. Selon le degré de pressage, la teneur en beurre résiduelle varie.',
             'description_full_en' => 'Cocoa cake is the solid residue obtained after butter extraction by pressing of cocoa mass. It is the raw material for cocoa powder production.',
             'variants' => [['name' => '10-12% fat', 'code' => 'CC-10'], ['name' => '20-22% fat', 'code' => 'CC-20']]],
            ['name' => 'Poudre de Cacao', 'name_en' => 'Cocoa Powder', 'slug' => 'poudre-de-cacao', 'order' => 4,
             'description' => 'Poudre finement moulue issue des tourteaux de cacao, disponible en version naturelle et alcalinisée.',
             'description_en' => 'Finely ground powder from cocoa cake, available in natural and alkalized versions.',
             'description_full' => 'La poudre de cacao est obtenue par broyage fin des tourteaux de cacao. Elle est disponible en version naturelle (non alcalinisée) et en version alcalinisée (Dutch-process), offrant des profils de couleur et de saveur distincts pour différentes applications industrielles.',
             'description_full_en' => 'Cocoa powder is obtained by fine grinding of cocoa cake. It is available in natural (non-alkalized) and alkalized (Dutch-process) versions, offering distinct color and flavor profiles for different industrial applications.',
             'variants' => [['name' => 'Natural 10-12%', 'code' => 'CP-NAT10'], ['name' => 'Alkalized 10-12%', 'code' => 'CP-ALK10'], ['name' => 'Natural 20-22%', 'code' => 'CP-NAT20']]],
        ];
        foreach ($products as $p) { Product::firstOrCreate(['slug' => $p['slug']], $p + ['active' => true]); }

        // Certifications
        $certifications = [
            ['name' => 'FSSC 22000', 'description' => 'Certification internationale de sécurité alimentaire, référentiel GFSI.', 'description_en' => 'International food safety certification, GFSI benchmarked.', 'order' => 1],
            ['name' => 'ISO 9001:2015', 'description' => 'Système de management de la qualité ISO.', 'description_en' => 'ISO quality management system.', 'order' => 2],
            ['name' => 'Rainforest Alliance', 'description' => 'Certification de durabilité pour un approvisionnement responsable.', 'description_en' => 'Sustainability certification for responsible sourcing.', 'order' => 3],
            ['name' => 'UTZ Certified', 'description' => 'Programme pour une agriculture durable et responsable.', 'description_en' => 'Program for sustainable and responsible farming.', 'order' => 4],
            ['name' => 'Fair Trade', 'description' => 'Commerce équitable garantissant des conditions justes pour les producteurs.', 'description_en' => 'Fair trade ensuring fair conditions for producers.', 'order' => 5],
            ['name' => 'Halal', 'description' => 'Certification conformité aux exigences alimentaires halal.', 'description_en' => 'Halal food requirements compliance certification.', 'order' => 6],
            ['name' => 'Kosher', 'description' => 'Certification conformité aux exigences alimentaires casher.', 'description_en' => 'Kosher food requirements compliance certification.', 'order' => 7],
            ['name' => 'BRC Food Grade AA', 'description' => 'Certification British Retail Consortium - niveau AA.', 'description_en' => 'British Retail Consortium certification - AA grade.', 'order' => 8],
        ];
        foreach ($certifications as $c) { Certification::firstOrCreate(['name' => $c['name']], $c + ['active' => true]); }

        // RSE Pilliers
        $pillars = [
            ['title' => 'Approvisionnement durable', 'title_en' => 'Sustainable sourcing', 'icon' => '🌱', 'order' => 1,
             'content' => 'Nous travaillons avec des coopératives certifiées Rainforest Alliance et UTZ pour garantir un approvisionnement en fèves de cacao traçable, équitable et durable.',
             'content_en' => 'We work with Rainforest Alliance and UTZ certified cooperatives to ensure traceable, fair and sustainable cocoa bean sourcing.'],
            ['title' => 'Gestion environnementale', 'title_en' => 'Environmental management', 'icon' => '♻️', 'order' => 2,
             'content' => 'Nos usines optimisent leur consommation d\'eau, réduisent leurs émissions de CO₂ et valorisent les sous-produits de la transformation.',
             'content_en' => 'Our plants optimize water consumption, reduce CO₂ emissions and valorize processing by-products.'],
            ['title' => 'Impact social', 'title_en' => 'Social impact', 'icon' => '👥', 'order' => 3,
             'content' => 'ACC investit dans les communautés productrices : formation des agriculteurs, accès à l\'éducation et infrastructures rurales.',
             'content_en' => 'ACC invests in producer communities: farmer training, access to education and rural infrastructure.'],
            ['title' => 'Gouvernance & transparence', 'title_en' => 'Governance & transparency', 'icon' => '📋', 'order' => 4,
             'content' => 'Notre rapport RSE annuel rend compte de nos engagements, mesures et progrès en matière de développement durable.',
             'content_en' => 'Our annual CSR report accounts for our commitments, measures and progress on sustainable development.'],
        ];
        foreach ($pillars as $p) { RsePillar::firstOrCreate(['title' => $p['title']], $p); }

        // SEO Settings
        $pages = [
            ['page_key' => 'home', 'meta_title' => 'Atlantic Cocoa Corporation – Leader en transformation de cacao', 'meta_title_en' => 'Atlantic Cocoa Corporation – Leading Cocoa Processor',
             'meta_description' => 'ACC est un groupe agro-industriel transformant 160 000 MT de cacao par an avec 3 usines en Afrique. Masse, beurre, tourteaux et poudre de cacao de qualité internationale.',
             'meta_description_en' => 'ACC is an agro-industrial group processing 160,000 MT of cocoa annually with 3 plants in Africa. Internationally certified cocoa mass, butter, cake and powder.'],
            ['page_key' => 'about', 'meta_title' => 'À propos d\'ACC – Notre histoire et nos valeurs', 'meta_title_en' => 'About ACC – Our History and Values',
             'meta_description' => 'Découvrez l\'histoire, les valeurs et les engagements d\'Atlantic Cocoa Corporation, groupe agro-industriel panafricain spécialisé dans la transformation du cacao.',
             'meta_description_en' => 'Discover the history, values and commitments of Atlantic Cocoa Corporation, a pan-African agro-industrial group specialized in cocoa processing.'],
            ['page_key' => 'products', 'meta_title' => 'Nos Produits – Masse, Beurre, Tourteaux, Poudre de Cacao | ACC', 'meta_title_en' => 'Our Products – Cocoa Mass, Butter, Cake, Powder | ACC',
             'meta_description' => 'ACC propose une gamme complète de produits semi-finis de cacao : masse, beurre, tourteaux et poudre. Qualité certifiée FSSC 22000, ISO 9001, Rainforest Alliance.',
             'meta_description_en' => 'ACC offers a complete range of cocoa semi-finished products: mass, butter, cake and powder. FSSC 22000, ISO 9001, Rainforest Alliance certified quality.'],
            ['page_key' => 'quality', 'meta_title' => 'Qualité & Certifications | ACC', 'meta_title_en' => 'Quality & Certifications | ACC',
             'meta_description' => 'ACC détient plus de 8 certifications internationales : FSSC 22000, ISO 9001, Rainforest Alliance, UTZ, Fair Trade, Halal, Kosher, BRC AA.',
             'meta_description_en' => 'ACC holds more than 8 international certifications: FSSC 22000, ISO 9001, Rainforest Alliance, UTZ, Fair Trade, Halal, Kosher, BRC AA.'],
            ['page_key' => 'contact', 'meta_title' => 'Contact | Atlantic Cocoa Corporation', 'meta_title_en' => 'Contact | Atlantic Cocoa Corporation',
             'meta_description' => 'Contactez les équipes commerciales d\'ACC pour un devis, des informations produits ou un partenariat B2B.',
             'meta_description_en' => 'Contact ACC commercial teams for a quote, product information or B2B partnership.'],
        ];
        foreach ($pages as $p) { SeoSetting::firstOrCreate(['page_key' => $p['page_key']], $p); }
    }
}
// NOTE: La méthode run() ci-dessus est complète.
// Le bloc suivant serait appelé séparément si nécessaire.
