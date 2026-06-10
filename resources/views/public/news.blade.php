@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Actualités & Médias — ACC' : 'News & Media — ACC')

@section('content')

@php
    $featured = $articles->first();
    $card1    = $articles->get(1);   // grande carte gauche
    $card2    = $articles->get(2);   // petite carte droite haut
    $card3    = $articles->get(3);   // petite carte droite bas
    $bottom   = $articles->slice(4, 3); // 3 cartes du bas
@endphp

{{-- ═══════════════ HERO ARTICLE VEDETTE ═══════════════ --}}
<section class="relative h-[480px] overflow-hidden bg-dark flex items-center">
    {{-- Image de fond --}}
    @if($featured?->image)
    <img src="{{ asset('storage/'.$featured->image) }}" alt=""
         class="absolute inset-0 w-full h-full object-cover opacity-60">
    @else
    <div class="absolute inset-0 bg-gradient-to-br from-slate via-dark to-chocolate opacity-90"></div>
    @endif
    <div class="absolute inset-0 bg-dark/40"></div>

    {{-- Carte blanche flottante --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
        <div class="bg-white max-w-sm rounded-sm p-8 shadow-2xl">
            @if($featured?->tag)
            <span class="inline-block bg-amber text-white text-[9px] font-bold uppercase tracking-[3px] px-3 py-1 mb-5">{{ $featured->tag }}</span>
            @else
            <span class="inline-block bg-amber text-white text-[9px] font-bold uppercase tracking-[3px] px-3 py-1 mb-5">Annonce Majeure</span>
            @endif

            <h1 class="font-playfair text-2xl font-bold text-navy leading-tight mb-4">
                {{ $featured?->title_locale ?? 'Inauguration de l\'Usine de Transformation 4.0 à San Pédro' }}
            </h1>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                {{ Str::limit($featured?->excerpt_locale ?? 'Atlantic Cocoa Corporation renforce son empreinte industrielle avec l\'ouverture de sa plus grande unité de transformation durable en Afrique de l\'Ouest.', 160) }}
            </p>
            @if($featured)
            <a href="{{ route(app()->getLocale().'.news.show', $featured->slug) }}"
               class="inline-flex items-center gap-2 bg-navy text-white text-[11px] font-bold uppercase tracking-widest px-5 py-3 rounded-sm hover:bg-navy-dark transition">
                {{ app()->getLocale() === 'fr' ? 'Lire le Communiqué' : 'Read the Release' }}
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            @endif
        </div>
    </div>
</section>

{{-- ═══════════════ DERNIÈRES ACTUALITÉS ═══════════════ --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        {{-- En-tête section --}}
        <div class="flex items-start justify-between mb-10">
            <div>
                <h2 class="font-playfair text-3xl font-bold text-navy">
                    {{ app()->getLocale() === 'fr' ? 'Dernières Actualités' : 'Latest News' }}
                </h2>
                <p class="text-gray-400 text-sm mt-1">
                    {{ app()->getLocale() === 'fr' ? 'Suivez l\'évolution de nos opérations et de nos engagements.' : 'Follow the evolution of our operations and commitments.' }}
                </p>
            </div>
            {{-- Icône filtre --}}
            <button class="border border-gray-200 rounded-sm p-2.5 text-gray-400 hover:text-navy hover:border-navy transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M7 8h10M11 12h2M9 16h6"/></svg>
            </button>
        </div>

        {{-- Grille principale : grande carte gauche + 2 petites droite --}}
        <div class="grid lg:grid-cols-2 gap-6 mb-6">

            {{-- Grande carte gauche --}}
            @php $a = $card1 ?? null; @endphp
            <a href="{{ $a ? route(app()->getLocale().'.news.show', $a->slug) : '#' }}"
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
                        {{ $a?->title_locale ?? 'Traçabilité Totale : Déploiement de notre infrastructure Blockchain' }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">
                        {{ Str::limit($a?->excerpt_locale ?? 'D\'ici 2025, 100% de nos fèves seront tracées par satellite et enregistrées sur un registre décentralisé pour garantir une éthique sans compromis.', 180) }}
                    </p>
                    <span class="text-navy text-[10px] font-bold uppercase tracking-widest inline-flex items-center gap-1.5 hover:text-amber transition">
                        {{ app()->getLocale() === 'fr' ? 'Découvrir le Programme' : 'Discover the Program' }}
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>

            {{-- Colonne droite : 2 cartes empilées --}}
            <div class="flex flex-col gap-6">
                {{-- Carte ESG cream --}}
                @php $b = $card2 ?? null; @endphp
                <a href="{{ $b ? route(app()->getLocale().'.news.show', $b->slug) : '#' }}"
                   class="block bg-cream border border-border rounded-sm p-6 hover:shadow-sm transition-shadow group">
                    <span class="section-tag block mb-3">{{ $b?->tag ?? 'Durabilité' }}</span>
                    <h3 class="font-playfair text-lg font-bold text-navy leading-tight mb-2 group-hover:text-amber transition-colors">
                        {{ $b?->title_locale ?? 'Rapport ESG 2023 : Nos objectifs atteints' }}
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        {{ Str::limit($b?->excerpt_locale ?? 'Réduction de 15% de l\'empreinte carbone sur l\'ensemble de notre chaîne logistique maritime.', 140) }}
                    </p>
                    <span class="inline-block border border-navy text-navy text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-sm group-hover:bg-navy group-hover:text-white transition">
                        {{ app()->getLocale() === 'fr' ? 'Consulter' : 'View' }}
                    </span>
                </a>

                {{-- Carte communauté blanche --}}
                @php $c = $card3 ?? null; @endphp
                <a href="{{ $c ? route(app()->getLocale().'.news.show', $c->slug) : '#' }}"
                   class="block bg-white border border-gray-200 rounded-sm p-6 hover:shadow-sm transition-shadow group">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-navy/5 flex items-center justify-center flex-shrink-0 text-lg">🤝</div>
                        <div>
                            <span class="section-tag block mb-1">{{ $c?->tag ?? 'Communauté' }}</span>
                            <h3 class="font-playfair text-base font-bold text-navy leading-tight mb-2 group-hover:text-amber transition-colors">
                                {{ $c?->title_locale ?? 'Financement de 5 nouveaux centres de santé ruraux dans la région de la Nawa.' }}
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
            @php
            $placeholders = [
                ['tag'=>'Marchés','title'=>'Expansion vers le marché de l\'Asie-Pacifique','excerpt'=>'Ouverture d\'un bureau de représentation à Singapour pour soutenir nos clients industriels locaux.'],
                ['tag'=>'Qualité','title'=>'Certification FSSC 22000 renouvelée','excerpt'=>'L\'excellence de nos processus de sécurité alimentaire confirmée par l\'audit annuel.'],
                ['tag'=>'Innovation','title'=>'Nouveau procédé de torréfaction à froid','excerpt'=>'Une technologie brevetée préservant les arômes volatils les plus délicats.'],
            ];
            @endphp
            @foreach($bottom as $i => $art)
            <a href="{{ route(app()->getLocale().'.news.show', $art->slug) }}"
               class="border border-gray-200 rounded-sm p-6 hover:shadow-sm transition-shadow group block">
                <span class="section-tag block mb-3">{{ $art->tag ?? $placeholders[$i]['tag'] }}</span>
                <h3 class="font-playfair font-bold text-navy text-base leading-tight mb-3 group-hover:text-amber transition-colors">{{ $art->title_locale }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ Str::limit($art->excerpt_locale, 120) }}</p>
            </a>
            @endforeach
            @for($i = $bottom->count(); $i < 3; $i++)
            <div class="border border-gray-200 rounded-sm p-6">
                <span class="section-tag block mb-3">{{ $placeholders[$i]['tag'] }}</span>
                <h3 class="font-playfair font-bold text-navy text-base leading-tight mb-3">{{ $placeholders[$i]['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $placeholders[$i]['excerpt'] }}</p>
            </div>
            @endfor
        </div>

    </div>
</section>

{{-- ═══════════════ ESPACE PRESSE & KIT MÉDIA ═══════════════ --}}
<section class="py-20 bg-slate">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">

        {{-- Gauche --}}
        <div>
            <h2 class="font-playfair text-4xl font-bold text-white leading-tight mb-5">
                {{ app()->getLocale() === 'fr' ? 'Espace Presse & Kit Média' : 'Press Room & Media Kit' }}
            </h2>
            <p class="text-white/60 text-sm leading-relaxed mb-10">
                {{ app()->getLocale() === 'fr'
                    ? 'Accédez à nos ressources officielles : logotypes, photographies haute définition de nos installations et fiches techniques pour vos publications.'
                    : 'Access our official resources: logos, high-definition photographs of our facilities and technical sheets for your publications.' }}
            </p>

            {{-- 2 cartes téléchargement --}}
            <div class="grid grid-cols-2 gap-4 mb-8">
                @foreach([
                    ['icon'=>'📦','title'=>app()->getLocale()==='fr'?'Asset Pack Complet':'Full Asset Pack','meta'=>'ZIP • 450 MB'],
                    ['icon'=>'📋','title'=>'Brand Guidelines','meta'=>'PDF • 12 MB'],
                ] as $kit)
                <a href="#" class="bg-white/10 border border-white/20 rounded-sm p-5 hover:bg-white/20 transition group">
                    <div class="text-2xl mb-3">{{ $kit['icon'] }}</div>
                    <p class="font-semibold text-white text-sm mb-1">{{ $kit['title'] }}</p>
                    <p class="text-white/40 text-xs">{{ $kit['meta'] }}</p>
                </a>
                @endforeach
            </div>

            {{-- Demande interview --}}
            <a href="mailto:presse@atlantic-cocoacorporation.net"
               class="inline-flex items-center gap-2 text-white/60 text-sm hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ app()->getLocale() === 'fr' ? 'Demande d\'interview spécifique' : 'Specific interview request' }}
            </a>
        </div>

        {{-- Droite : image kit --}}
        <div class="relative rounded-sm overflow-hidden aspect-[4/3] bg-dark/40">
            <div class="absolute inset-0 flex flex-col items-center justify-center gap-4 opacity-20 text-white text-6xl">📷</div>
            {{-- Barre bas de l'image --}}
            <div class="absolute bottom-0 inset-x-0 bg-dark/70 flex items-center justify-between px-5 py-3">
                <div class="flex items-center gap-2 text-white text-xs">
                    <svg class="w-4 h-4 text-amber" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    {{ app()->getLocale() === 'fr' ? 'Dernière mise à jour : Mars 2024' : 'Last updated: March 2024' }}
                </div>
                <span class="text-white/40 text-xs">v3.1.0</span>
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════ RESTEZ INFORMÉ ═══════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-xl mx-auto px-6 text-center">
        <h2 class="font-playfair text-3xl font-bold text-navy mb-3">
            {{ app()->getLocale() === 'fr' ? 'Restez Informé' : 'Stay Informed' }}
        </h2>
        <p class="text-gray-500 text-sm mb-8 leading-relaxed">
            {{ app()->getLocale() === 'fr'
                ? 'Recevez nos communiqués de presse et analyses de marché directement dans votre boîte de réception.'
                : 'Receive our press releases and market analyses directly in your inbox.' }}
        </p>
        <form class="flex gap-2 mb-4">
            <input type="email" placeholder="{{ app()->getLocale() === 'fr' ? 'votre@email.com' : 'your@email.com' }}"
                   class="flex-1 border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition">
            <button type="submit" class="bg-navy text-white uppercase tracking-widest text-xs font-bold px-6 py-3 rounded-sm hover:bg-navy-dark transition whitespace-nowrap">
                {{ app()->getLocale() === 'fr' ? 'S\'Abonner' : 'Subscribe' }}
            </button>
        </form>
        <p class="text-gray-400 text-xs">
            {{ app()->getLocale() === 'fr' ? 'En vous abonnant, vous acceptez notre politique de confidentialité.' : 'By subscribing, you agree to our privacy policy.' }}
        </p>
    </div>
</section>

@endsection
