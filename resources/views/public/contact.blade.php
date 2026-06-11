@extends('layouts.public')
@section('page-title', app()->getLocale() === 'fr' ? 'Contact — ACC' : 'Contact — ACC')

@section('content')

{{-- HERO --}}
<section class="py-16 bg-cover border-b border-gray-100 bg-center" style="background-image: url('{{$page['contact']->hero_image ? asset("storage/".$page['cantat']->hero_image) : asset('images/contact/hero-contact.png')}}')">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="section-tag mb-3">{{ app()->getLocale() === 'fr' ? 'Connecter l\'Excellence' : 'Connect Excellence' }}</p>
            <h1 class="font-playfair text-5xl font-bold text-navy leading-tight mb-6">
                {{ app()->getLocale() === 'fr' ? 'Parlons de Vos Besoins' : 'Let\'s Talk About Your Needs' }}
            </h1>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ app()->getLocale() === 'fr'
                    ? "Notre équipe commerciale et technique est disponible pour répondre à vos questions d'approvisionnement, vos besoins de certification et vos demandes de devis."
                    : "Our commercial and technical team is available to answer your supply questions, certification needs, and quote requests." }}
            </p>
        </div>
        <div class="hidden lg:block aspect-[3/3] rounded-sm bg-surface overflow-hidden md:flex items-center justify-center bg-cover bg-center" style="background:url('{{asset('images/contact/img-cacao.png')}}')"/>
    </div>
</section>

{{-- BUREAUX --}}
<section class="py-20 bg-surface">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-10">
            <h2 class="font-playfair text-2xl font-bold text-navy">
                {{ app()->getLocale() === 'fr' ? 'Répertoire Mondial des Bureaux' : 'Global Office Directory' }}
            </h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['tag'=>app()->getLocale()==='fr'?'Siège Social':'Headquarters','city'=>'Abidjan','country'=>app()->getLocale()==='fr'?'Côte d\'Ivoire':'Côte d\'Ivoire','role'=>app()->getLocale()==='fr'?'Siège & Direction Générale':'HQ & Executive Management','addr'=>app()->getLocale()==='fr'?'Zone Industrielle de Vridi':'Vridi Industrial Zone','img'=>"images/contact/office-abidjan.png"],
                ['tag'=>app()->getLocale()==='fr'?'Pôle Logistique':'Logistics Hub','city'=>'San Pedro','country'=>app()->getLocale()==='fr'?'Côte d\'Ivoire':'Côte d\'Ivoire','role'=>app()->getLocale()==='fr'?'Logistique & Export':'Logistics & Export','addr'=>app()->getLocale()==='fr'?'Port Autonome de San Pedro':'San Pedro Autonomous Port','img'=>"images/contact/office-san-pedro.png"],
                ['tag'=>app()->getLocale()==='fr'?'Expansion CEMAC':'CEMAC Expansion','city'=>'Kribi','country'=>'Cameroun','role'=>app()->getLocale()==='fr'?'Opérations CEMAC':'CEMAC Operations','addr'=>app()->getLocale()==='fr'?'Zone Industrielle de Kribi':'Kribi Industrial Zone','img'=>"images/contact/office-kribi.png"],
            ] as $office)
            <div class="bg-white border border-gray-200 rounded-sm overflow-hidden">
                <div class="aspect-video bg-gray-50 flex items-center justify-center">
                    <img src="{{ asset($office['img']) }}" alt="{{ $office['city'] }}" class="w-full h-full object-cover">
                </div>
                <div class="p-6">
                    <span class="section-tag block mb-2">{{ $office['tag'] }}</span>
                    <h3 class="font-playfair font-bold text-navy text-xl mb-1">{{ $office['city'] }}</h3>
                    <p class="text-gray-400 text-xs uppercase tracking-wider mb-4">{{ $office['country'] }}</p>
                    <p class="text-gray-600 text-sm mb-1">{{ $office['role'] }}</p>
                    <p class="text-gray-400 text-xs">{{ $office['addr'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CONTACTS DIRECTS --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8">
        <div>
            <h2 class="font-playfair text-2xl font-bold text-navy mb-8">
                {{ app()->getLocale() === 'fr' ? 'Contacts Directs' : 'Direct Contacts' }}
            </h2>
            <div class="space-y-4">
                @foreach([
                    ['dept'=>app()->getLocale()==='fr'?'Ventes & Export':'Sales & Export','email'=>'sales@atlantic-cocoacorporation.net','desc'=>app()->getLocale()==='fr'?'Devis, volumes, contrats cadres':'Quotes, volumes, framework contracts'],
                    ['dept'=>app()->getLocale()==='fr'?'Assurance Qualité':'Quality Assurance','email'=>'quality@atlantic-cocoacorporation.net','desc'=>app()->getLocale()==='fr'?'Certifications, spécifications, audits':'Certifications, specifications, audits'],
                    ['dept'=>app()->getLocale()==='fr'?'RSE & Durabilité':'CSR & Sustainability','email'=>'csr@atlantic-cocoacorporation.net','desc'=>app()->getLocale()==='fr'?'Traçabilité, compliance EUDR':'Traceability, EUDR compliance'],
                ] as $contact)
                <div class="border border-gray-200 rounded-sm p-5 flex items-start gap-5">
                    <div class="w-10 h-10 rounded-full bg-navy/5 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-navy text-sm">{{ $contact['dept'] }}</p>
                        <a href="mailto:{{ $contact['email'] }}" class="text-amber text-sm hover:underline">{{ $contact['email'] }}</a>
                        <p class="text-gray-400 text-xs mt-1">{{ $contact['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Documentation card --}}
        <div class="bg-navy rounded-sm p-8 text-white flex flex-col justify-between">
            <div>
                <p class="section-tag mb-3">{{ app()->getLocale() === 'fr' ? 'Documentation Technique' : 'Technical Documentation' }}</p>
                <h3 class="font-playfair text-2xl font-bold mb-4">
                    {{ app()->getLocale() === 'fr' ? 'Téléchargez Nos Fiches Produits' : 'Download Product Datasheets' }}
                </h3>
                <p class="text-white/60 text-sm leading-relaxed mb-6">
                    {{ app()->getLocale() === 'fr' ? 'Specifications techniques, fiches de sécurité, certificats d\'analyse disponibles sur demande.' : 'Technical specifications, safety data sheets, certificates of analysis available on request.' }}
                </p>
            </div>
            <a href="{{ route(app()->getLocale().'.products') }}" class="bg-amber text-white uppercase tracking-widest text-xs font-bold px-6 py-3 rounded-sm hover:bg-amber/90 transition text-center block">
                {{ app()->getLocale() === 'fr' ? 'Voir les Produits' : 'View Products' }}
            </a>
        </div>
    </div>
</section>

{{-- FORMULAIRE --}}
<section class="py-20 bg-surface">
    <div class="max-w-3xl mx-auto px-6">
        <div class="text-center mb-10">
            <p class="section-tag mb-3">{{ app()->getLocale() === 'fr' ? 'Demande de Cotation B2B' : 'B2B Quote Request' }}</p>
            <h2 class="font-playfair text-3xl font-bold text-navy">
                {{ app()->getLocale() === 'fr' ? 'Envoyez votre demande' : 'Send your request' }}
            </h2>
        </div>

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-6 py-4 rounded-sm mb-6">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route(app()->getLocale().'.contact.submit') }}" class="space-y-5">
            @csrf
            {{-- Honeypot --}}
            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">
                        {{ app()->getLocale() === 'fr' ? 'Nom complet' : 'Full name' }} *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white @error('name') border-red-400 @enderror">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">
                        {{ app()->getLocale() === 'fr' ? 'Société' : 'Company' }} *
                    </label>
                    <input type="text" name="company" value="{{ old('company') }}" required
                           class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white @error('company') border-red-400 @enderror">
                    @error('company')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white @error('email') border-red-400 @enderror">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">
                        {{ app()->getLocale() === 'fr' ? 'Pays' : 'Country' }}
                    </label>
                    <input type="text" name="country" value="{{ old('country') }}"
                           class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">
                        {{ app()->getLocale() === 'fr' ? 'Type de produit' : 'Product type' }}
                    </label>
                    <select name="subject" class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white">
                        <option value="">{{ app()->getLocale() === 'fr' ? 'Sélectionner...' : 'Select...' }}</option>
                        @foreach(['Masse de Cacao / Cocoa Liquor','Beurre de Cacao / Cocoa Butter','Poudre de Cacao / Cocoa Powder','Tourteaux de Cacao / Press Cake','Autre / Other'] as $opt)
                        <option value="{{ $opt }}" @selected(old('subject') === $opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">
                        {{ app()->getLocale() === 'fr' ? 'Volume estimé (MT/an)' : 'Estimated volume (MT/year)' }}
                    </label>
                    <input type="text" name="volume" value="{{ old('volume') }}"
                           placeholder="{{ app()->getLocale() === 'fr' ? 'Ex: 500 MT' : 'e.g. 500 MT' }}"
                           class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-navy uppercase tracking-widest mb-2">
                    {{ app()->getLocale() === 'fr' ? 'Détails de la demande' : 'Request details' }}
                </label>
                <textarea name="message" rows="5" required
                          class="w-full border border-gray-200 rounded-sm px-4 py-3 text-sm text-chocolate focus:outline-none focus:border-navy transition bg-white resize-none @error('message') border-red-400 @enderror"
                          placeholder="{{ app()->getLocale() === 'fr' ? 'Décrivez vos besoins, délais, certifications requises...' : 'Describe your needs, timelines, required certifications...' }}">{{ old('message') }}</textarea>
                @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-navy w-full text-center py-4 text-sm">
                    {{ app()->getLocale() === 'fr' ? 'Envoyer la demande' : 'Send request' }}
                </button>
            </div>
        </form>
    </div>
</section>

{{-- BARRE CERTIFICATIONS --}}
<section class="py-8 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-wrap items-center justify-center gap-6">
            @foreach(['FSSC 22000','ISO 9001','ISO 14001','Rainforest Alliance','SEDEX','EUDR Ready'] as $badge)
            <span class="border border-gray-200 text-gray-500 text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-sm">{{ $badge }}</span>
            @endforeach
        </div>
    </div>
</section>

@endsection
