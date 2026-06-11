@extends('layouts.public')

@section('content')

<section class="bg-cover bg-center py-32" style="background-image: url('{{ $product->image ? asset('storage/'.$product->image) : asset('images/products/hero-products.png') }}')">
    <div class="max-w-7xl mx-auto px-6">
        <a href="{{ route(app()->getLocale().'.products') }}" class="text-white/50 text-sm hover:text-white mb-6 inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ app()->getLocale() === 'fr' ? 'Tous les produits' : 'All products' }}
        </a>
        <h1 class="font-playfair text-5xl font-bold text-white max-w-2xl leading-tight mt-4">{{ $product->name_locale }}</h1>
    </div>
</section>

    <section class="section-cream py-24">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16">
            {{-- Image --}}
            <div class="aspect-[4/3] bg-surface rounded-sm overflow-hidden card-accent">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name_locale }}"
                        class="w-full h-full object-cover">
                @else
                    <div
                        class="w-full h-full flex items-center justify-center bg-gradient-to-br from-chocolate/5 to-bordeaux/10">
                        <span class="font-playfair text-8xl text-bordeaux/20">{{ substr($product->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>

            <div>
                <div class="text-text-secondary text-lg leading-relaxed mb-8">
                    @if($product->description_full_locale)
                        {!! $product->description_full_locale !!}
                    @else
                        {!! nl2br(e($product->description_locale)) !!}
                    @endif
                </div>

                {{-- Variantes --}}
                @if($product->variants)
                    <div class="mb-8">
                        <h3 class="font-playfair text-xl font-bold text-chocolate mb-4">
                            {{ app()->getLocale() === 'fr' ? 'Variantes disponibles' : 'Available variants' }}</h3>
                        <div class="space-y-3">
                            @foreach($product->variants as $variant)
                                <div class="flex items-center justify-between bg-surface border border-border rounded-sm px-4 py-3">
                                    <div>
                                        <span class="font-semibold text-chocolate">{{ $variant['name'] ?? '' }}</span>
                                        @if(isset($variant['code']))
                                            <span
                                                class="ml-2 text-xs bg-industrial text-white px-2 py-0.5 rounded-sm">{{ $variant['code'] }}</span>
                                        @endif
                                    </div>
                                    @if(isset($variant['badge']))
                                        <span
                                            class="bg-industrial text-white text-xs px-2 py-1 rounded-sm">{{ $variant['badge'] }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Bouton PDF --}}
                @if($product->pdf_datasheet)
                    <a href="{{ asset('storage/' . $product->pdf_datasheet) }}" target="_blank"
                        class="btn-primary inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        {{ app()->getLocale() === 'fr' ? 'Télécharger la fiche PDF' : 'Download PDF Datasheet' }}
                    </a>
                @endif

                {{-- CTA contact --}}
                <div class="mt-8 p-6 bg-surface border border-border rounded-sm card-accent">
                    <p class="font-semibold text-chocolate mb-2">
                        {{ app()->getLocale() === 'fr' ? 'Intéressé par ce produit ?' : 'Interested in this product?' }}</p>
                    <p class="text-text-secondary text-sm mb-4">
                        {{ app()->getLocale() === 'fr' ? 'Contactez nos équipes pour un devis ou des informations techniques.' : 'Contact our teams for a quote or technical information.' }}
                    </p>
                    <a href="{{ route(app()->getLocale() . '.contact') }}" class="btn-secondary">
                        {{ app()->getLocale() === 'fr' ? 'Demander un devis' : 'Request a quote' }}
                    </a>
                </div>
            </div>
        </div>

        {{-- Spécifications --}}
        @if($product->specifications)
            <div class="max-w-7xl mx-auto px-6 mt-16">
                <h2 class="font-playfair text-2xl font-bold text-chocolate mb-6">
                    {{ app()->getLocale() === 'fr' ? 'Spécifications Techniques' : 'Technical Specifications' }}</h2>
                <div class="bg-surface border border-border rounded-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <tbody class="divide-y divide-border">
                            @foreach($product->specifications as $spec)
                                <tr class="hover:bg-cream transition-colors">
                                    <td class="px-6 py-4 font-medium text-chocolate w-1/3">
                                        {{ $spec['label'] ?? $spec['key'] ?? '' }}</td>
                                    <td class="px-6 py-4 text-text-secondary">{{ $spec['value'] ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </section>

@endsection