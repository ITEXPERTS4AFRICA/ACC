@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Nos Produits — Atlantic Cocoa Corporation' : 'Products — Atlantic Cocoa Corporation')

@section('content')

{{-- HERO --}}
<section class="relative h-[400px] flex items-end bg-center bg-cover overflow-hidden" style="background-image: url('{{ $page['products']->hero_image ? asset("storage/".$page['products']->hero_image) : asset("images/products/hero-products.png") }}')">
    <div class="absolute inset-0 bg-gradient-to-t from-dark/90 via-dark/50 to-dark/10"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6 pb-14 w-full">
        <p class="section-tag mb-3">Global Industrial Supply</p>
        <h1 class="font-playfair text-5xl font-bold text-white leading-tight max-w-2xl">
            {{ app()->getLocale() === 'fr' ? 'Produits Semi-Finis de Cacao' : 'Semi-Finished Cocoa Products' }}
        </h1>
        <p class="text-white/60 text-sm mt-4 max-w-xl leading-relaxed">
            {{ app()->getLocale() === 'fr'
                ? "Approvisionnant les plus grands chocolatiers mondiaux avec des dérivés de cacao de qualité premium."
                : "Supplying the world's leading chocolate makers with premium quality cocoa derivatives. Our high-capacity factories deliver operational excellence and technical precision." }}
        </p>
    </div>
</section>

{{-- CATALOGUE --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="font-playfair text-3xl font-bold text-navy">{{ app()->getLocale() === 'fr' ? 'Catalogue Industriel' : 'Industrial Catalog' }}</h2>
                <div class="w-12 h-0.5 bg-amber mt-3"></div>
            </div>
        </div>

        @if($products->count())
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <a href="{{ route(app()->getLocale().'.product.detail', $product->slug) }}"
               class="group border border-gray-200 rounded-sm overflow-hidden hover:shadow-lg transition-shadow">
                <div class="aspect-square bg-gray-100 overflow-hidden">
                    @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name_locale }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                     <img src="{{ asset("images/home/image 16.png") }}" alt="Placeholder Image" class="w-full h-full object-cover opacity-50">
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-playfair text-xl font-bold text-navy mb-2">{{ $product->name_locale }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{!! nl2br(e($product->description_locale)) !!}</p>
                    <span class="inline-flex items-center gap-1 text-navy text-[10px] font-bold uppercase tracking-widest group-hover:text-amber transition">
                        Technical Specs
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </a>
            @endforeach
        </div>
        @else
        {{-- Placeholder si base vide --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['name'=>'Cocoa Mass (Liquor)','desc'=>'Produced by grinding selected cocoa nibs into a smooth, liquid paste. Essential for premium chocolate profiles.'],
                ['name'=>'Cocoa Butter','desc'=>'Deodorized or natural fat extracted from the cocoa bean. Provides structural integrity and melt-in-mouth sensation.'],
                ['name'=>'Cocoa Powder','desc'=>'Available in various pH levels and fat contents (10–12%). Perfect for beverages, biscuits, and coatings.'],
                ['name'=>'Cocoa Cake','desc'=>'The solids remaining after cocoa butter extraction. High flavor concentration for intense applications.'],
            ] as $p)
            <div class="group border border-gray-200 rounded-sm overflow-hidden hover:shadow-lg transition-shadow cursor-default">
                <div class="aspect-square bg-gradient-to-br from-chocolate/10 to-navy/10 flex items-center justify-center">
                    <span class="text-5xl opacity-30">🍫</span>
                </div>
                <div class="p-5">
                    <h3 class="font-playfair text-xl font-bold text-navy mb-2">{{ $p['name'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $p['desc'] }}</p>
                    <span class="inline-flex items-center gap-1 text-navy text-[10px] font-bold uppercase tracking-widest">Technical Specs <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg></span>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- QUALITÉ ASSURANCE --}}
<section class="py-20 bg-surface">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <p class="section-tag mb-4">Quality Assurance</p>
            <h2 class="font-playfair text-4xl font-bold text-navy mb-6">
                {{ app()->getLocale() === 'fr' ? 'Standards Sans Compromis pour l\'Industrie Mondiale' : 'Uncompromising Standards for Global Industry' }}
            </h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                {{ app()->getLocale() === 'fr'
                    ? "Notre engagement envers l'excellence est soutenu par des certifications internationales garantissant la sécurité alimentaire et la transparence des processus. Chaque tonne de produit est testée dans nos laboratoires internes."
                    : "Our commitment to excellence is backed by international certifications that guarantee food safety and process transparency. Every metric ton of product is tested in our on-site laboratories." }}
            </p>
            <div class="grid grid-cols-2 gap-4 mb-8">
                @foreach([
                    ['cert'=>'FSSC 22000','label'=>'Food Safety System'],
                    ['cert'=>'ISO 9001:2015','label'=>'Quality Management'],
                ] as $c)
                <div class="border-l-4 border-navy pl-4">
                    <div class="font-bold text-navy text-sm">{{ $c['cert'] }}</div>
                    <div class="text-gray-400 text-xs uppercase tracking-wide">{{ $c['label'] }}</div>
                </div>
                @endforeach
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach([['⚙️','SEDEX Audited','Ethical and environmental supply chain compliance.'],['🔬','In-House Lab','Real-time batch testing and technical reporting.']] as $f)
                <div class="bg-white border border-gray-200 rounded-sm p-4 text-center">
                    <div class="text-2xl mb-2">{{ $f[0] }}</div>
                    <div class="text-[10px] text-amber font-bold uppercase tracking-widest mb-1">{{ $f[1] }}</div>
                    <div class="text-gray-500 text-xs">{{ $f[2] }}</div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="aspect-square bg-gradient-to-br from-navy/5 to-navy/10 rounded-sm flex items-center justify-center">
            <img src="{{ asset('images/products/production-professional.png') }}" alt="Laboratory Image" class="w-full h-full object-cover">
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-navy py-16 text-center">
    <div class="max-w-2xl mx-auto px-6">
        <h2 class="font-playfair text-3xl font-bold text-white mb-4">Partner with ACC Today</h2>
        <p class="text-white/60 text-sm mb-8">
            {{ app()->getLocale() === 'fr'
                ? "Contactez nos spécialistes commerciaux pour discuter des volumes, des spécifications techniques et de la logistique."
                : "Connect with our sales specialists to discuss volume pricing, technical specifications, and logistics for your manufacturing needs." }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route(app()->getLocale().'.contact') }}" class="bg-amber text-white uppercase tracking-widest text-xs font-bold px-8 py-3 rounded-sm hover:bg-amber/90 transition">Get a Quote</a>
            <a href="{{ route(app()->getLocale().'.contact') }}" class="border border-white/40 text-white uppercase tracking-widest text-xs font-bold px-8 py-3 rounded-sm hover:bg-white/10 transition">Contact Sales Team</a>
        </div>
    </div>
</section>

@endsection
