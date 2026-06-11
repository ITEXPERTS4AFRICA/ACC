@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Durabilité & RSE — ACC' : 'Sustainability & CSR — ACC')

@section('content')

{{-- HERO --}}
<section class="relative h-[460px] flex items-end bg-dark overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/60 to-dark/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full">
        <p class="section-tag mb-3">Corporate Responsibility</p>
        <h1 class="font-playfair text-5xl font-bold text-white leading-tight max-w-3xl">
            {{ app()->getLocale() === 'fr' ? 'Notre Engagement Durable' : 'Our Sustainable Commitment' }}
        </h1>
        <p class="text-white/60 text-sm mt-4 max-w-2xl leading-relaxed">
            {{ app()->getLocale() === 'fr'
                ? "Le développement durable est au cœur de chaque décision d'ACC — de la ferme au port, nous construisons une industrie du cacao qui profite aux communautés, protège les forêts et préserve les écosystèmes."
                : "Sustainable development is at the core of every ACC decision — from farm to port, we are building a cocoa industry that benefits communities, protects forests, and preserves ecosystems." }}
        </p>
    </div>
</section>

{{-- 3 PILIERS RSE --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <h2 class="font-playfair text-3xl font-bold text-navy">
                {{ app()->getLocale() === 'fr' ? 'Les 3 Piliers de Notre RSE' : 'Our 3 CSR Pillars' }}
            </h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                [
                    'icon'=>'🌱',
                    'tag'=>'Pillar 01',
                    'title'=>app()->getLocale()==='fr'?'Approvisionnement Éthique':'Ethical Sourcing',
                    'items'=>app()->getLocale()==='fr'
                        ? ['Traçabilité parcelle par parcelle', 'Primes de durabilité versées aux coopératives', 'Engagement zéro déforestation', 'Audits terrain annuels par tierce partie']
                        : ['Plot-by-plot traceability', 'Sustainability premiums paid to cooperatives', 'Zero deforestation commitment', 'Annual third-party field audits']
                ],
                [
                    'icon'=>'🌍',
                    'tag'=>'Pillar 02',
                    'title'=>app()->getLocale()==='fr'?'Protection Environnementale':'Environmental Protection',
                    'items'=>app()->getLocale()==='fr'
                        ? ['Réduction des émissions de CO₂ de 32%', 'Zéro rejet liquide dans les cours d\'eau', 'Gestion certifiée ISO 14001', 'Projets de reboisement actifs']
                        : ['32% CO₂ emission reduction', 'Zero liquid discharge into waterways', 'ISO 14001 certified management', 'Active reforestation projects']
                ],
                [
                    'icon'=>'🤝',
                    'tag'=>'Pillar 03',
                    'title'=>app()->getLocale()==='fr'?'Développement Communautaire':'Community Development',
                    'items'=>app()->getLocale()==='fr'
                        ? ['5 écoles construites au Cameroun & Côte d\'Ivoire', '15 000+ agriculteurs formés et certifiés', 'Programmes d\'alphabétisation pour adultes', 'Accès aux soins de santé primaires']
                        : ['5 schools built in Cameroon & Côte d\'Ivoire', '15,000+ farmers trained and certified', 'Adult literacy programs', 'Access to primary healthcare']
                ],
            ] as $p)
            <div class="border border-gray-200 rounded-sm p-8 hover:shadow-md transition-shadow">
                <div class="text-4xl mb-4">{{ $p['icon'] }}</div>
                <p class="section-tag mb-2">{{ $p['tag'] }}</p>
                <h3 class="font-playfair text-xl font-bold text-navy mb-5">{{ $p['title'] }}</h3>
                <ul class="space-y-3">
                    @foreach($p['items'] as $item)
                    <li class="flex items-start gap-3 text-sm text-gray-600">
                        <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BILAN 2024 --}}
<section class="py-20 bg-slate">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <p class="section-tag mb-3">2024 CSR Milestones</p>
            <h2 class="font-playfair text-3xl font-bold text-white">
                {{ app()->getLocale() === 'fr' ? 'Nos Réalisations RSE 2024' : '2024 CSR Achievements' }}
            </h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['num'=>'15 000+','label'=>app()->getLocale()==='fr'?'Agriculteurs certifiés':'Certified farmers'],
                ['num'=>'100%','label'=>app()->getLocale()==='fr'?'Traçabilité vérifiée':'Verified traceability'],
                ['num'=>'5','label'=>app()->getLocale()==='fr'?'Écoles construites':'Schools built'],
                ['num'=>'32%','label'=>app()->getLocale()==='fr'?'Réduction carbone':'Carbon reduction'],
            ] as $stat)
            <div class="bg-white/5 border border-white/10 rounded-sm p-6 text-center">
                <div class="font-playfair text-4xl font-bold text-amber mb-2">{{ $stat['num'] }}</div>
                <div class="text-white/60 text-sm uppercase tracking-wide">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PARTENARIATS --}}
<section class="py-20 bg-surface" id="partnerships">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <p class="section-tag mb-3">{{ app()->getLocale() === 'fr' ? 'Partenariats pour le changement' : 'Partnerships for Change' }}</p>
            <h2 class="font-playfair text-3xl font-bold text-navy mb-6">
                {{ app()->getLocale() === 'fr' ? 'Alignés sur les Standards Mondiaux' : 'Aligned with Global Standards' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                {{ app()->getLocale() === 'fr'
                    ? "Notre engagement RSE est validé par des organismes indépendants de renommée mondiale. Nous travaillons en partenariat avec des ONG locales, des coopératives agricoles et des institutions internationales pour garantir un impact mesurable."
                    : "Our CSR commitment is validated by world-renowned independent bodies. We partner with local NGOs, agricultural cooperatives, and international institutions to ensure measurable impact." }}
            </p>
            <div class="flex flex-wrap gap-3">
                @foreach(['Rainforest Alliance','EUDR Compliant','IDH Sustainable','UTZ Certified'] as $badge)
                <span class="border border-navy/20 text-navy text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-sm bg-white">{{ $badge }}</span>
                @endforeach
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            @foreach($partners as $partner)
            <div class="aspect-square rounded-sm bg-white border border-gray-100 p-6 flex items-center justify-center grayscale hover:grayscale-0 transition-all duration-300 group">
                @if($partner->logo)
                    <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->name }}" class="max-h-full max-w-full object-contain opacity-60 group-hover:opacity-100 transition-opacity">
                @else
                    <span class="text-navy/20 font-bold text-center text-[10px] leading-tight uppercase tracking-widest">{{ $partner->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-navy py-14 text-center">
    <div class="max-w-xl mx-auto px-6">
        <h2 class="font-playfair text-2xl font-bold text-white mb-3">{{ app()->getLocale() === 'fr' ? 'Passer à l\'Étape Suivante' : 'Take the Next Step' }}</h2>
        <p class="text-white/60 text-sm mb-8">{{ app()->getLocale() === 'fr' ? 'Téléchargez notre rapport RSE complet ou contactez notre équipe Durabilité.' : 'Download our full CSR report or contact our Sustainability team.' }}</p>
        <div class="flex flex-wrap gap-4 justify-center">
            @php $csrPath = \App\Models\SiteSetting::get('csr_report_path'); @endphp
            <a href="{{ $csrPath ? asset('storage/'.$csrPath) : '#' }}" target="_blank" class="bg-amber text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-amber/90 transition">
                {{ app()->getLocale() === 'fr' ? 'Télécharger le Rapport RSE' : 'Download CSR Report' }}
            </a>
            <a href="{{ route(app()->getLocale().'.contact') }}" class="border border-white/40 text-white uppercase tracking-widest text-xs font-bold px-7 py-3 rounded-sm hover:bg-white/10 transition">
                {{ app()->getLocale() === 'fr' ? 'Contacter l\'Équipe RSE' : 'Contact CSR Team' }}
            </a>
        </div>
    </div>
</section>

@endsection
