@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Nos Usines — Atlantic Cocoa Corporation' : 'Our Plants — Atlantic Cocoa Corporation')

@section('content')

{{-- HERO --}}
<section class="relative h-[480px] flex items-end bg-cover bg-center overflow-hidden" style="background-image:url('{{ $page['factories']->hero_image ?? asset('images/factories/hero-factories.png') }}')">
    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/50 to-dark/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full grid lg:grid-cols-2 gap-12 items-end">
        <div>
            <p class="section-tag mb-3">Industrial Excellence</p>
            <h1 class="font-playfair text-5xl font-bold text-white leading-tight">
                {{ app()->getLocale() === 'fr' ? 'Global Footprint, Localized Precision.' : 'Global Footprint, Localized Precision.' }}
            </h1>
            <p class="text-white/60 text-sm mt-4 max-w-lg leading-relaxed">
                {{ app()->getLocale() === 'fr'
                    ? "Des infrastructures industrielles stratégiques à travers l'Afrique de l'Ouest et Centrale. Conçues pour l'efficacité maximale, la qualité irréprochable et l'intégration communautaire durable."
                    : "Explore our strategic industrial footprint across West and Central Africa. Facilities designed for maximum efficiency, uncompromising quality, and sustainable community integration." }}
            </p>
        </div>
        <div class="flex gap-6">
            @foreach([['160,000 MT','Total Planned Capacity'],['3','Strategic Locations']] as $s)
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-sm px-6 py-4">
                <div class="font-playfair text-3xl font-bold text-white">{{ $s[0] }}</div>
                <div class="text-white/50 text-[10px] uppercase tracking-widest mt-1">{{ $s[1] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- USINE 1 : ABIDJAN --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div>
                <p class="section-tag mb-2">Abidjan Plant</p>
                <p class="text-[11px] text-gray-400 uppercase tracking-widest font-semibold mb-4">Côte d'Ivoire | Primary Processing</p>
                <ul class="space-y-5 mb-8">
                    @foreach([
                        ['icon'=>'⚡','title'=>'48,000 MT Capacity','body'=>app()->getLocale()==='fr'?'Unité entièrement opérationnelle spécialisée dans la masse et le beurre de cacao haut de gamme.':'Fully operational facility specializing in high-grade cocoa mass and butter extraction.'],
                        ['icon'=>'⚙️','title'=>'Advanced Bühler Technology','body'=>app()->getLocale()==='fr'?'Équipée de la dernière ingénierie suisse pour la torréfaction et le broyage de précision.':'Equipped with the latest Swiss engineering for roasting and grinding precision.'],
                        ['icon'=>'🚢','title'=>'Port Side Logistics','body'=>app()->getLocale()==='fr'?'Stratégiquement située près du Port d\'Abidjan pour une distribution mondiale fluide.':'Strategically located near Abidjan Port for seamless global distribution.'],
                    ] as $feat)
                    <li class="flex items-start gap-4">
                        <span class="text-xl mt-0.5">{{ $feat['icon'] }}</span>
                        <div>
                            <p class="font-bold text-navy text-sm">{{ $feat['title'] }}</p>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed">{{ $feat['body'] }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="bg-gray-50 border border-gray-200 rounded-sm px-5 py-4">
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1">Operational Status</p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-500"></span>
                        <span class="text-green-700 font-bold text-sm">Fully Operational</span>
                        <span class="ml-auto text-xs text-gray-400 font-mono">01 | CI</span>
                    </div>
                </div>
            </div>
            <div class="relative rounded-sm overflow-hidden">
                <div class="aspect-[4/3] bg-gradient-to-br from-navy/20 to-slate/20">
                    @if(file_exists(public_path('images/home/Abidjan-Plant.png')))
                    <img src="{{ asset("images/home/Abidjan-Plant.png") }}" class="w-full h-full object-cover" alt="Abidjan Plant">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-6xl opacity-20">🏭</div>
                    @endif
                </div>
                <div class="absolute bottom-4 right-4 bg-navy text-white px-4 py-2 rounded-sm">
                    <div class="text-[10px] uppercase tracking-widest text-white/60">48,000 MT</div>
                    <div class="font-bold text-sm">Annual Production</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- USINE 2 : KRIBI --}}
<section class="py-20 bg-surface">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div class="grid grid-cols-2 gap-3 order-last lg:order-first">
                <div class="aspect-square bg-gradient-to-br from-navy/10 to-slate/10 rounded-sm overflow-hidden">
                    @if(file_exists(public_path('images/factories/kribi-1.png')))
                    <img src="{{ asset('images/factories/kribi-1.png') }}" class="w-full h-full object-cover" alt="Kribi">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">⚙️</div>
                    @endif
                </div>
                <div class="aspect-square bg-gradient-to-br from-chocolate/10 to-navy/10 rounded-sm overflow-hidden">
                    @if(file_exists(public_path('images/factories/kribi-2.png')))
                    <img src="{{ asset('images/factories/kribi-2.png') }}" class="w-full h-full object-cover" alt="Kribi">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-4xl opacity-20">🏗️</div>
                    @endif
                </div>
                <div class="col-span-2 bg-navy rounded-sm p-5 flex items-center justify-between">
                    <div>
                        <p class="text-white/60 text-xs">Annual Production</p>
                        <p class="font-playfair text-2xl font-bold text-white mt-0.5">48,000 MT</p>
                    </div>
                    <svg class="w-8 h-8 text-amber opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
            </div>
            <div>
                <p class="text-amber text-[10px] font-bold uppercase tracking-widest mb-1">Kribi Plant</p>
                <p class="text-[11px] text-gray-400 uppercase tracking-widest font-semibold mb-4">Cameroon | Integrated Hub</p>
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    {{ app()->getLocale() === 'fr'
                        ? "Notre installation au Cameroun est un modèle d'industrialisation durable. Intégrée dans le complexe du Port Industriel de Kribi, elle minimise l'empreinte carbone grâce à un approvisionnement local optimisé et des capacités d'export direct."
                        : "Our Cameroon facility serves as a flagship for sustainable industrialization. Integrated within the Kribi Industrial Port complex, it minimizes carbon footprint through optimized local sourcing and direct export capabilities." }}
                </p>
                <ul class="space-y-3 mb-8">
                    @foreach(['ISO 9001:2015 Certified Quality Systems','Closed-loop water recycling system','Real-time production monitoring dashboard'] as $feat)
                    <li class="flex items-center gap-3 text-sm text-gray-700">
                        <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $feat }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route(app()->getLocale().'.contact') }}"
                   class="inline-flex items-center gap-2 text-navy text-xs font-bold uppercase tracking-widest hover:text-amber transition">
                    View Facility Specs
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- USINE 3 : SAN PEDRO --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="border border-gray-200 rounded-sm p-8">
                <span class="bg-amber text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-sm">In Construction</span>
                <h2 class="font-playfair text-3xl font-bold text-navy mt-5 mb-2">
                    <a href="{{ route(app()->getLocale().'.factories') }}" class="text-amber hover:underline">San Pedro Expansion</a>
                </h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    {{ app()->getLocale() === 'fr'
                        ? "L'avenir de la transformation du cacao se construit à San Pedro. Avec une capacité projetée de 64 000 MT, cette usine sera notre plus grande et plus technologiquement avancée à ce jour."
                        : "The future of cocoa processing is being built in San Pedro. With a projected capacity of 64,000 MT, this plant will be our largest and most technologically advanced installation to date." }}
                </p>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-surface rounded-sm p-4">
                        <div class="font-playfair text-2xl font-bold text-navy">64,000 MT</div>
                        <div class="text-[10px] uppercase tracking-widest text-amber mt-1">Target Capacity</div>
                    </div>
                    <div class="bg-surface rounded-sm p-4">
                        <div class="font-playfair text-2xl font-bold text-navy">2025</div>
                        <div class="text-[10px] uppercase tracking-widest text-amber mt-1">Expected Completion</div>
                    </div>
                </div>
                <p class="text-gray-500 text-xs leading-relaxed">
                    {{ app()->getLocale() === 'fr'
                        ? "Axée sur une durabilité haute performance, l'usine incorporera l'énergie solaire et la gestion automatisée de la biomasse."
                        : "Focused on high-performance sustainability, the San Pedro plant will incorporate solar energy harvesting and automated biomass waste management systems." }}
                </p>
            </div>
            <div class="aspect-[4/3] bg-gradient-to-br from-amber/20 to-navy/10 rounded-sm overflow-hidden">
                @if(file_exists(public_path('images/factories/san-pedro.png')))
                <img src="{{ asset('images/factories/san-pedro.png') }}" class="w-full h-full object-cover" alt="San Pedro">
                @else
                <div class="w-full h-full flex items-center justify-center text-6xl opacity-20">🏗️</div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-slate py-16 text-center">
    <div class="max-w-2xl mx-auto px-6">
        <h2 class="font-playfair text-3xl font-bold text-white mb-4">
            {{ app()->getLocale() === 'fr' ? 'Partner with a Global Cocoa Leader' : 'Partner with a Global Cocoa Leader' }}
        </h2>
        <p class="text-white/60 text-sm mb-8">
            {{ app()->getLocale() === 'fr'
                ? "Nos installations sont ouvertes aux audits institutionnels et aux visites partenaires."
                : "Our facilities are open for institutional audits and partner visits. Discover the precision behind every ton of cocoa we process." }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route(app()->getLocale().'.contact') }}" class="bg-white text-navy btn-outline border-white">Request Facility Tour</a>
            <a href="{{ route(app()->getLocale().'.contact') }}" class="border border-white/40 text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-white/10 transition">Download Technical Deck</a>
        </div>
    </div>
</section>

@endsection
