@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'À Propos — Atlantic Cocoa Corporation' : 'About Us — Atlantic Cocoa Corporation')

@section('content')

{{-- HERO --}}
<section class="relative h-[500px] flex items-end overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset("images/about/hero-about.png") }}')">
    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/60 to-dark/20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-16 w-full">
        <p class="section-tag mb-3">{{ app()->getLocale() === 'fr' ? 'À propos' : 'About Us' }}</p>
        <h1 class="font-playfair text-5xl lg:text-6xl font-bold text-white leading-tight max-w-3xl">
            {{ app()->getLocale() === 'fr'
                ? "L'Excellence Industrielle au Service du Cacao Africain"
                : 'Industrial Excellence at the Service of African Cocoa' }}
        </h1>
    </div>
</section>

{{-- INTRO --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div>
                <p class="section-tag mb-4">{{ app()->getLocale() === 'fr' ? 'Notre Trajectoire' : 'Our Journey' }}</p>
                <h2 class="font-playfair text-4xl font-bold text-navy mb-6">
                    {{ app()->getLocale() === 'fr' ? 'De la Vision à la Puissance Industrielle' : 'From Vision to Industrial Power' }}
                </h2>
                <p class="text-gray-600 leading-relaxed mb-6 text-sm">
                    {{ app()->getLocale() === 'fr'
                        ? "Atlantic Cocoa Corporation est née d'une ambition claire : valoriser le cacao africain à la source. En intégrant des technologies de pointe et une expertise logistique sans faille, nous redéfinissons les standards de la transformation de fèves en beurre, tourteaux et masse de cacao."
                        : "Atlantic Cocoa Corporation was born of a clear ambition: to add value to African cocoa at its source. By integrating cutting-edge technology and impeccable logistics expertise, we redefine the standards of bean-to-butter, cake, and liquor processing." }}
                </p>
                @if(isset($director) && $director)
                <div class="border-l-4 border-amber pl-6 mt-8">
                    <blockquote class="font-playfair text-lg italic text-navy mb-4 leading-relaxed">
                        "{{ $director->quote ?? 'Notre mission est de mettre l\'excellence africaine au cœur du marché mondial du cacao.' }}"
                    </blockquote>
                    <div class="flex items-center gap-3">
                        @if($director->photo)
                        <img src="{{ asset('storage/'.$director->photo) }}" class="w-12 h-12 rounded-full object-cover" alt="{{ $director->name }}">
                        @else
                        <div class="w-12 h-12 rounded-full bg-navy/10 flex items-center justify-center"><span class="text-navy font-bold">{{ strtoupper(substr($director->name,0,1)) }}</span></div>
                        @endif
                        <div>
                            <p class="font-bold text-navy text-sm">{{ $director->name }}</p>
                            <p class="text-amber text-xs font-medium">{{ $director->title }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Capacités usines --}}
            <div class="space-y-4">
                @foreach([
                    ['city' => 'Abidjan', 'cap' => '48,000 MT', 'desc' => app()->getLocale() === 'fr' ? 'Capacité de transformation annuelle opérationnelle en Côte d\'Ivoire.' : 'Annual processing capacity operational in Ivory Coast.', 'status' => 'operational'],
                    ['city' => 'Kribi',   'cap' => '48,000 MT', 'desc' => app()->getLocale() === 'fr' ? 'Installation portuaire stratégique desservant le bassin du Cameroun.' : 'Strategic port facility serving the Cameroon basin.', 'status' => 'operational'],
                    ['city' => 'San Pedro','cap' => '64,000 MT', 'desc' => app()->getLocale() === 'fr' ? 'Extension majeure en cours de construction pour 2025.' : 'Major expansion currently under construction for 2025.', 'status' => 'construction'],
                ] as $plant)
                <div class="border border-gray-200 rounded-sm p-6 flex items-center justify-between
                            {{ $plant['status'] === 'construction' ? 'bg-navy text-white' : 'bg-gray-50' }}">
                    <div>
                        <h3 class="font-playfair text-xl font-bold {{ $plant['status'] === 'construction' ? 'text-white' : 'text-navy' }}">{{ $plant['city'] }}</h3>
                        <p class="{{ $plant['status'] === 'construction' ? 'text-white/70' : 'text-gray-500' }} text-sm mt-1">{{ $plant['desc'] }}</p>
                    </div>
                    <div class="text-right flex-shrink-0 ml-4">
                        <div class="font-playfair text-3xl font-bold {{ $plant['status'] === 'construction' ? 'text-white' : 'text-navy' }}">{{ $plant['cap'] }}</div>
                        @if($plant['status'] === 'construction')
                        <span class="text-amber text-[10px] font-bold uppercase tracking-widest">In construction →</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- PILIERS --}}
<section class="py-20 bg-surface">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="font-playfair text-3xl font-bold text-navy text-center mb-12">
            {{ app()->getLocale() === 'fr' ? 'Les Piliers de notre Engagement' : 'Our Pillars of Commitment' }}
        </h2>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['icon'=>'⭐','title'=>app()->getLocale()==='fr'?'Excellence':'Excellence','body'=>app()->getLocale()==='fr'?'Une rigueur opérationnelle constante pour garantir des produits conformes aux plus hauts standards internationaux.':'Constant operational rigor to guarantee products meeting the highest international standards.'],
                ['icon'=>'🔬','title'=>app()->getLocale()==='fr'?'Qualité':'Quality','body'=>app()->getLocale()==='fr'?'Une traçabilité totale, de la plantation à l\'usine, assurant la pureté et l\'arôme de notre cacao.':'Total traceability from plantation to factory, ensuring purity and aroma.'],
                ['icon'=>'🌿','title'=>app()->getLocale()==='fr'?'Durabilité':'Sustainability','body'=>app()->getLocale()==='fr'?'Un engagement fort pour le respect de l\'environnement et le bien-être des communautés agricoles.':'A strong commitment to environmental respect and the well-being of farming communities.'],
                ['icon'=>'💡','title'=>app()->getLocale()==='fr'?'Innovation':'Innovation','body'=>app()->getLocale()==='fr'?'L\'utilisation des technologies de pointe pour optimiser les rendements et minimiser l\'empreinte carbone.':'Using cutting-edge technology to optimize yields and minimize carbon footprint.'],
            ] as $pillar)
            <div class="bg-white border border-gray-200 rounded-sm p-7 hover:shadow-md transition-shadow">
                <div class="w-12 h-12 bg-navy/5 rounded-sm flex items-center justify-center mb-5 text-2xl">{{ $pillar['icon'] }}</div>
                <h3 class="font-playfair text-lg font-bold text-navy mb-3">{{ $pillar['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $pillar['body'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- STATS BAR --}}
<section class="bg-navy py-16">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-3 gap-8 text-center">
        @foreach([
            ['value'=>'+1,200','label'=>app()->getLocale()==='fr'?'Emplois locaux directs':'Direct Local Jobs'],
            ['value'=>'100%','label'=>app()->getLocale()==='fr'?'Cacao certifié durable':'Sustainably Certified Cocoa'],
            ['value'=>'15+','label'=>app()->getLocale()==='fr'?'Projets communautaires':'Community Projects'],
        ] as $s)
        <div>
            <div class="font-playfair text-5xl font-bold text-white mb-2">{{ $s['value'] }}</div>
            <div class="text-white/50 text-xs uppercase tracking-widest font-semibold">{{ $s['label'] }}</div>
        </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-white text-center">
    <div class="max-w-2xl mx-auto px-6">
        <h2 class="font-playfair text-3xl font-bold text-navy mb-4">
            {{ app()->getLocale() === 'fr' ? 'Partenaire de votre Croissance Industrielle' : 'Partner for Your Industrial Growth' }}
        </h2>
        <p class="text-gray-500 text-sm mb-8">
            {{ app()->getLocale() === 'fr'
                ? "ACC est plus qu'un transformateur, nous sommes le maillon fort de votre chaîne d'approvisionnement globale."
                : "ACC is more than a processor — we are the strong link in your global supply chain." }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route(app()->getLocale().'.contact') }}" class="btn-navy">{{ app()->getLocale() === 'fr' ? 'Nous Contacter' : 'Contact Us' }}</a>
            <a href="{{ route(app()->getLocale().'.products') }}" class="btn-outline">{{ app()->getLocale() === 'fr' ? 'Consulter nos Produits' : 'View our Products' }}</a>
        </div>
    </div>
</section>

@endsection
