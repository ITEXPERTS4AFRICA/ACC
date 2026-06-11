@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Partenaires B2B — ACC' : 'B2B Partners — ACC')

@section('content')

{{-- HERO --}}
<section class="relative h-[440px] flex items-end bg-cover bg-center" style="background-image: url('{{ $page ? asset("storage/".$page['partners']->hero_image) : asset("images/partners/hero-partners.png") }}')">
    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/50 to-dark/10"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full">
        <p class="section-tag mb-3">Écosystème B2B</p>
        <h1 class="font-playfair text-5xl font-bold text-white leading-tight max-w-3xl">
            {{ app()->getLocale() === 'fr' ? 'L\'Excellence Collaborative' : 'Collaborative Excellence' }}
        </h1>
        <p class="text-white/60 text-sm mt-4 max-w-2xl leading-relaxed">
            {{ app()->getLocale() === 'fr'
                ? "Nous construisons des partenariats durables avec les acteurs les plus exigeants de l'industrie du chocolat — des marques premium aux grands industriels de l'agroalimentaire mondial."
                : "We build lasting partnerships with the most demanding players in the chocolate industry — from premium brands to major global food industry groups." }}
        </p>
    </div>
</section>

{{-- CHIFFRES + CTA PARTENAIRE --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-12 items-start">
        <div class="lg:col-span-2 grid sm:grid-cols-3 gap-6">
            @foreach([
                ['num'=>'50+','label'=>app()->getLocale()==='fr'?'Marques partenaires':'Partner brands'],
                ['num'=>'12','label'=>app()->getLocale()==='fr'?'Centres logistiques':'Logistics hubs'],
                ['num'=>'100%','label'=>app()->getLocale()==='fr'?'Traçabilité garantie':'Guaranteed traceability'],
            ] as $s)
            <div class="border border-gray-200 rounded-sm p-6 text-center">
                <div class="font-playfair text-4xl font-bold text-navy mb-2">{{ $s['num'] }}</div>
                <div class="text-gray-500 text-xs uppercase tracking-wide">{{ $s['label'] }}</div>
            </div>
            @endforeach
        </div>
        <div class="bg-navy rounded-sm p-8 text-center">
            <h3 class="font-playfair text-xl font-bold text-white mb-3">
                {{ app()->getLocale() === 'fr' ? 'Devenir Partenaire' : 'Become a Partner' }}
            </h3>
            <p class="text-white/60 text-sm mb-6 leading-relaxed">
                {{ app()->getLocale() === 'fr' ? 'Rejoignez notre réseau B2B d\'excellence et bénéficiez de nos avantages logistiques.' : 'Join our excellence B2B network and benefit from our logistics advantages.' }}
            </p>
            <a href="{{ route(app()->getLocale().'.contact') }}" class="bg-amber text-white uppercase tracking-widest text-xs font-bold px-6 py-3 rounded-sm hover:bg-amber/90 transition block text-center">
                {{ app()->getLocale() === 'fr' ? 'Prendre Contact' : 'Get in Touch' }}
            </a>
        </div>
    </div>
</section>

{{-- LOGOS PARTENAIRES --}}
<section class="py-16 bg-surface">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-10">
            <h2 class="font-playfair text-2xl font-bold text-navy">
                {{ app()->getLocale() === 'fr' ? 'Nos Partenaires & Clients' : 'Our Partners & Clients' }}
            </h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($partners as $partner)
            <div class="bg-white border border-gray-200 rounded-sm p-6 flex flex-col items-center justify-center gap-3 hover:shadow-sm transition">
                @if($partner->logo)
                <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" class="h-12 object-contain">
                @else
                <div class="w-12 h-12 bg-gray-100 rounded-sm flex items-center justify-center text-xl">🏢</div>
                @endif
                <span class="text-gray-400 text-[10px] uppercase tracking-wider">{{ $partner->category ?? 'Partner' }}</span>
            </div>
            @empty
            @foreach(['Marque Premium A','Groupe B International','Chocolatier C','Industriel D'] as $name)
            <div class="bg-white border border-gray-200 rounded-sm p-8 flex flex-col items-center justify-center gap-3">
                <div class="w-14 h-14 bg-gray-100 rounded-sm flex items-center justify-center text-2xl opacity-40">🏢</div>
                <span class="text-gray-400 text-[10px] uppercase tracking-wider">B2B Client</span>
            </div>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- TÉMOIGNAGES --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="section-tag mb-3">Testimonials</p>
            <h2 class="font-playfair text-3xl font-bold text-navy">
                {{ app()->getLocale() === 'fr' ? 'La Voix de nos Clients B2B' : 'The Voice of Our B2B Clients' }}
            </h2>
        </div>
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            @foreach([
                ['initials'=>'JL','name'=>'Jean-Luc Mercier','role'=>app()->getLocale()==='fr'?'Directeur Achats, Chocolaterie Artisanale de Lyon':'Purchasing Director, Lyon Artisan Chocolatier','quote'=>app()->getLocale()==='fr'?'ACC nous fournit un beurre de cacao d\'une constance et d\'une pureté exceptionnelles. Leur traçabilité totale nous permet de répondre aux exigences EUDR sans aucune friction.':'ACC supplies us with cocoa butter of exceptional consistency and purity. Their full traceability lets us meet EUDR requirements without any friction.'],
                ['initials'=>'SK','name'=>'Sarah Kowalski','role'=>app()->getLocale()==='fr'?'VP Supply Chain, Groupe Confiseries Internationales':'VP Supply Chain, International Confectionery Group','quote'=>app()->getLocale()==='fr'?'Un partenaire de confiance depuis 3 ans. Leur équipe logistique est réactive, leurs certificats toujours à jour, et la qualité ne varie jamais.':'A trusted partner for 3 years. Their logistics team is responsive, their certificates always up to date, and the quality never varies.'],
            ] as $t)
            <div class="border border-gray-200 rounded-sm p-8">
                <svg class="w-8 h-8 text-amber/30 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <p class="text-gray-600 text-sm leading-relaxed mb-6 italic">{{ $t['quote'] }}</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-navy flex items-center justify-center text-white font-bold text-sm">{{ $t['initials'] }}</div>
                    <div>
                        <div class="font-semibold text-navy text-sm">{{ $t['name'] }}</div>
                        <div class="text-gray-400 text-xs">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA SOMBRE --}}
<section class="bg-slate py-14 text-center">
    <div class="max-w-xl mx-auto px-6">
        <h2 class="font-playfair text-2xl font-bold text-white mb-3">
            {{ app()->getLocale() === 'fr' ? 'Prêt à Collaborer ?' : 'Ready to Collaborate?' }}
        </h2>
        <p class="text-white/60 text-sm mb-8">{{ app()->getLocale() === 'fr' ? 'Contactez notre équipe commerciale pour discuter de vos besoins d\'approvisionnement.' : 'Contact our commercial team to discuss your supply requirements.' }}</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route(app()->getLocale().'.contact') }}" class="bg-amber text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-amber/90 transition">
                {{ app()->getLocale() === 'fr' ? 'Demander un Devis' : 'Request a Quote' }}
            </a>
            <a href="{{ route(app()->getLocale().'.products') }}" class="border border-white/40 text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-white/10 transition">
                {{ app()->getLocale() === 'fr' ? 'Voir nos Produits' : 'View Products' }}
            </a>
        </div>
    </div>
</section>

@endsection
