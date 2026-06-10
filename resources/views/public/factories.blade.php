@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Nos Usines — Atlantic Cocoa Corporation' : 'Our Plants — Atlantic Cocoa Corporation')

@section('content')

    {{-- HERO --}}
    <section class="relative h-[480px] flex items-end bg-dark overflow-hidden">
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
                @foreach([['160,000 MT', 'Total Planned Capacity'], ['3', 'Strategic Locations']] as $s)
                    <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-sm px-6 py-4">
                        <div class="font-playfair text-3xl font-bold text-white">{{ $s[0] }}</div>
                        <div class="text-white/50 text-[10px] uppercase tracking-widest mt-1">{{ $s[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FACTORIES LOOP --}}
    @foreach($factories as $index => $factory)
        <section class="py-20 {{ $index % 2 === 1 ? 'bg-surface' : 'bg-white' }}">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="{{ $index % 2 === 1 ? 'order-last lg:order-first' : '' }}">
                        <p class="section-tag mb-2">{{ $factory->name_locale }}</p>
                        <p class="text-[11px] text-gray-400 uppercase tracking-widest font-semibold mb-4">
                            {{ $factory->city }}, {{ $factory->country }} | {{ $factory->status_label }}
                        </p>

                        <div class="prose prose-sm text-gray-600 mb-8 max-w-none">
                            {!! nl2br(e($factory->description_locale)) !!}
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-sm px-5 py-4">
                            <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1">Operational Status
                            </p>
                            <div class="flex items-center gap-2">
                                <span
                                    class="w-2 h-2 rounded-full {{ $factory->status === 'operational' ? 'bg-green-500' : 'bg-amber' }}"></span>
                                <span
                                    class="{{ $factory->status === 'operational' ? 'text-green-700' : 'text-amber-700' }} font-bold text-sm">
                                    {{ $factory->status_label }}
                                </span>
                                <span class="ml-auto text-xs text-gray-400 font-mono">0{{ $index + 1 }} |
                                    {{ substr($factory->country, 0, 2) }}</span>
                            </div>
                        </div>

                        @if($factory->status === 'planned' || $factory->status === 'construction')
                            <div class="mt-6 grid grid-cols-2 gap-4">
                                <div class="bg-surface rounded-sm p-4">
                                    <div class="font-playfair text-2xl font-bold text-navy">
                                        {{ number_format($factory->capacity_mt, 0, ',', ' ') }} MT</div>
                                    <div class="text-[10px] uppercase tracking-widest text-amber mt-1">Target Capacity</div>
                                </div>
                                <div class="bg-surface rounded-sm p-4">
                                    <div class="font-playfair text-2xl font-bold text-navy">2025</div>
                                    <div class="text-[10px] uppercase tracking-widest text-amber mt-1">Completion</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="relative rounded-sm overflow-hidden">
                        <div class="aspect-[4/3] bg-gradient-to-br from-navy/20 to-slate/20">
                            @if($factory->image)
                                <img src="{{ asset('storage/' . $factory->image) }}" class="w-full h-full object-cover"
                                    alt="{{ $factory->name_locale }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-6xl opacity-20">🏭</div>
                            @endif
                        </div>
                        @if($factory->capacity_mt && $factory->status === 'operational')
                            <div class="absolute bottom-4 right-4 bg-navy text-white px-4 py-2 rounded-sm shadow-lg">
                                <div class="text-[10px] uppercase tracking-widest text-white/60">
                                    {{ number_format($factory->capacity_mt, 0, ',', ' ') }} MT</div>
                                <div class="font-bold text-sm">Annual Production</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endforeach

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
                <a href="{{ route(app()->getLocale() . '.contact') }}"
                    class="bg-white text-navy btn-outline border-white">Request Facility Tour</a>
                <a href="{{ route(app()->getLocale() . '.contact') }}"
                    class="border border-white/40 text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-white/10 transition">Download
                    Technical Deck</a>
            </div>
        </div>
    </section>

@endsection