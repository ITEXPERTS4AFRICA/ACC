@extends('layouts.public')
@section('page-title', 'Atlantic Cocoa Corporation — Excellence industrielle du cacao africain')

@section('content')

{{-- ══════════════════ HERO VIDÉO ══════════════════ --}}
<section class="relative h-screen min-h-[600px] max-h-[900px] flex items-center overflow-hidden bg-dark">
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('videos/banniere.mp4') }}" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-gradient-to-r from-dark/80 via-dark/50 to-transparent"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
        <div class="max-w-2xl">
            <p class="section-tag mb-4">Excellence in Cocoa</p>
            <h1 class="font-playfair text-5xl lg:text-[64px] font-bold text-white leading-[1.1] mb-6">
                {{ app()->getLocale() === 'fr'
                    ? "L'Excellence Industrielle au Cœur du Cacao"
                    : 'Industrial Excellence at the Heart of Cocoa' }}
            </h1>
            <p class="text-white/70 text-base lg:text-lg leading-relaxed mb-10 max-w-xl">
                {{ app()->getLocale() === 'fr'
                    ? "Pionniers de la chaîne d'approvisionnement B2B mondiale du cacao, des terres fertiles de Côte d'Ivoire et du Cameroun vers les marchés internationaux."
                    : "Pioneering the global B2B cocoa supply chain from the fertile soils of Côte d'Ivoire and Cameroon to international markets." }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route(app()->getLocale().'.products') }}"
                   class="bg-white text-navy uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-cream transition-colors">
                    {{ app()->getLocale() === 'fr' ? 'Explorer les Produits' : 'Explore Products' }}
                </a>
                <a href="{{ route(app()->getLocale().'.sustainability') }}"
                   class="border border-white/60 text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-white/10 transition-colors">
                    {{ app()->getLocale() === 'fr' ? 'Rapport Durabilité' : 'Sustainability Report' }}
                </a>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/40 text-[10px] tracking-widest">
        <span>SCROLL</span>
        <div class="w-px h-10 bg-white/20 animate-pulse"></div>
    </div>
</section>

{{-- ══════════════════ STATS BANNIÈRE ══════════════════ --}}
<section class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-gray-100">
            @foreach([
                ['num'=>'3','label'=>app()->getLocale()==='fr'?'Usines de transformation':'Processing Plants','desc'=>app()->getLocale()==='fr'?'Stratégiquement situées à Abidjan, San Pedro et Kribi.':'Strategically located in Abidjan, San Pedro and Kribi.'],
                ['num'=>'160K+','label'=>app()->getLocale()==='fr'?'MT de capacité':'MT of Capacity','desc'=>app()->getLocale()==='fr'?'Production industrielle pour un approvisionnement fiable.':'Industrial production for reliable supply.'],
                ['num'=>'2','label'=>app()->getLocale()==='fr'?'Pays d\'origine':'Countries of Origin','desc'=>app()->getLocale()==='fr'?'Présence directe en Côte d\'Ivoire et au Cameroun.':'Direct presence in Côte d\'Ivoire and Cameroon.'],
            ] as $stat)
            <div class="py-8 px-8">
                <div class="font-playfair text-4xl font-bold text-navy mb-1">{{ $stat['num'] }}</div>
                <div class="text-xs font-bold uppercase tracking-widest text-amber mb-2">{{ $stat['label'] }}</div>
                <div class="text-gray-400 text-sm leading-relaxed">{{ $stat['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════ BLOC ACTUALITÉS ══════════════════ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        {{-- En-tête --}}
        <div class="flex items-start justify-between mb-10">
            <div>
                <h2 class="font-playfair text-3xl font-bold text-navy">
                    {{ app()->getLocale() === 'fr' ? 'Dernières Actualités' : 'Latest News' }}
                </h2>
                <p class="text-gray-400 text-sm mt-1">
                    {{ app()->getLocale() === 'fr' ? 'Suivez l\'évolution de nos opérations et de nos engagements.' : 'Follow the evolution of our operations and commitments.' }}
                </p>
            </div>
            <a href="{{ route(app()->getLocale().'.news') }}"
               class="text-navy text-[10px] font-bold uppercase tracking-widest hidden sm:inline-flex items-center gap-1.5 hover:text-amber transition">
                {{ app()->getLocale() === 'fr' ? 'Toutes les actualités' : 'All news' }}
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        @php
            $homeArticles    = isset($articles) ? $articles->take(4) : collect();
            $homeCard1       = $homeArticles->get(0);
            $homeCard2       = $homeArticles->get(1);
            $homeCard3       = $homeArticles->get(2);
            $homeBottomCards = $homeArticles->slice(3, 3);
            $homePlaceholders = [
                ['tag'=>'Marchés','title'=>app()->getLocale()==='fr'?'Expansion vers le marché de l\'Asie-Pacifique':'Expansion to Asia-Pacific','excerpt'=>app()->getLocale()==='fr'?'Ouverture d\'un bureau de représentation à Singapour.':'Opening a representative office in Singapore.'],
                ['tag'=>'Qualité','title'=>app()->getLocale()==='fr'?'Certification FSSC 22000 renouvelée':'FSSC 22000 Certification Renewed','excerpt'=>app()->getLocale()==='fr'?'L\'excellence de nos processus confirmée par l\'audit annuel.':'Our process excellence confirmed by the annual audit.'],
                ['tag'=>'Innovation','title'=>app()->getLocale()==='fr'?'Nouveau procédé de torréfaction à froid':'New Cold-Roasting Process','excerpt'=>app()->getLocale()==='fr'?'Une technologie brevetée préservant les arômes volatils.':'A patented technology preserving volatile aromas.'],
            ];
        @endphp

        {{-- Grille principale : grande carte gauche + 2 petites droite --}}
        <div class="grid lg:grid-cols-2 gap-6 mb-6">

            {{-- Grande carte gauche --}}
            @php $a = $homeCard1; @endphp
            <a href="{{ $a ? route(app()->getLocale().'.news.show', $a->slug) : route(app()->getLocale().'.news') }}"
               class="block border border-gray-200 rounded-sm overflow-hidden group hover:shadow-md transition-shadow">
                <div class="aspect-[16/10] bg-gray-100 overflow-hidden">
                    @if($a?->image)
                    <img src="{{ asset('storage/'.$a->image) }}" alt="{{ $a->title_locale }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-slate to-dark flex items-center justify-center text-5xl opacity-20">📊</div>
                    @endif
                </div>
                <div class="p-6">
                    <span class="section-tag block mb-3">{{ $a?->tag ?? 'Transformations' }}</span>
                    <h3 class="font-playfair text-xl font-bold text-navy leading-tight mb-3 group-hover:text-amber transition-colors">
                        {{ $a?->title_locale ?? (app()->getLocale() === 'fr' ? 'Traçabilité Totale : Déploiement de notre infrastructure Blockchain' : 'Total Traceability: Blockchain Infrastructure Deployment') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">
                        {{ Str::limit($a?->excerpt_locale ?? (app()->getLocale() === 'fr' ? 'D\'ici 2025, 100% de nos fèves seront tracées par satellite et enregistrées sur un registre décentralisé pour garantir une éthique sans compromis.' : 'By 2025, 100% of our beans will be tracked by satellite and recorded on a decentralized ledger.'), 180) }}
                    </p>
                    <span class="text-navy text-[10px] font-bold uppercase tracking-widest inline-flex items-center gap-1.5 group-hover:text-amber transition">
                        {{ app()->getLocale() === 'fr' ? 'Découvrir le Programme' : 'Discover the Program' }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>

            {{-- Colonne droite : 2 cartes empilées --}}
            <div class="flex flex-col gap-6">
                @php $b = $homeCard2; @endphp
                <a href="{{ $b ? route(app()->getLocale().'.news.show', $b->slug) : route(app()->getLocale().'.news') }}"
                   class="block bg-cream border border-border rounded-sm p-6 hover:shadow-sm transition-shadow group">
                    <span class="section-tag block mb-3">{{ $b?->tag ?? 'Durabilité' }}</span>
                    <h3 class="font-playfair text-lg font-bold text-navy leading-tight mb-2 group-hover:text-amber transition-colors">
                        {{ $b?->title_locale ?? (app()->getLocale() === 'fr' ? 'Rapport ESG 2023 : Nos objectifs atteints' : 'ESG Report 2023: Our Targets Met') }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        {{ Str::limit($b?->excerpt_locale ?? (app()->getLocale() === 'fr' ? 'Réduction de 15% de l\'empreinte carbone sur l\'ensemble de notre chaîne logistique maritime.' : '15% reduction in carbon footprint across our maritime logistics chain.'), 140) }}
                    </p>
                    <span class="inline-block border border-navy text-navy text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-sm group-hover:bg-navy group-hover:text-white transition">
                        {{ app()->getLocale() === 'fr' ? 'Consulter' : 'View' }}
                    </span>
                </a>

                @php $c = $homeCard3; @endphp
                <a href="{{ $c ? route(app()->getLocale().'.news.show', $c->slug) : route(app()->getLocale().'.news') }}"
                   class="block bg-white border border-gray-200 rounded-sm p-6 hover:shadow-sm transition-shadow group">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-navy/5 flex items-center justify-center flex-shrink-0 text-lg">🤝</div>
                        <div>
                            <span class="section-tag block mb-1">{{ $c?->tag ?? 'Communauté' }}</span>
                            <h3 class="font-playfair text-base font-bold text-navy leading-tight mb-2 group-hover:text-amber transition-colors">
                                {{ $c?->title_locale ?? (app()->getLocale() === 'fr' ? 'Financement de 5 nouveaux centres de santé ruraux dans la région de la Nawa.' : 'Funding 5 new rural health centers in the Nawa region.') }}
                            </h3>
                            <span class="text-navy text-[10px] font-bold uppercase tracking-widest inline-flex items-center gap-1 hover:text-amber transition">
                                {{ app()->getLocale() === 'fr' ? 'Lire le récit' : 'Read the story' }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- 3 cartes du bas --}}
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($homePlaceholders as $i => $ph)
            @php $art = $homeBottomCards->get($i); @endphp
            @if($art)
            <a href="{{ route(app()->getLocale().'.news.show', $art->slug) }}"
               class="border border-gray-200 rounded-sm p-6 hover:shadow-sm transition-shadow group block">
                <span class="section-tag block mb-3">{{ $art->tag ?? $ph['tag'] }}</span>
                <h3 class="font-playfair font-bold text-navy text-base leading-tight mb-3 group-hover:text-amber transition-colors">{{ $art->title_locale }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($art->excerpt_locale, 120) }}</p>
            </a>
            @else
            <div class="border border-gray-200 rounded-sm p-6">
                <span class="section-tag block mb-3">{{ $ph['tag'] }}</span>
                <h3 class="font-playfair font-bold text-navy text-base leading-tight mb-3">{{ $ph['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $ph['excerpt'] }}</p>
            </div>
            @endif
            @endforeach
        </div>

    </div>
</section>

{{-- ══════════════════ GAMME PRODUITS ══════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-12">
            <div>
                <p class="section-tag mb-3">{{ app()->getLocale() === 'fr' ? 'Notre Gamme' : 'Our Product Range' }}</p>
                <h2 class="font-playfair text-4xl font-bold text-navy">
                    {{ app()->getLocale() === 'fr' ? 'Dérivés industriels de cacao' : 'Industrial Cocoa Derivatives' }}
                </h2>
                <p class="text-gray-500 mt-3 max-w-lg text-sm leading-relaxed">
                    {{ app()->getLocale() === 'fr'
                        ? "Produits avec précision pour les plus grands chocolatiers mondiaux."
                        : "Processed with precision and care for the world's leading chocolatiers." }}
                </p>
            </div>
            <a href="{{ route(app()->getLocale().'.products') }}"
               class="hidden md:flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-navy hover:text-amber transition">
                {{ app()->getLocale() === 'fr' ? 'Voir tous les produits' : 'View all products' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        @php $products = $products ?? collect(); @endphp
        @if($products->count())
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
            <a href="{{ route(app()->getLocale().'.product.detail', $product->slug) }}"
               class="group relative overflow-hidden rounded-sm bg-gray-100 aspect-square block">
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name_locale }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                <div class="w-full h-full bg-gradient-to-br from-chocolate/10 to-navy/10 flex items-center justify-center">
                    <span class="text-4xl opacity-30">🍫</span>
                </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-dark/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5">
                    <h3 class="font-playfair font-bold text-white text-lg leading-tight">{{ $product->name_locale }}</h3>
                    <p class="text-white/70 text-xs mt-1 line-clamp-2">{{ $product->description_locale }}</p>
                    <span class="inline-flex items-center gap-1 text-amber text-[10px] font-bold uppercase tracking-widest mt-3">
                        {{ app()->getLocale() === 'fr' ? 'Fiche technique' : 'Technical specs' }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        @else
        {{-- Placeholder produits --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'Cocoa Mass (Liquor)', 'desc' => 'Produced by grinding selected cocoa nibs into a smooth liquid paste.', 'color' => 'from-chocolate to-dark'],
                ['label' => 'Cocoa Butter',        'desc' => 'Deodorized or natural fat extracted from the cocoa bean.', 'color' => 'from-amber/40 to-amber/10'],
                ['label' => 'Cocoa Powder',        'desc' => 'Available in various pH levels and fat contents (10–12%).', 'color' => 'from-bordeaux/30 to-chocolate/20'],
                ['label' => 'Cocoa Cake',          'desc' => 'The solids remaining after cocoa butter extraction.', 'color' => 'from-chocolate/50 to-navy/20'],
            ] as $p)
            <div class="group relative overflow-hidden rounded-sm aspect-square bg-gradient-to-br {{ $p['color'] }} cursor-default">
                <div class="absolute inset-0 bg-gradient-to-t from-dark/70 via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-5">
                    <h3 class="font-playfair font-bold text-white text-lg leading-tight">{{ $p['label'] }}</h3>
                    <p class="text-white/60 text-xs mt-1 line-clamp-2">{{ $p['desc'] }}</p>
                    <span class="inline-flex items-center gap-1 text-amber text-[10px] font-bold uppercase tracking-widest mt-3">
                        Technical Specs <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ══════════════════ DURABILITÉ ══════════════════ --}}
<section class="bg-slate py-20">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="font-playfair text-4xl font-bold text-white mb-6">
                {{ app()->getLocale() === 'fr' ? 'Committed to Sustainable Growth' : 'Committed to Sustainable Growth' }}
            </h2>
            <p class="text-white/60 text-sm leading-relaxed mb-8">
                {{ app()->getLocale() === 'fr'
                    ? "Notre programme de durabilité est un engagement pour accélérer les progrès vers une chaîne d'approvisionnement mondiale transparente. Nous autonomisons les agriculteurs tout en garantissant des produits certifiés et traçables."
                    : "Our sustainability program is a commitment to accelerate progress toward a transparent global cocoa supply chain." }}
            </p>
            <ul class="space-y-3 mb-10">
                @foreach(['EUDR Compliance & Full Traceability','FSSC 22000 Food Safety Standards','SEDEX 4 Pillars Audited Facilities'] as $item)
                <li class="flex items-center gap-3 text-sm text-white/80">
                    <svg class="w-4 h-4 text-amber flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
            <div class="flex flex-wrap gap-3">
                @foreach(['UTZ Certified','Organic','Fair Trade'] as $cert)
                <span class="border border-white/20 text-white/60 text-[10px] font-semibold uppercase tracking-widest px-3 py-1.5 rounded-sm">{{ $cert }}</span>
                @endforeach
            </div>
        </div>
        <div class="relative">
            <div class="aspect-[4/3] bg-white/5 rounded-sm overflow-hidden">
                @if(file_exists(public_path("images/home/Sustainable Plantation.png")))
                <img src="{{ asset('images/home/Sustainable Plantation.png') }}" class="w-full h-full object-cover" alt="Sustainability">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <span class="text-white/20 text-6xl">🌿</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════ PRÉSENCE INDUSTRIELLE ══════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="font-playfair text-4xl font-bold text-navy mb-4">
                {{ app()->getLocale() === 'fr' ? 'Présence Industrielle Stratégique' : 'Strategic Industrial Presence' }}
            </h2>
            <p class="text-gray-500 text-sm max-w-2xl mx-auto">
                {{ app()->getLocale() === 'fr'
                    ? "Des infrastructures de classe mondiale à travers l'Afrique de l'Ouest pour livrer les meilleurs produits de cacao au marché global."
                    : "Operating state-of-the-art facilities across West Africa to deliver the finest cocoa products to the global market." }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 mb-14">
            @php $plants = [
                ['name' => 'Abidjan Plant', 'country' => 'CÔTE D\'IVOIRE', 'cap' => '48,000 MT', 'desc' => app()->getLocale() === 'fr' ? 'Capacité opérationnelle. Desservant le principal port industriel.' : '48,000 MT capacity in operation. Serving the main industrial port.', 'status' => 'operational', 'route' => app()->getLocale().'.factories'],
                ['name' => 'San Pedro Plant', 'country' => 'CÔTE D\'IVOIRE', 'cap' => '64,000 MT', 'desc' => app()->getLocale() === 'fr' ? 'En cours de construction. Extension de notre hub.' : '64,000 MT currently under construction. Expanding our reach hub.', 'status' => 'construction', 'route' => app()->getLocale().'.factories'],
                ['name' => 'Kribi Plant', 'country' => 'KRIBI, CAMEROUN', 'cap' => '48,000 MT', 'desc' => app()->getLocale() === 'fr' ? 'Capacité opérationnelle. Hub stratégique pour l\'Afrique Centrale.' : '48,000 MT capacity in operation. Strategic hub for Central Africa.', 'status' => 'operational', 'route' => app()->getLocale().'.factories'],
            ]; @endphp

            @foreach($plants as $plant)
            <div class="border border-gray-200 rounded-sm overflow-hidden hover:shadow-lg transition-shadow group">
                <div class="h-48 bg-gradient-to-br {{ $plant['status'] === 'construction' ? 'from-amber/20 to-navy/10' : 'from-navy/10 to-slate/10' }} relative overflow-hidden">
                    @if(file_exists(public_path("images/home/".Str::slug($plant['name']).".jpg")))
                    <img src="{{ asset("images/home/".Str::slug($plant['name']).".jpg") }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $plant['name'] }}">
                    @else
                    <div class="w-full h-full flex items-center justify-center"><span class="text-4xl opacity-20">🏭</span></div>
                    @endif
                    <div class="absolute top-4 left-4">
                        @if($plant['status'] === 'construction')
                        <span class="bg-amber text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-sm">In Construction</span>
                        @else
                        <span class="bg-green-600 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-sm">Operational</span>
                        @endif
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-amber mb-1">{{ $plant['country'] }}</p>
                    <h3 class="font-playfair text-xl font-bold text-navy mb-2">{{ $plant['name'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $plant['desc'] }}</p>
                    <a href="{{ route($plant['route']) }}"
                       class="inline-flex items-center gap-1.5 text-navy text-xs font-bold uppercase tracking-widest hover:text-amber transition">
                        {{ app()->getLocale() === 'fr' ? 'Détails usine' : 'Factory Details' }}
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════ CAPTURE EMAIL B2B ══════════════════ --}}
<section class="bg-navy py-16">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="font-playfair text-3xl font-bold text-white mb-4">
            {{ app()->getLocale() === 'fr' ? 'Partenaire d\'Atlantic Cocoa Corporation' : 'Partner with Atlantic Cocoa Corporation' }}
        </h2>
        <p class="text-white/60 text-sm mb-8">
            {{ app()->getLocale() === 'fr'
                ? "Rejoignez les grands chocolatiers mondiaux qui nous font confiance pour des dérivés de cacao fiables, haute qualité et durables."
                : "Join the leading global chocolate manufacturers who trust us for reliable, high-quality, and sustainable cocoa derivatives." }}
        </p>
        <form action="{{ route(app()->getLocale().'.contact') }}" method="GET" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
            <input type="email" name="email" placeholder="{{ app()->getLocale() === 'fr' ? 'Votre email professionnel' : 'Professional Email' }}"
                   class="flex-1 bg-white/10 border border-white/20 text-white placeholder-white/40 px-4 py-3 rounded-sm text-sm focus:outline-none focus:border-white/60">
            <button type="submit" class="btn-navy whitespace-nowrap">
                {{ app()->getLocale() === 'fr' ? 'Demander info' : 'Request Info' }}
            </button>
        </form>
    </div>
</section>

@endsection
